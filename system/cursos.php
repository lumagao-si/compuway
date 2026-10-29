<?php $pagina_atual = 'cursos.php'; ?>
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
                <input type="search" class="busca" id="floatingInputGroup1" placeholder="Buscar curso ou pacote">
                <button class="pesquisar"><i class="bi bi-search"></i></button>
            </div>
            <select class="filter1" aria-label="Default select example">
                <option selected>Todos os tipos</option>
                <option value="1">Cursos individuais</option>
                <option value="2">Pacotes</option>
            </select>
            <select class="filter2" aria-label="Default select example">
                <option selected>Todos os status</option>
                <option value="1">Ativos</option>
                <option value="2">Inativos</option>
            </select>
            <button type="button" class="btn btn-primary cadastrar-cursos" data-bs-toggle="modal"
                data-bs-target="#cadastroCursos"
                style="background-color: #F58634; color: #000000; border-color: #F58634; gap: 20px; height: 50px;">
                <i class="bi bi-plus-lg"></i>Cadastrar curso ou pacote</button>
            <div class="modal fade" tabindex="-1" id="cadastroCursos">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cadastrar curso ou pacote</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form mb-3">
                                <label for="selecionarTipo" class="form-label mb-2">Tipo</label>
                                <select class="form-select" id="selecionarTipo"
                                    aria-label="Floating label select example">
                                    <option selected>Selecionar</option>
                                    <option value="curso">Curso Individual</option>
                                    <option value="pacote">Pacote</option>
                                </select>
                            </div>
                            <div id="camposCurso" hidden>
                                <div class="form mb-3">
                                    <label for="nomeCurso" class="form-label mb-2">Nome do curso</label>
                                    <input type="text" class="form-control" id="nomeCurso"
                                        placeholder="Ex: Pacote Office">
                                </div>

                                <div class="form mb-3">
                                    <label for="valorMensal" class="form-label mb-2">Valor da mensalidade</label>
                                    <input type="text" class="form-control" id="valorMensal"
                                        placeholder="Ex: R$ 100,00">
                                </div>
                                <div class="form mb-3">
                                    <label for="cargaHoraria" class="form-label mb-2">Carga horária</label>
                                    <input type="text" class="form-control" id="cargaHoraria" placeholder="Ex: 120h">

                                </div>
                                <div class="form mb-3">
                                    <label for="duracaoCurso" class="form-label mb-2">Duração (meses)</label>
                                    <input type="text" class="form-control" id="duracaoCurso"
                                        placeholder="Ex: 12 meses">

                                </div>
                                <div class="form mb-3">
                                    <label for="descricao" class="form-label mb-2">Descrição (Opcional)</label>
                                    <textarea type="text" class="form-control" id="descricao"
                                        placeholder="Ex: Descrição do curso">
                                </textarea>
                                </div>
                            </div>
                            <div id="camposPacote" hidden>
                                <div class="form mb-3">
                                    <label for="nomePacote" class="form-label mb-2">Nome do pacote</label>
                                    <input type="text" class="form-control" id="nomePacote"
                                        placeholder="Ex: Pacote Office">
                                </div>
                                <div class="form mb-3">
                                    <label for="valorPacote" class="form-label mb-2">Valor do pacote</label>
                                    <input type="text" class="form-control" id="valorPacote"
                                        placeholder="Ex: R$ 150,00">
                                </div>
                                <div class="form mb-3">
                                    <label for="descricaoPacote" class="form-label mb-2">Descrição (opcional)</label>
                                    <textarea class="form-control" id="descricaoPacote"
                                        placeholder="Quais cursos estão incluídos no pacote?"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary fechar"
                                data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary cadastrarCurso">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container_cursos">
            <div class="table_cursos">
                <table class="table table-dark table-hover" style="border-radius: 10px;">
                    <thead class="thead-cursos">
                        <tr>
                            <th>Nome</th>
                            <th>Valor mensal</th>
                            <th>Duração</th>
                            <th>Tipo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Informática</td>
                            <td>R$ 100,00</td>
                            <td>12 meses</td>
                            <td><span class="badge theme-primary badge-curso">Curso Individual</span></td>
                            <td><i class="bi bi-three-dots-vertical"></i></td>
                        </tr>
                        <tr>
                            <td>Técnico em Hardware</td>
                            <td>R$ 100,00</td>
                            <td>12 meses</td>
                            <td><span class="badge theme-primary badge-curso">Curso Individual</span></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Visualizar</a></li>
                                        <li><a class="dropdown-item" href="#">Editar</a></li>
                                        <li><a class="dropdown-item" href="#">Desativar</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Power BI</td>
                            <td>R$ 100,00</td>
                            <td>--</td>
                            <td><span class="badge theme-primary badge-pacote">Pacote</span></td>
                            <td><i class="bi bi-three-dots-vertical"></i></td>
                        </tr>
                        <tr>
                            <td>Pacote Office</td>
                            <td>R$ 100,00</td>
                            <td>--</td>
                            <td><span class="badge theme-primary badge-pacote">Pacote</span></td>
                            <td><i class="bi bi-three-dots-vertical"></i></td>
                        </tr>
                        <tr>
                            <td>Photoshop</td>
                            <td>R$ 100,00</td>
                            <td>12 meses</td>
                            <td><span class="badge theme-primary badge-curso">Curso Individual</span></td>
                            <td><i class="bi bi-three-dots-vertical"></i></td>
                        </tr>
                        <tr>
                            <td>Gestão em RH</td>
                            <td>R$ 100,00</td>
                            <td>12 meses</td>
                            <td><span class="badge theme-primary badge-curso">Curso Individual</span></td>
                            <td><i class="bi bi-three-dots-vertical"></i></td>
                        </tr>
                        <tr>
                            <td>Auxiliar de Escritório</td>
                            <td>R$ 100,00</td>
                            <td>12 meses</td>
                            <td><span class="badge theme-primary badge-curso">Curso Individual</span></td>
                            <td><i class="bi bi-three-dots-vertical"></i></td>
                        </tr>
                        <tr>
                            <td>Atendente de Farmácia</td>
                            <td>R$ 100,00</td>
                            <td>12 meses</td>
                            <td><span class="badge theme-primary badge-curso">Curso Individual</span></td>
                            <td><i class="bi bi-three-dots-vertical"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="registros">
                <p>Mostrando 1 a 8 de 150 registros</p>
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-current="page">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const selecionarTipo = document.getElementById("selecionarTipo");
            const camposCurso = document.getElementById("camposCurso");
            const camposPacote = document.getElementById("camposPacote");

            selecionarTipo.addEventListener('change', function () {  //de acordo com o evento muda os campos
                camposCurso.hidden = true;
                camposPacote.hidden = true;

                if (this.value === 'curso') {
                    camposCurso.hidden = false;
                } else if (this.value === 'pacote') {
                    camposPacote.hidden = false;
                }
            });
        </script>
</body>

</html>