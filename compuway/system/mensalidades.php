<?php
// Aqui ocorre a integração: a tela de mensalidades consulta e atualiza os registros da tabela pagamentos.
$pagina_atual = 'mensalidades.php';
require_once __DIR__ . '/../pages/verificar_admin.php';
require_once __DIR__ . '/../backend/conexao.php';
require_once __DIR__ . '/../backend/financeiro.php';

$mensagem = '';
$tipoMensagem = 'success';

// Aqui ocorre a integração: atualiza automaticamente o status quando a data de vencimento passa.
atualizar_atrasados($conexao);

function valorMensalidade($valor) {
    $valor = trim((string)$valor);
    $valor = str_replace(['R$', ' '], '', $valor);
    if (strpos($valor, ',') !== false) {
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
    }
    return is_numeric($valor) ? (float)$valor : 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'editar') {
        $id = (int)($_POST['id'] ?? 0);
        $valor = valorMensalidade($_POST['valor'] ?? '');
        $vencimento = $_POST['data_vencimento'] ?? '';
        $status = $_POST['status'] ?? 'pendente';

        if ($id < 1 || $valor <= 0 || $vencimento === '' || !in_array($status, ['pendente', 'pago', 'atrasado'], true)) {
            $mensagem = 'Confira o valor, vencimento e situação informados.';
            $tipoMensagem = 'danger';
        } else {
            $atual = $conexao->prepare('SELECT data_pagamento FROM pagamentos WHERE id = ?');
            $atual->bind_param('i', $id);
            $atual->execute();
            $dadosAtuais = $atual->get_result()->fetch_assoc();
            $atual->close();

            if (!$dadosAtuais) {
                $mensagem = 'Mensalidade não encontrada.';
                $tipoMensagem = 'danger';
            } else {
                $dataPagamento = $status === 'pago' ? ($dadosAtuais['data_pagamento'] ?: date('Y-m-d')) : null;
                $stmt = $conexao->prepare('UPDATE pagamentos SET valor = ?, data_vencimento = ?, status = ?, data_pagamento = ? WHERE id = ?');
                $stmt->bind_param('dsssi', $valor, $vencimento, $status, $dataPagamento, $id);
                if ($stmt->execute()) {
                    $stmt->close();
                    header('Location: mensalidades.php?salvo=1');
                    exit();
                }
                $stmt->close();
                $mensagem = 'Não foi possível atualizar a mensalidade.';
                $tipoMensagem = 'danger';
            }
        }
    }

    if ($acao === 'marcar_pago') {
        $id = (int)($_POST['id'] ?? 0);
        $stmt = $conexao->prepare("UPDATE pagamentos SET status = 'pago', data_pagamento = CURDATE() WHERE id = ?");
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $stmt->close();
            header('Location: mensalidades.php?pagamento=1');
            exit();
        }
        $stmt->close();
        $mensagem = 'Não foi possível registrar o pagamento.';
        $tipoMensagem = 'danger';
    }

    // Aqui ocorre a integração: gera uma matrícula e as parcelas diretamente nas tabelas já existentes.
    if ($acao === 'gerar') {
        $clienteId = (int)($_POST['cliente_id'] ?? 0);
        $tipo = $_POST['tipo'] ?? 'curso';
        $itemId = (int)($_POST['item_id'] ?? 0);
        $valor = valorMensalidade($_POST['valor'] ?? '');
        $primeiroVencimento = $_POST['primeiro_vencimento'] ?? '';
        $quantidade = (int)($_POST['quantidade'] ?? 0);
        $dataMatricula = date('Y-m-d');

        if ($clienteId < 1 || $itemId < 1 || !in_array($tipo, ['curso', 'pacote'], true) || $valor <= 0 || $primeiroVencimento === '' || $quantidade < 1 || $quantidade > 60) {
            $mensagem = 'Preencha aluno, curso/pacote, valor, primeiro vencimento e quantidade corretamente.';
            $tipoMensagem = 'danger';
        } else {
            $cursoId = $tipo === 'curso' ? $itemId : null;
            $pacoteId = $tipo === 'pacote' ? $itemId : null;
            // A transação evita gravar uma matrícula pela metade caso alguma parcela falhe.
            $conexao->begin_transaction();
            $stmtMatricula = $conexao->prepare('INSERT INTO matriculas (cliente_id, curso_id, pacote_id, data_matricula, primeiro_vencimento, quantidade_mensalidades, status) VALUES (?, ?, ?, ?, ?, ?, \'ativa\')');
            $stmtMatricula->bind_param('iiissi', $clienteId, $cursoId, $pacoteId, $dataMatricula, $primeiroVencimento, $quantidade);
            $geracaoOk = $stmtMatricula->execute();
            $matriculaId = $conexao->insert_id;
            $stmtMatricula->close();

            if ($geracaoOk) {
                $stmtPagamento = $conexao->prepare('INSERT INTO pagamentos (cliente_id, curso_id, pacote_id, valor, data_vencimento, status, matricula_id, referencia) VALUES (?, ?, ?, ?, ?, \'pendente\', ?, ?)');
                $data = new DateTime($primeiroVencimento);
                $diaVencimento = (int)$data->format('d');
                for ($i = 0; $i < $quantidade; $i++) {
                    $vencimento = $data->format('Y-m-d');
                    $referencia = $data->format('Y-m');
                    $stmtPagamento->bind_param('iiidsis', $clienteId, $cursoId, $pacoteId, $valor, $vencimento, $matriculaId, $referencia);
                    if (!$stmtPagamento->execute()) { $geracaoOk = false; break; }
                    // Mantém o dia de vencimento original, ajustando para o último dia em meses menores.
                    $data->modify('first day of next month');
                    $diaFinal = min($diaVencimento, (int)$data->format('t'));
                    $data->setDate((int)$data->format('Y'), (int)$data->format('m'), $diaFinal);
                }
                $stmtPagamento->close();
            }

            if ($geracaoOk) {
                $conexao->commit();
                header('Location: mensalidades.php?gerado=1');
                exit();
            }
            $conexao->rollback();
            $mensagem = 'Não foi possível gerar todas as mensalidades. Nenhum dado foi gravado; confira os dados e tente novamente.';
            $tipoMensagem = 'danger';
        }
    }
}

