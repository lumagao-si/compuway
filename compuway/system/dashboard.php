<?php
// Aqui ocorre a integração: exige login e busca os indicadores reais no banco.
require_once __DIR__ . "/../pages/verificar_admin.php";
require_once __DIR__ . "/../backend/conexao.php";
require_once __DIR__ . "/../backend/financeiro.php";
$pagina_atual = 'dashboard.php';
$resumo = obter_resumo_financeiro($conexao);
$alunosAtivos = 0;
$resultadoAlunos = $conexao->query("SELECT COUNT(*) AS total FROM clientes WHERE ativo = 1");
if ($resultadoAlunos) { $alunosAtivos = (int)$resultadoAlunos->fetch_assoc()['total']; }
$mensalidadesReceber = (int)$resumo['pendente']['quantidade'] + (int)$resumo['atrasado']['quantidade'];
$pagamentosRecebidos = (int)$resumo['recebido']['quantidade'];
$mensalidadesAtrasadas = (int)$resumo['atrasado']['quantidade'];
?>
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
    <link rel="stylesheet" href="../components/sidebar.css">
    <title>Dashboard</title>
</head>
<body>
    <?php include __DIR__ . '/../components/sidebar.php'; //chama a sidebar ?>
    <div class = "main" >
        <div class = "header">
            <h1 class="title">Dashboard</h1>
            <h6 class="subtitle">Bem-vindo, <?= htmlspecialchars($_SESSION['admin_nome'] ?? 'Administrador') ?>!</h6>
        </div>
        <div class ="container">
        <div class='cards'>
        <div class="card card1" style="width: 16rem; color: #ffffff; background-color: #13043a; border-color: #7120db;">
            <div class="card-body">
                <div class="card-header">
                    <i class="bi bi-people me-2"></i>
                    <h5 class="card-title"><?= $alunosAtivos ?></h5>
                </div>
                <p class="card-text">Alunos ativos</p>
            </div>
        </div>
        <div class="card card2" style="width: 16rem; color: #ffffff; background-color: #948926; border-color: #e0cd23">
            <div class="card-body">
                <div class="card-header">
                    <i class="bi bi-currency-dollar me-2"></i>
                    <h5 class="card-title"><?= $mensalidadesReceber ?></h5>
                </div>
                <p class="card-text">Mensalidades a receber</p>
            </div>
        </div>
        <div class="card card3" style="width: 16rem; color: #ffffff; background-color: #0e611c; border-color: #28a745">
            <div class="card-body">
                <div class="card-header">
                    <i class="bi bi-check2"></i>
                    <h5 class="card-title"><?= $pagamentosRecebidos ?></h5>
                </div>
                <p class="card-text">Pagamentos recebidos</p>
                </div>
        </div>
        <div class="card card4" style="width: 16rem; color: #ffffff; background-color: #611b1b; border-color: #ac1d1d">
            <div class="card-body">
                <div class="card-header">
                    <i class="bi bi-exclamation-triangle"></i>
                    <h5 class="card-title"><?= $mensalidadesAtrasadas ?></h5>
                </div>
                <p class="card-text">Mensalidades em atraso</p>
            </div>
        </div>
        </div>
        <div class="table_dashboard">
            <div class="table-dashboard-header">
                <h1>Mensalidades em atraso</h1>
                <a href="mensalidades.php" class="btn btn-primary">Ver todas <i class="bi bi-arrow-right-short"></i></a>
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
                    <?php if (empty($resumo['lista_atrasados'])): ?>
                        <tr><td colspan="4">Nenhuma mensalidade em atraso.</td></tr>
                    <?php else: ?>
                        <?php foreach (array_slice($resumo['lista_atrasados'], 0, 6) as $mensalidade): ?>
                            <tr>
                                <td><?= htmlspecialchars($mensalidade['cliente']) ?></td>
                                <td>R$ <?= number_format($mensalidade['valor'], 2, ',', '.') ?></td>
                                <td><?= date('d/m/Y', strtotime($mensalidade['data_vencimento'])) ?></td>
                                <td><span class="badge text-bg-danger"><?= (int)$mensalidade['dias_atraso'] ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>