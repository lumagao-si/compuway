<?php $pagina_atual = 'cursos.php';

//Array pra preencher a tabela 
$cursos = [
    ['id' => 1, 'nome' => 'Operador de Micro Computador e Compukids', 'tipo' => 'pacote', 'valor' => '299,90', 'carga' => '121', 'parcelas' => 16, 'descricao' => 'Introdução à informática, Windows 10, Word 2016, Excel 2016, PowerPoint 2016, Internet 9, CDA'],
    ['id' => 2, 'nome' => 'Atendimento de Farmácia', 'tipo' => 'pacote', 'valor' => '299,90', 'carga' => '96', 'parcelas' => 16, 'descricao' => 'Atendimento ao Cliente, Técnicas de Vendas, Atendimento de Farmácia, Operador de Caixa, Marketing Pessoal'],
    ['id' => 3, 'nome' => 'Gestão de Negócio e Vendas', 'tipo' => 'pacote', 'valor' => '299,90', 'carga' => '85', 'parcelas' => 16, 'descricao' => 'Técnicas de Administração, Contabilidade Matemática Financeira, Recursos Humanos, Técnicas de Vendas, Auxiliar de Escritório'],
    ['id' => 4, 'nome' => 'Designer Gráfico', 'tipo' => 'pacote', 'valor' => '299,90', 'carga' => '63', 'parcelas' => 16, 'descricao' => 'Photoshop, Corel, Ilustrador, Téc. Publicidade e Propaganda, Marketing'],
    ['id' => 5, 'nome' => 'Excel Financeiro', 'tipo' => 'pacote', 'valor' => '299,90', 'carga' => '40', 'parcelas' => 5, 'descricao' => 'Excel 2016, Excel Avançado'],
    ['id' => 6, 'nome' => 'Tecnokids', 'tipo' => 'pacote', 'valor' => '299,90', 'carga' => '94', 'parcelas' => 16, 'descricao' => 'Photoshop, Corel, Youtuber, Criação de Games, Robótica'],
    ['id' => 7, 'nome' => 'Excel 2016', 'tipo' => 'curso', 'valor' => '280,00', 'carga' => '16', 'parcelas' => 2, 'descricao' => ''],
    ['id' => 8, 'nome' => 'Excel Avançado', 'tipo' => 'individual', 'valor' => 450.00, 'carga' => 40, 'parcelas' => 3, 'descricao' => ''],
['id' => 9, 'nome' => 'Pacote Design Gráfico', 'tipo' => 'pacote', 'valor' => 900.00, 'carga' => 120, 'parcelas' => 6, 'descricao' => 'CorelDRAW, Photoshop, Illustrator'],
['id' => 10, 'nome' => 'Power BI', 'tipo' => 'individual', 'valor' => 500.00, 'carga' => 40, 'parcelas' => 3, 'descricao' => ''],
['id' => 11, 'nome' => 'Pacote Informática Básica', 'tipo' => 'pacote', 'valor' => 700.00, 'carga' => 100, 'parcelas' => 5, 'descricao' => 'Windows, Word, Excel e Internet'],
['id' => 12, 'nome' => 'Lógica de Programação', 'tipo' => 'individual', 'valor' => 600.00, 'carga' => 60, 'parcelas' => 4, 'descricao' => ''],


];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="system.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="cursos.css">
    <link rel="icon" href="https://baetafilhoadvogados.com.br/wp-content/uploads/2022/09/1-8.png" type="image/svg+xml">
    <link rel="stylesheet" href="./../components/sidebar.css">
    <title>Cursos</title>
</head>