if (isset($_GET['salvo'])) { $mensagem = 'Mensalidade atualizada com sucesso!'; }
if (isset($_GET['pagamento'])) { $mensagem = 'Pagamento registrado com sucesso!'; }
if (isset($_GET['gerado'])) { $mensagem = 'Matrícula e mensalidades geradas com sucesso!'; }

// Aqui ocorre a integração: os filtros e a tabela usam os dados reais de pagamentos, alunos, cursos e pacotes.
$sql = "SELECT p.id, p.cliente_id, p.curso_id, p.pacote_id, p.valor, p.data_vencimento, p.data_pagamento, p.status, p.referencia,
        c.nome AS aluno, COALESCE(cu.nome, pa.nome, '—') AS curso,
        COALESCE(p.referencia, DATE_FORMAT(p.data_vencimento, '%Y-%m')) AS referencia_exibicao
        FROM pagamentos p
        INNER JOIN clientes c ON c.id = p.cliente_id
        LEFT JOIN cursos cu ON cu.id = p.curso_id
        LEFT JOIN pacotes pa ON pa.id = p.pacote_id
        ORDER BY p.data_vencimento DESC, p.id DESC";
$resultado = $conexao->query($sql);
$mensalidades = [];
if ($resultado) { while ($linha = $resultado->fetch_assoc()) { $mensalidades[] = $linha; } }

$alunos = [];
$resAlunos = $conexao->query('SELECT id, nome FROM clientes WHERE ativo = 1 ORDER BY nome');
if ($resAlunos) { while ($linha = $resAlunos->fetch_assoc()) { $alunos[] = $linha; } }

