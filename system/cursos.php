<?php $pagina_atual = 'cursos.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "system.css"> 
    <link rel="stylesheet" href = "cursos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="icon" href="https://baetafilhoadvogados.com.br/wp-content/uploads/2022/09/1-8.png" type="image/svg+xml">
    <link rel="stylesheet" href="./../components/sidebar.css">
    <title>Cursos</title>
</head>
<body>
    <?php include './system/../components/sidebar.php'; //chama a sidebar ?>
    <div class= "main">
        <div class="header-cursos">
            <h1 class="title">Cursos</h1>
        </div>
        <div class="acoes">
            <!-- <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <div class="form-floating">
                    <input type="search" class="form-control" id="floatingInputGroup1" placeholder="Busca">
                    <label for="floatingInputGroup1">Buscar curso ou pacote</label>
                </div>
            </div> -->
            <input type="search" class="busca" placeholder="Buscar curso ou pacote">
            <select class="filter1" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <select class="filter2" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <button type="button" class="btn btn-primary">Primary</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>