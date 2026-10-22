<?php $pagina_atual = 'dashboard.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href = "system.css">
    <link rel="stylesheet" href = "dashboard.css"> 
    <link rel="icon" href="https://baetafilhoadvogados.com.br/wp-content/uploads/2022/09/1-8.png" type="image/svg+xml">
    <link rel="stylesheet" href="./../components/sidebar.css">
    <title>Dashboard</title>
</head>
<body>
    <?php include __DIR__ . '/../components/sidebar.php'; //chama a sidebar ?>
    <div class = "main" >
        <div class = "header">
            <h1 class="title">Dashboard</h1>
            <h6 class="subtitle">Bem-vindo, Administrador!</h6>
        </div>
        <div class ="container">
        <div class='cards'>
        <div class="card card1" style="width: 16rem; color: #ffffff; background-color: #13043a; border-color: #7120db;">
            <div class="card-body">
                <div class="card-header">
                    <i class="bi bi-people me-2"></i>
                    <h5 class="card-title">1000</h5>
                </div>
                <p class="card-text">Alunos ativos</p>
            </div>
        </div>
        <div class="card card2" style="width: 16rem; color: #ffffff; background-color: #948926; border-color: #e0cd23">
            <div class="card-body">
                <div class="card-header">
                    <i class="bi bi-currency-dollar me-2"></i>
                    <h5 class="card-title">100</h5>
                </div>
                <p class="card-text">Mensalidades a receber</p>
            </div>
        </div>
        <div class="card card3" style="width: 16rem; color: #ffffff; background-color: #0e611c; border-color: #28a745">
            <div class="card-body">
                <div class="card-header">
                    <i class="bi bi-check2"></i>
                    <h5 class="card-title">50</h5>
                </div>
                <p class="card-text">Pagamentos recebidos</p>
                </div>
        </div>
        <div class="card card4" style="width: 16rem; color: #ffffff; background-color: #611b1b; border-color: #ac1d1d">
            <div class="card-body">
                <div class="card-header">
                    <i class="bi bi-exclamation-triangle"></i>
                    <h5 class="card-title">25</h5>
                </div>
                <p class="card-text">Mensalidades em atraso</p>
            </div>
        </div>
        </div>
        <div class="table_dashboard">
            <div class="table-dashboard-header">
                <h1>Mensalidades em atraso</h1>
                <button type="button" class="btn btn-primary">Ver todas <i class="bi bi-arrow-right-short"></i></button>
            </div>
            <table class="table table-dark table-hover " style="border-radius:10px;">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Valor</th>
                        <th>Data de vencimento</th>
                        <th>Dias em atraso</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bárbara Carvalho</td>
                        <td>R$ 100,00</td>
                        <td>10/09/2026</td>
                        <td><span class="badge text-bg-danger">5</span></td>
                    </tr>
                    <tr>
                        <td>Érica Monteiro</td>
                        <td>R$ 150,00</td>
                        <td>15/09/2026</td>
                        <td><span class="badge text-bg-danger">10</span></td>
                    </tr>
                    <tr>
                        <td>Rayane Pereira</td>
                        <td>R$ 200,00</td>
                        <td>20/09/2026</td>
                        <td><span class="badge text-bg-danger">15</span></td>
                    </tr>
                    <tr>
                        <td>Carlos Oliveira</td>
                        <td>R$ 250,00</td>
                        <td>25/09/2026</td>
                        <td><span class="badge text-bg-danger">20</span></td>
                    </tr>
                    <tr>
                        <td>Ana Fonseca</td>
                        <td>R$ 300,00</td>
                        <td>30/09/2026</td>
                        <td><span class="badge text-bg-danger">25</span></td>
                    </tr>
                    <tr>
                        <td>Roberto Araújo</td>
                        <td>R$ 350,00</td>
                        <td>05/10/2026</td>
                        <td><span class="badge text-bg-danger">30</span></td>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>