$itens = [];
$resCursos = $conexao->query("SELECT id, nome, valor, parcelas, 'curso' AS tipo FROM cursos WHERE ativo = 1 ORDER BY nome");
if ($resCursos) { while ($linha = $resCursos->fetch_assoc()) { $itens[] = $linha; } }
$resPacotes = $conexao->query("SELECT id, nome, valor, parcelas, 'pacote' AS tipo FROM pacotes WHERE ativo = 1 ORDER BY nome");
if ($resPacotes) { while ($linha = $resPacotes->fetch_assoc()) { $itens[] = $linha; } }

$resumo = obter_resumo_financeiro($conexao);
$totalPendente = (int)$resumo['pendente']['quantidade'];
$totalAtrasado = (int)$resumo['atrasado']['quantidade'];
$totalPago = (int)$resumo['recebido']['quantidade'];
$totalEmAtraso = (float)$resumo['atrasado']['total'];
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
    <title>Mensalidades</title>
</head>
<body>
<?php include __DIR__ . '/../components/sidebar.php'; ?>
<div class="main">
    <div class="gestao-header">
        <h1 class="title">Mensalidades</h1>
    </div>

    <?php if ($mensagem !== ''): ?>
        <div class="alert alert-<?= h($tipoMensagem) ?> alert-dismissible fade show" role="alert">
            <?= h($mensagem) ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="gestao-acoes">
        <div class="busca-container">
            <input type="text" id="buscaMensalidade" class="busca" placeholder="Buscar mensalidade" aria-label="Buscar mensalidade">
            <i class="bi bi-search"></i>
        </div>
        <select id="filtroMensalidade" class="form-select filter-gestao" aria-label="Filtrar mensalidades">
            <option value="todos">Todas as mensalidades</option><option value="pendente">Pendentes</option><option value="atrasado">Em atraso</option><option value="pago">Pagas</option>
        </select>
        <button type="button" class="btn btn-laranja" data-bs-toggle="modal" data-bs-target="#modalGerar"><i class="bi bi-plus-lg"></i> Gerar mensalidades</button>
    </div>

    <div class="gestao-tabela">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle" id="tabelaMensalidades">
                <thead><tr><th>Aluno</th><th>Valor</th><th>Vencimento</th><th>Status</th><th>Juros</th><th>Ações</th></tr></thead>
                <tbody>
                <?php if (empty($mensalidades)): ?>
                    <tr><td colspan="6" class="text-center py-4">Nenhuma mensalidade cadastrada.</td></tr>
                <?php else: foreach ($mensalidades as $mensalidade):
                    $calculo = $mensalidade['status'] === 'atrasado' ? calcular_juros((float)$mensalidade['valor'], $mensalidade['data_vencimento']) : ['dias' => 0, 'multa' => 0, 'juros' => 0, 'total' => (float)$mensalidade['valor']];
                    $encargos = $calculo['multa'] + $calculo['juros'];
                    $statusTexto = $mensalidade['status'] === 'atrasado' ? 'Atrasada - ' . (int)$calculo['dias'] . ' dias' : ($mensalidade['status'] === 'pago' ? 'Paga' : 'Pendente');
                ?>
                    <tr data-status="<?= h($mensalidade['status']) ?>">
                        <td><?= h($mensalidade['aluno']) ?></td>
                        <td>R$ <?= number_format((float)$mensalidade['valor'], 2, ',', '.') ?></td>
                        <td><?= date('d/m/Y', strtotime($mensalidade['data_vencimento'])) ?></td>
                        <td><span class="badge status-<?= h($mensalidade['status']) ?>"><?= h($statusTexto) ?></span></td>
                        <td><?= $mensalidade['status'] === 'atrasado' ? 'R$ ' . number_format($encargos, 2, ',', '.') : '—' ?></td>
                        <td><div class="dropdown">
                            <button class="btn-acoes dropdown-toggle" data-bs-toggle="dropdown" aria-label="Ações"><i class="bi bi-three-dots-vertical"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><button class="dropdown-item" type="button" onclick='editarMensalidade(<?= json_encode($mensalidade, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>)'>Editar</button></li>
                                <?php if ($mensalidade['status'] !== 'pago'): ?><li><form method="post" action="mensalidades.php" onsubmit="return confirm('Confirmar o recebimento desta mensalidade?')"><input type="hidden" name="acao" value="marcar_pago"><input type="hidden" name="id" value="<?= (int)$mensalidade['id'] ?>"><button class="dropdown-item" type="submit">Registrar pagamento</button></form></li><?php endif; ?>
                            </ul>
                        </div></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
        <div class="gestao-rodape">
            <span id="totalAtraso">Total em atraso: R$ <?= number_format($totalEmAtraso, 2, ',', '.') ?></span>
            <span id="contadorMensalidades">Mostrando 0 a 0 de 0 registros</span>
            <nav aria-label="Paginação de mensalidades"><ul class="pagination pagination-sm mb-0" id="paginacaoMensalidades"></ul></nav>
        </div>
    </div>
