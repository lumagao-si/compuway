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
            <button type="button" class="btn btn-primary cadastrar-cursos" data-bs-toggle="modal" data-bs-target="#cadastro-cursos"
                style="background-color: #F58634; color: #000000; border-color: #F58634; gap: 20px; height: 50px;">
                <i class="bi bi-plus-lg"></i>Cadastrar curso ou pacote</button>
            <div class="modal" tabindex="-1" id="cadastro-cursos">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cadastrar curso ou pacote</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option selected>Selecionar</option>
                                    <option value="1">Curso Individual</option>
                                    <option value="2">Pacote</option>
                                </select>
                                <label for="floatingSelect">Tipo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="Ex: Pacote Office">
                                <label for="floatingInput">Nome do curso</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Ex: R$ 100,00">
                                <label for="floatingPassword">Valor da mensalidade</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="Ex: 120h">
                                <label for="floatingInput">Carga horária</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Ex: 12 meses">
                                <label for="floatingPassword">Duração (meses)</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Ex: Descrição do curso">
                                <label for="floatingPassword">Descrição (Opcional)</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary">Cadastrar</button>
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
                            <td><i class="bi bi-three-dots-vertical"></i></td>
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
</body>

</html>