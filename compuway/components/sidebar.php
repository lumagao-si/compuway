<?php $pagina_atual = basename($_SERVER['PHP_SELF']); ?>

<div class="sidebar">
    <img class="sidebar-logo" src="https://baetafilhoadvogados.com.br/wp-content/uploads/2022/09/1-8.png">

    <div class="options">
        <a href="dashboard.php" class="option <?php echo $pagina_atual=="dashboard.php" ? "active" : ""; ?>">
            <i class="bi bi-house-door me-2"></i> Início
        </a>

        <a href="alunos.php" class="option <?php echo $pagina_atual=="alunos.php" ? "active" : ""; ?>">
            <i class="bi bi-people me-2"></i> Alunos
        </a>

        <a href="mensalidades.php" class="option <?php echo $pagina_atual=="mensalidades.php" ? "active" : ""; ?>">
            <i class="bi bi-currency-dollar me-2"></i> Mensalidades
        </a>

        <a href="cursos.php" class="option <?php echo $pagina_atual=="cursos.php" ? "active" : ""; ?>">
            <i class="bi bi-book me-2"></i> Cursos
        </a>

        <a href="#" class="sair option" data-bs-toggle="modal" data-bs-target="#modalSair">
            <i class="bi bi-box-arrow-right me-2"></i> Sair
        </a>
    </div>
</div>

<div class="modal fade" id="modalSair" tabindex="-1" aria-labelledby="tituloModalSair" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModalSair">Confirmar saída</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                Tem certeza de que deseja sair da área administrativa?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>

                <a href="../backend/integracao_sair.php" class="btn btn-laranja text-decoration-none">
                    Sim, sair
                </a>
            </div>
        </div>
    </div>
</div>