</div>

<!-- Aqui ocorre a integração: o formulário gera uma matrícula e suas parcelas no banco. -->
<div class="modal fade" id="modalGerar" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content">
    <form method="post" action="mensalidades.php" id="formGerar"><input type="hidden" name="acao" value="gerar">
        <div class="modal-header"><h5 class="modal-title">Gerar mensalidades</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body"><div class="row g-3">
            <div class="col-md-6"><label class="form-label">Aluno</label><select class="form-select" name="cliente_id" required><option value="">Selecione</option><?php foreach ($alunos as $aluno): ?><option value="<?= (int)$aluno['id'] ?>"><?= h($aluno['nome']) ?></option><?php endforeach; ?></select></div>
            <div class="col-md-6"><label class="form-label">Tipo</label><select class="form-select" name="tipo" id="tipoItem" required><option value="curso">Curso individual</option><option value="pacote">Pacote</option></select></div>
            <div class="col-md-6"><label class="form-label">Curso / pacote</label><select class="form-select" name="item_id" id="itemMensalidade" required><option value="">Selecione</option><?php foreach ($itens as $item): ?><option value="<?= (int)$item['id'] ?>" data-tipo="<?= h($item['tipo']) ?>" data-valor="<?= h($item['valor']) ?>" data-parcelas="<?= h($item['parcelas']) ?>"><?= h($item['nome']) ?> (<?= $item['tipo'] === 'curso' ? 'Individual' : 'Pacote' ?>)</option><?php endforeach; ?></select></div>
            <div class="col-md-6"><label class="form-label">Valor mensal</label><input class="form-control" name="valor" id="valorGerar" placeholder="Ex: 199,90" required></div>
            <div class="col-md-6"><label class="form-label">Primeiro vencimento</label><input type="date" class="form-control" name="primeiro_vencimento" required></div>
            <div class="col-md-6"><label class="form-label">Número de parcelas</label><input type="number" min="1" max="60" class="form-control" name="quantidade" id="quantidadeGerar" required></div>
        </div></div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-laranja">Gerar</button></div>
    </form>
</div></div></div>

<div class="modal fade" id="modalEditarMensalidade" tabindex="-1" aria-hidden="true"><div class="modal-dialog"><div class="modal-content">
    <form method="post" action="mensalidades.php"><input type="hidden" name="acao" value="editar"><input type="hidden" name="id" id="editarIdMensalidade">
        <div class="modal-header"><h5 class="modal-title">Editar mensalidade</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
            <div class="mb-3"><label class="form-label">Valor</label><input class="form-control" name="valor" id="editarValorMensalidade" required></div>
            <div class="mb-3"><label class="form-label">Data de vencimento</label><input type="date" class="form-control" name="data_vencimento" id="editarVencimentoMensalidade" required></div>
            <div class="mb-3"><label class="form-label">Situação</label><select class="form-select" name="status" id="editarStatusMensalidade" required><option value="pendente">Pendente</option><option value="atrasado">Atrasado</option><option value="pago">Pago</option></select></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-laranja">Salvar</button></div>
    </form>
