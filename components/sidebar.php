<?php $pagina_atual = basename($_SERVER['PHP_SELF']); //identifica a página atual?> 

<div class = "sidebar">
        <img class = "sidebar-logo"src = "https://baetafilhoadvogados.com.br/wp-content/uploads/2022/09/1-8.png">
        <div class = "options">
            <a href="dashboard.php" class="option <?php echo $pagina_atual=="dashboard.php" ? "active" : ""; ?>"> <i class="bi bi-house-door me-2"></i> Início</a>
            <a href="alunos.php" class="option <?php echo $pagina_atual=="alunos.php" ? "active" : ""; ?>"> <i class="bi bi-people me-2"></i>Alunos</a>
            <a href="mensalidades.php" class="option <?php echo $pagina_atual=="mensalidades.php" ? "active" : ""; ?>"> <i class="bi bi-currency-dollar me-2"></i> Mensalidades</a>
            <a href="cursos.php" class="option <?php echo $pagina_atual=="cursos.php" ? "active" : ""; ?>"> <i class="bi bi-book me-2"></i> Cursos</a>
            <a href="sair.php" class="sair option  <?php echo $pagina_atual=="sair.php" ? "active" : ""; ?>"> <i class="bi bi-box-arrow-right me-2"></i> Sair</a>
        </div>
    </div>
