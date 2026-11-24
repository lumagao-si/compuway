<?php
// Aqui ocorre a integração: a tela de alunos consulta e grava os dados na tabela clientes.
$pagina_atual = 'alunos.php';
require_once __DIR__ . '/../pages/verificar_admin.php';
require_once __DIR__ . '/../backend/conexao.php';

$mensagem = '';
$tipoMensagem = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'cadastrar' || $acao === 'editar') {
        $id = (int)($_POST['id'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $dataNascimento = ($_POST['data_nascimento'] ?? '') !== '' ? $_POST['data_nascimento'] : null;
        $telefone = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $endereco = trim($_POST['endereco'] ?? '');

        if ($nome === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensagem = 'Informe nome e um e-mail válido.';
            $tipoMensagem = 'danger';
        } else {
            // Aqui ocorre a integração: o campo senha existe no banco, mas não faz parte do formulário administrativo do frontend.
            if ($acao === 'cadastrar') {
                $senhaInicial = password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT);
                $stmt = $conexao->prepare('INSERT INTO clientes (nome, email, senha, telefone, cpf, data_nascimento, endereco) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $stmt->bind_param('sssssss', $nome, $email, $senhaInicial, $telefone, $cpf, $dataNascimento, $endereco);
            } else {
                $stmt = $conexao->prepare('UPDATE clientes SET nome = ?, email = ?, telefone = ?, cpf = ?, data_nascimento = ?, endereco = ? WHERE id = ?');
                $stmt->bind_param('ssssssi', $nome, $email, $telefone, $cpf, $dataNascimento, $endereco, $id);
            }

            if ($stmt && $stmt->execute()) {
                $stmt->close();
                header('Location: alunos.php?salvo=1');
                exit();
            }

            if (isset($stmt) && $stmt) { $stmt->close(); }
            $mensagem = 'Não foi possível salvar. Verifique se o e-mail já está cadastrado.';
            $tipoMensagem = 'danger';
        }
    }

    if ($acao === 'alterar_status') {
        $id = (int)($_POST['id'] ?? 0);
        $ativo = (int)($_POST['ativo'] ?? 0);
        $stmt = $conexao->prepare('UPDATE clientes SET ativo = ? WHERE id = ?');
        $stmt->bind_param('ii', $ativo, $id);
        if ($stmt->execute()) {
            $stmt->close();
            header('Location: alunos.php?status=1');
            exit();
        }
        $stmt->close();
        $mensagem = 'Não foi possível alterar a situação do aluno.';
        $tipoMensagem = 'danger';
    }
}

if (isset($_GET['salvo'])) { $mensagem = 'Aluno salvo com sucesso!'; }
if (isset($_GET['status'])) { $mensagem = 'Situação do aluno atualizada!'; }

// Aqui ocorre a integração: busca os alunos e a matrícula mais recente para mostrar curso/pacote na listagem.
$sql = "SELECT c.id, c.nome, c.email, c.telefone, c.cpf, c.data_nascimento, c.endereco, c.data_cadastro, c.ativo,
        COALESCE(cu.nome, pa.nome, '—') AS curso_nome,
        COALESCE(m.status, 'sem matrícula') AS matricula_status
        FROM clientes c
        LEFT JOIN matriculas m ON m.id = (SELECT MAX(m2.id) FROM matriculas m2 WHERE m2.cliente_id = c.id)
        LEFT JOIN cursos cu ON cu.id = m.curso_id
        LEFT JOIN pacotes pa ON pa.id = m.pacote_id
        ORDER BY c.nome";
$resultado = $conexao->query($sql);
$alunos = [];
if ($resultado) {
    while ($linha = $resultado->fetch_assoc()) { $alunos[] = $linha; }
}

function h($valor) { return htmlspecialchars((string)($valor ?? ''), ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="system.css">
    <link rel="stylesheet" href="gestao.css">
    <link rel="stylesheet" href="../components/sidebar.css">
    <link rel="icon" href="../src/images/compuway.logo.png" type="image/png">
    <title>Alunos</title>
</head>
<body>
<?php include __DIR__ . '/../components/sidebar.php'; ?>
<div class="main">
    <div class="gestao-header">
        <h1 class="title">Alunos</h1>
    </div>

    <?php if ($mensagem !== ''): ?>
        <div class="alert alert-<?= h($tipoMensagem) ?> alert-dismissible fade show" role="alert">
            <?= h($mensagem) ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="gestao-acoes">
        <div class="busca-container">
            <input type="text" id="buscaAluno" class="busca" placeholder="Buscar aluno" aria-label="Buscar aluno">
            <i class="bi bi-search"></i>
        </div>
        <select id="filtroAluno" class="form-select filter-gestao" aria-label="Filtrar alunos">
            <option value="todos">Todos os alunos</option>
            <option value="ativo">Ativos</option>
            <option value="inativo">Inativos</option>
        </select>
        <button type="button" class="btn btn-laranja" data-bs-toggle="modal" data-bs-target="#modalAluno"><i class="bi bi-plus-lg"></i> Cadastrar aluno</button>
    </div>

    <div class="gestao-tabela">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle" id="tabelaAlunos">
                <thead><tr><th>Aluno</th><th>Telefone</th><th>E-mail</th><th>Curso</th><th>Ações</th></tr></thead>
                <tbody>
                <?php if (empty($alunos)): ?>
                    <tr><td colspan="5" class="text-center py-4">Nenhum aluno cadastrado.</td></tr>
                <?php else: foreach ($alunos as $aluno): ?>
                    <tr data-status="<?= $aluno['ativo'] ? 'ativo' : 'inativo' ?>">
                        <td><?= h($aluno['nome']) ?></td>
                        <td><?= h($aluno['telefone'] ?: '—') ?></td>
                        <td><?= h($aluno['email']) ?></td>
                        <td><?= h($aluno['curso_nome']) ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn-acoes dropdown-toggle" data-bs-toggle="dropdown" aria-label="Ações"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><button class="dropdown-item" type="button" onclick='verAluno(<?= json_encode($aluno, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>)'>Visualizar</button></li>
                                    <li><button class="dropdown-item" type="button" onclick='editarAluno(<?= json_encode($aluno, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>)'>Editar</button></li>
                                    <li><form method="post" action="alunos.php" onsubmit="return confirm('Deseja alterar a situação deste aluno?')">
                                        <input type="hidden" name="acao" value="alterar_status"><input type="hidden" name="id" value="<?= (int)$aluno['id'] ?>"><input type="hidden" name="ativo" value="<?= $aluno['ativo'] ? 0 : 1 ?>">
                                        <button class="dropdown-item" type="submit"><?= $aluno['ativo'] ? 'Inativar' : 'Ativar' ?></button>
                                    </form></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        <div class="gestao-rodape">
            <span id="contadorAlunos">Mostrando 0 a 0 de 0 registros</span>
            <nav aria-label="Paginação de alunos"><ul class="pagination pagination-sm mb-0" id="paginacaoAlunos"></ul></nav>
        </div>
    </div>
</div>

<!-- Cadastro e edição: campos seguem os dados de aluno do frontend. -->
<div class="modal fade" id="modalAluno" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"><div class="modal-content">
        <form method="post" action="alunos.php" id="formAluno">
            <input type="hidden" name="acao" id="acaoAluno" value="cadastrar"><input type="hidden" name="id" id="idAluno">
            <div class="modal-header"><h5 class="modal-title" id="tituloAluno">Cadastrar aluno</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-8"><label class="form-label">Nome completo</label><input class="form-control" name="nome" id="nomeAluno" required></div>
                    <div class="col-md-4"><label class="form-label">CPF</label><input class="form-control" name="cpf" id="cpfAluno"></div>
                    <div class="col-md-6"><label class="form-label">Data de nascimento</label><input type="date" class="form-control" name="data_nascimento" id="nascimentoAluno"></div>
                    <div class="col-md-6"><label class="form-label">Telefone</label><input class="form-control" name="telefone" id="telefoneAluno"></div>
                    <div class="col-md-6"><label class="form-label">E-mail</label><input type="email" class="form-control" name="email" id="emailAluno" required></div>
                    <div class="col-md-6"><label class="form-label">Endereço (opcional)</label><input class="form-control" name="endereco" id="enderecoAluno"></div>
                </div>
                <p class="text-secondary small mt-3 mb-0">A matrícula e as mensalidades são gerenciadas na área de Mensalidades.</p>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-laranja">Salvar</button></div>
        </form>
    </div></div>
</div>

<div class="modal fade" id="modalVisualizarAluno" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Detalhes do aluno</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body"><dl class="row mb-0">
            <dt class="col-sm-4">Nome</dt><dd class="col-sm-8" id="vAlunoNome"></dd>
            <dt class="col-sm-4">CPF</dt><dd class="col-sm-8" id="vAlunoCpf"></dd>
            <dt class="col-sm-4">Nascimento</dt><dd class="col-sm-8" id="vAlunoNascimento"></dd>
            <dt class="col-sm-4">Telefone</dt><dd class="col-sm-8" id="vAlunoTelefone"></dd>
            <dt class="col-sm-4">E-mail</dt><dd class="col-sm-8" id="vAlunoEmail"></dd>
            <dt class="col-sm-4">Endereço</dt><dd class="col-sm-8" id="vAlunoEndereco"></dd>
            <dt class="col-sm-4">Curso / pacote</dt><dd class="col-sm-8" id="vAlunoCurso"></dd>
            <dt class="col-sm-4">Matrícula</dt><dd class="col-sm-8" id="vAlunoMatricula"></dd>
            <dt class="col-sm-4">Situação</dt><dd class="col-sm-8" id="vAlunoStatus"></dd>
        </dl></div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button></div>
    </div></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Aqui ocorre a integração: pesquisa, filtros e modais usam os dados enviados pelo PHP.
const modalAluno = new bootstrap.Modal(document.getElementById('modalAluno'));
const modalVisualizarAluno = new bootstrap.Modal(document.getElementById('modalVisualizarAluno'));
function editarAluno(aluno) {
    document.getElementById('tituloAluno').textContent = 'Editar aluno';
    document.getElementById('acaoAluno').value = 'editar';
    document.getElementById('idAluno').value = aluno.id;
    document.getElementById('nomeAluno').value = aluno.nome || '';
    document.getElementById('cpfAluno').value = aluno.cpf || '';
    document.getElementById('nascimentoAluno').value = aluno.data_nascimento || '';
    document.getElementById('telefoneAluno').value = aluno.telefone || '';
    document.getElementById('emailAluno').value = aluno.email || '';
    document.getElementById('enderecoAluno').value = aluno.endereco || '';
    modalAluno.show();
}
function verAluno(aluno) {
    document.getElementById('vAlunoNome').textContent = aluno.nome || '—';
    document.getElementById('vAlunoCpf').textContent = aluno.cpf || '—';
    document.getElementById('vAlunoNascimento').textContent = aluno.data_nascimento || '—';
    document.getElementById('vAlunoTelefone').textContent = aluno.telefone || '—';
    document.getElementById('vAlunoEmail').textContent = aluno.email || '—';
    document.getElementById('vAlunoEndereco').textContent = aluno.endereco || '—';
    document.getElementById('vAlunoCurso').textContent = aluno.curso_nome || '—';
    document.getElementById('vAlunoMatricula').textContent = aluno.matricula_status || '—';
    document.getElementById('vAlunoStatus').textContent = Number(aluno.ativo) === 1 ? 'Ativo' : 'Inativo';
    modalVisualizarAluno.show();
}
document.getElementById('modalAluno').addEventListener('hidden.bs.modal', () => {
    document.getElementById('formAluno').reset();
    document.getElementById('tituloAluno').textContent = 'Cadastrar aluno';
    document.getElementById('acaoAluno').value = 'cadastrar';
    document.getElementById('idAluno').value = '';
});
const linhasAlunos = Array.from(document.querySelectorAll('#tabelaAlunos tbody tr[data-status]'));
let paginaAlunos = 1;
const porPaginaAlunos = 8;

function filtrarAlunos() {
    const busca = document.getElementById('buscaAluno').value.toLowerCase();
    const filtro = document.getElementById('filtroAluno').value;
    const filtrados = linhasAlunos.filter(linha =>
        linha.innerText.toLowerCase().includes(busca) &&
        (filtro === 'todos' || linha.dataset.status === filtro)
    );
    const totalPaginas = Math.max(1, Math.ceil(filtrados.length / porPaginaAlunos));
    paginaAlunos = Math.min(paginaAlunos, totalPaginas);
    linhasAlunos.forEach(linha => linha.hidden = true);
    filtrados.forEach((linha, indice) => {
        linha.hidden = indice < (paginaAlunos - 1) * porPaginaAlunos || indice >= paginaAlunos * porPaginaAlunos;
    });
    const inicio = filtrados.length ? (paginaAlunos - 1) * porPaginaAlunos + 1 : 0;
    const fim = Math.min(paginaAlunos * porPaginaAlunos, filtrados.length);
    document.getElementById('contadorAlunos').textContent = `Mostrando ${inicio} a ${fim} de ${filtrados.length} registros`;
    const paginacao = document.getElementById('paginacaoAlunos');
    paginacao.innerHTML = '';
    for (let i = 1; i <= totalPaginas; i++) {
        const item = document.createElement('li');
        item.className = 'page-item' + (i === paginaAlunos ? ' active' : '');
        const botao = document.createElement('button');
        botao.className = 'page-link';
        botao.type = 'button';
        botao.textContent = i;
        botao.addEventListener('click', () => { paginaAlunos = i; filtrarAlunos(); });
        item.appendChild(botao);
        paginacao.appendChild(item);
    }
}
document.getElementById('buscaAluno').addEventListener('input', () => { paginaAlunos = 1; filtrarAlunos(); });
document.getElementById('filtroAluno').addEventListener('change', () => { paginaAlunos = 1; filtrarAlunos(); });
filtrarAlunos();
</script>
</body>
</html>