</div></div></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Aqui ocorre a integração: selecionando curso ou pacote, o formulário preenche valor e parcelas sugeridos pelo cadastro.
const modalEditarMensalidade = new bootstrap.Modal(document.getElementById('modalEditarMensalidade'));
function editarMensalidade(item) {
    document.getElementById('editarIdMensalidade').value = item.id;
    document.getElementById('editarValorMensalidade').value = Number(item.valor).toFixed(2).replace('.', ',');
    document.getElementById('editarVencimentoMensalidade').value = item.data_vencimento;
    document.getElementById('editarStatusMensalidade').value = item.status;
    modalEditarMensalidade.show();
}
const tipoItem = document.getElementById('tipoItem');
const itemMensalidade = document.getElementById('itemMensalidade');
function filtrarItens() {
    let primeiraOpcao = itemMensalidade.options[0];
    itemMensalidade.innerHTML = '';
    itemMensalidade.appendChild(primeiraOpcao);
    Array.from(<?= json_encode($itens, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) ?>).forEach(item => {
        if (item.tipo === tipoItem.value) {
            const opcao = document.createElement('option');
            opcao.value = item.id;
            opcao.textContent = item.nome;
            opcao.dataset.valor = item.valor;
            opcao.dataset.parcelas = item.parcelas || '';
            itemMensalidade.appendChild(opcao);
        }
    });
}
tipoItem.addEventListener('change', filtrarItens);
filtrarItens();
itemMensalidade.addEventListener('change', () => {
    const opcao = itemMensalidade.options[itemMensalidade.selectedIndex];
    if (opcao && opcao.dataset.valor) document.getElementById('valorGerar').value = Number(opcao.dataset.valor).toFixed(2).replace('.', ',');
    if (opcao && opcao.dataset.parcelas) document.getElementById('quantidadeGerar').value = opcao.dataset.parcelas;
});
const linhasMensalidades = Array.from(document.querySelectorAll('#tabelaMensalidades tbody tr[data-status]'));
let paginaMensalidades = 1;
const porPaginaMensalidades = 8;

function filtrarMensalidades() {
    const busca = document.getElementById('buscaMensalidade').value.toLowerCase();
    const filtro = document.getElementById('filtroMensalidade').value;
    const filtradas = linhasMensalidades.filter(linha =>
        linha.innerText.toLowerCase().includes(busca) &&
        (filtro === 'todos' || linha.dataset.status === filtro)
    );
    const totalPaginas = Math.max(1, Math.ceil(filtradas.length / porPaginaMensalidades));
    paginaMensalidades = Math.min(paginaMensalidades, totalPaginas);
    linhasMensalidades.forEach(linha => linha.hidden = true);
    filtradas.forEach((linha, indice) => {
        linha.hidden = indice < (paginaMensalidades - 1) * porPaginaMensalidades || indice >= paginaMensalidades * porPaginaMensalidades;
    });
    const inicio = filtradas.length ? (paginaMensalidades - 1) * porPaginaMensalidades + 1 : 0;
    const fim = Math.min(paginaMensalidades * porPaginaMensalidades, filtradas.length);
    document.getElementById('contadorMensalidades').textContent = `Mostrando ${inicio} a ${fim} de ${filtradas.length} registros`;
    const paginacao = document.getElementById('paginacaoMensalidades');
    paginacao.innerHTML = '';
    for (let i = 1; i <= totalPaginas; i++) {
        const item = document.createElement('li');
        item.className = 'page-item' + (i === paginaMensalidades ? ' active' : '');
        const botao = document.createElement('button');
        botao.className = 'page-link';
        botao.type = 'button';
        botao.textContent = i;
        botao.addEventListener('click', () => { paginaMensalidades = i; filtrarMensalidades(); });
        item.appendChild(botao);
        paginacao.appendChild(item);
    }
}
document.getElementById('buscaMensalidade').addEventListener('input', () => { paginaMensalidades = 1; filtrarMensalidades(); });
document.getElementById('filtroMensalidade').addEventListener('change', () => { paginaMensalidades = 1; filtrarMensalidades(); });
filtrarMensalidades();
</script>
</body>
</html>