<body>
    <?php include __DIR__ . '/../components/sidebar.php'; //chama a sidebar ?>
    <div class="main">
        <div class="header-cursos">
            <h1 class="title">Cursos</h1>
        </div>
        <div class="acoes">
            <div class="busca-container">
                <i class="bi bi-search"></i>
                <input type="search" class="busca" id="buscarCurso" placeholder="Buscar curso ou pacote">
            </div>
            <select class="filter" id="filtrarTipo" aria-label="Filtrar por tipo">
                <option value="" selected>Todos os tipos</option>
                <option value="curso">Cursos individuais</option>
                <option value="pacote">Pacotes</option>
            </select>
            <button type="button" class="btn btn-primary cadastrar-cursos" data-bs-toggle="modal"
                data-bs-target="#cadastroCursos"
                style="background-color: #F58634; color: #000000; border-color: #F58634; gap: 20px; height: 50px;">
                <i class="bi bi-plus-lg"></i>Cadastrar curso ou pacote</button>
        </div>
        <div class="container_cursos">
            <div class="table_cursos">
                <table class="table table-dark table-hover" style="border-radius: 10px;">
                    <thead class="thead-cursos">
                        <tr>
                            <th>Nome</th>
                            <th>Valor mensal</th>
                            <th>Parcelas</th>
                            <th>Tipo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cursos as $c): ?>
                            <tr data-id="<?= $c['id'] ?>" data-nome="<?= htmlspecialchars($c['nome'], ENT_QUOTES) ?>"
                                data-tipo="<?= $c['tipo'] ?>" data-valor="<?= $c['valor'] ?>"
                                data-carga="<?= $c['carga'] ?>" data-parcelas="<?= $c['parcelas'] ?>"
                                data-descricao="<?= htmlspecialchars($c['descricao'], ENT_QUOTES) ?>">
                                <td><?= htmlspecialchars($c['nome']) ?></td>
                                <td>R$ <?= $c['valor'] ?></td>
                                <td><?= $c['parcelas'] ?></td>
                                <td>
                                    <?php if ($c['tipo'] === 'pacote'): ?>
                                        <span class="badge theme-primary badge-pacote">Pacote</span>
                                    <?php else: ?>
                                        <span class="badge theme-primary badge-curso">Curso Individual</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn-acoes dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false" aria-label="Ações">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#visualizarCurso">Visualizar</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editarCurso">Editar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr id="semResultados" hidden>
                            <td colspan="5" class="sem-resultados">Nenhum resultado encontrado</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="registros">
                <p id="contador">Mostrando 1 a <?= count($cursos) ?> de <?= count($cursos) ?> registros</p>
                <nav aria-label="Paginação">
                    <ul class="pagination" id="paginacao"></ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Cadastrar curso ou pacote -->
    <div class="modal fade" tabindex="-1" id="cadastroCursos">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" action="salvar_curso.php">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastrar curso ou pacote</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form mb-3">
                            <label for="selecionarTipo" class="form-label mb-2">Tipo</label>
                            <select class="form-select" id="selecionarTipo" aria-label="Selecionar curso ou pacote"
                                name="tipo" required>
                                <option value="" selected disabled>Selecionar</option>
                                <option value="curso">Curso Individual</option>
                                <option value="pacote">Pacote</option>
                            </select>
                        </div>
                        <div id="camposComuns" hidden>
                            <div class="form mb-3">
                                <label for="nome" class="form-label mb-2">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    placeholder="Ex: Pacote Office" required>
                            </div>
                            <div class="form mb-3">
                                <label for="valorMensal" class="form-label mb-2">Valor mensal de tabela</label>
                                <input type="text" class="form-control" id="valorMensal" name="valor"
                                    placeholder="Ex: R$ 299,90" required>
                            </div>
                            <div class="form mb-3">
                                <label for="parcelas" class="form-label mb-2">Número de parcelas</label>
                                <input type="number" min="1" class="form-control" id="parcelas" name="parcelas"
                                    placeholder="Ex: 16" required>
                            </div>
                            <div class="form mb-3">
                                <label for="cargaHoraria" class="form-label mb-2">Carga horária (horas)</label>
                                <input type="number" min="1" class="form-control" id="cargaHoraria" name="carga_horaria"
                                    placeholder="Ex: 120">
                            </div>
                            <div class="form mb-3">
                                <label for="descricao" class="form-label mb-2" id="labelDescricao">Descrição
                                    (opcional)</label>
                                <textarea class="form-control" id="descricao" name="descricao"
                                    placeholder="Ex: Descrição do curso"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary fechar" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary cadastrarCurso">Cadastrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Visualizar-->
    <div class="modal fade" tabindex="-1" id="visualizarCurso">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-5 text-secondary">Nome</div>
                        <div class="col-7" id="v-nome"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-secondary">Tipo</div>
                        <div class="col-7" id="v-tipo"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-secondary">Valor mensal</div>
                        <div class="col-7" id="v-valor"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-secondary">Parcelas</div>
                        <div class="col-7" id="v-parcelas"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-secondary">Carga horária</div>
                        <div class="col-7" id="v-carga"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-secondary" id="v-label-descricao">Descrição</div>
                        <div class="col-7" id="v-descricao"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fechar" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Editar -->
    <div class="modal fade" tabindex="-1" id="editarCurso">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Crie o arquivo atualizar_curso.php para receber estes dados -->
                <form method="post" action="atualizar_curso.php">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar curso ou pacote</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="e-id" name="id"> <!-- o id diz ao PHP qual curso atualizar -->
                        <div class="form mb-3">
                            <label for="e-tipo" class="form-label mb-2">Tipo</label>
                            <select class="form-select" id="e-tipo" name="tipo" required>
                                <option value="curso">Curso Individual</option>
                                <option value="pacote">Pacote</option>
                            </select>
                        </div>
                        <div class="form mb-3">
                            <label for="e-nome" class="form-label mb-2">Nome</label>
                            <input type="text" class="form-control" id="e-nome" name="nome" required>
                        </div>
                        <div class="form mb-3">
                            <label for="e-valor" class="form-label mb-2">Valor mensal de tabela</label>
                            <input type="text" class="form-control" id="e-valor" name="valor" required>
                        </div>
                        <div class="form mb-3">
                            <label for="e-parcelas" class="form-label mb-2">Número de parcelas</label>
                            <input type="number" min="1" class="form-control" id="e-parcelas" name="parcelas" required>
                        </div>
                        <div class="form mb-3">
                            <label for="e-carga" class="form-label mb-2">Carga horária (horas)</label>
                            <input type="number" min="1" class="form-control" id="e-carga" name="carga_horaria">
                        </div>
                        <div class="form mb-3">
                            <label for="e-descricao" class="form-label mb-2">Descrição (no pacote, os cursos na
                                ordem)</label>
                            <textarea class="form-control" id="e-descricao" name="descricao"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary fechar" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary cadastrarCurso">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        //JavaScript

        //Cadastro
        const selecionarTipo = document.getElementById("selecionarTipo");
        const camposComuns = document.getElementById("camposComuns");
        const labelDescricao = document.getElementById("labelDescricao");
        const descricao = document.getElementById('descricao');

        function mostrarCamposDoTipo() {   //de acordo com o evento muda os campos
            camposComuns.hidden = false;
            if (this.value === 'pacote') {
                labelDescricao.textContent = 'Cursos do pacote, na ordem';
                descricao.placeholder = 'Ex: Word, Excel, PowerPoint';
                descricao.required = true;      // no pacote, os cursos são obrigatórios
            } else {
                labelDescricao.textContent = 'Descrição (opcional)';
                descricao.placeholder = 'Ex: Descrição do curso';
                descricao.required = false;
            }
        };

        selecionarTipo.addEventListener('change', mostrarCamposDoTipo);

        //Limpa o modal após fechar
        function limparModalCadastro() {
            this.querySelector('form').reset();
            camposComuns.hidden = true;
        };

        document.getElementById('cadastroCursos').addEventListener('hidden.bs.modal', limparModalCadastro);

        //Visualização
        function preencherVisualizacao(e) {
            const d = e.relatedTarget.closest('tr').dataset;
            const ehPacote = d.tipo === 'pacote';
            document.getElementById('v-nome').textContent = d.nome;
            document.getElementById('v-tipo').textContent = ehPacote ? 'Pacote' : 'Curso Individual';
            document.getElementById('v-valor').textContent = 'R$ ' + d.valor;
            document.getElementById('v-parcelas').textContent = d.parcelas;
            document.getElementById('v-carga').textContent = d.carga ? d.carga + ' h' : '—';
            document.getElementById('v-label-descricao').textContent = ehPacote ? 'Cursos do pacote' : 'Descrição';
            document.getElementById('v-descricao').textContent = d.descricao || '—';
        };

        document.getElementById('visualizarCurso').addEventListener('show.bs.modal', preencherVisualizacao);

        //Edição
        function preencherEdicao(e) {
            const d = e.relatedTarget.closest('tr').dataset;
            document.getElementById('e-id').value = d.id;
            document.getElementById('e-tipo').value = d.tipo;
            document.getElementById('e-nome').value = d.nome;
            document.getElementById('e-valor').value = d.valor;
            document.getElementById('e-parcelas').value = d.parcelas;
            document.getElementById('e-carga').value = d.carga;
            document.getElementById('e-descricao').value = d.descricao;
        };
        document.getElementById('editarCurso').addEventListener('show.bs.modal', preencherEdicao);

        function limparModalEdicao() {
            this.querySelector('form').reset();
        };

        document.getElementById('editarCurso').addEventListener('hidden.bs.modal', limparModalEdicao);

        // Busca e filtro
        const campoBusca = document.getElementById('buscarCurso');
        const filtroTipo = document.getElementById('filtrarTipo');
        const semResultados = document.getElementById('semResultados');
        const contador = document.getElementById('contador');
        const paginacao = document.getElementById('paginacao');

        // Guarda todas as linhas da tabela
        const linhas = Array.from(
            document.querySelectorAll('tbody tr[data-nome]')
        );

        // Configuração da paginação
        const registrosPorPagina = 7;
        let paginaAtual = 1;
        let linhasFiltradas = [...linhas];

        // Cria um botão da paginação
        function criarBotaoPagina(texto, numero, desabilitado = false) {
            const item = document.createElement('li');
            item.classList.add('page-item');

            if (desabilitado) {
                item.classList.add('disabled');
            }

            if (numero === paginaAtual && texto === String(paginaAtual)) {
                item.classList.add('active');
            }

            const botao = document.createElement('button');
            botao.type = 'button';
            botao.classList.add('page-link');
            botao.textContent = texto;
            botao.disabled = desabilitado;

            botao.addEventListener('click', function () {
                paginaAtual = numero;
                atualizarTabela();
            });

            item.appendChild(botao);
            paginacao.appendChild(item);
        }

        // Monta os botões da paginação
        function montarPaginacao(totalPaginas) {
            paginacao.innerHTML = '';

            if (totalPaginas <= 1) return;

            criarBotaoPagina('Anterior', paginaAtual - 1, paginaAtual === 1);

            for (let i = 1; i <= totalPaginas; i++) {
                criarBotaoPagina(String(i), i);
            }

            criarBotaoPagina(
                'Próximo',
                paginaAtual + 1,
                paginaAtual === totalPaginas
            );
        }

        // Atualiza a tabela conforme a busca, o filtro e a página
        function atualizarTabela() {
            const pesquisa = campoBusca.value.toLowerCase().trim();
            const tipo = filtroTipo.value;

            // Filtra os cursos pelo nome e pelo tipo
            linhasFiltradas = linhas.filter(function (linha) {
                const combinaNome = linha.dataset.nome
                    .toLowerCase()
                    .includes(pesquisa);

                const combinaTipo = tipo === '' || linha.dataset.tipo === tipo;

                return combinaNome && combinaTipo;
            });

            const totalRegistros = linhasFiltradas.length;
            const totalPaginas = Math.ceil(totalRegistros / registrosPorPagina);

            // Ajusta a página caso ela não exista mais após o filtro
            if (paginaAtual > totalPaginas) {
                paginaAtual = Math.max(1, totalPaginas);
            }

            // Esconde todas as linhas
            linhas.forEach(function (linha) {
                linha.style.display = 'none';
            });

            // Calcula os registros da página atual
            const inicio = (paginaAtual - 1) * registrosPorPagina;
            const fim = Math.min(inicio + registrosPorPagina, totalRegistros);

            // Mostra somente os registros da página atual
            linhasFiltradas.slice(inicio, fim).forEach(function (linha) {
                linha.style.display = '';
            });

            // Exibe a mensagem quando não há resultados
            semResultados.hidden = totalRegistros > 0;

            // Atualiza o contador
            if (totalRegistros > 0) {
                contador.textContent =
                    `Mostrando ${inicio + 1} a ${fim} de ${totalRegistros} registros`;
            } else {
                contador.textContent = 'Nenhum registro encontrado';
            }

            montarPaginacao(totalPaginas);
        }

        // Quando o usuário pesquisa
        campoBusca.addEventListener('input', function () {
            paginaAtual = 1;
            atualizarTabela();
        });

        // Quando o usuário seleciona um tipo
        filtroTipo.addEventListener('change', function () {
            paginaAtual = 1;
            atualizarTabela();
        });

        // Mostra a primeira página ao carregar
        atualizarTabela();
    </script>
</body>

</html>