<?php
 
 
 
 

 
const MULTA_PERCENTUAL      = 2.0;   
const JUROS_MENSAL_PERCENTUAL = 1.0;  

 
 
 
 
 
 
 
function atualizar_atrasados(mysqli $conexao): int
{
    $stmt = $conexao->prepare(
        "UPDATE pagamentos SET status = 'atrasado'
         WHERE status = 'pendente' AND data_vencimento < CURDATE()"
    );
    $stmt->execute();
    $marcados = $stmt->affected_rows;
    $stmt->close();

    $stmt = $conexao->prepare(
        "UPDATE pagamentos SET status = 'pendente'
         WHERE status = 'atrasado' AND data_vencimento >= CURDATE()"
    );
    $stmt->execute();
    $stmt->close();

    return $marcados;
}

 
 
 
 
function dias_em_atraso(string $data_vencimento, ?string $referencia = null): int
{
    $venc = new DateTime($data_vencimento);
    $ref  = new DateTime($referencia ?? date("Y-m-d"));
    $venc->setTime(0, 0);
    $ref->setTime(0, 0);

    if ($ref <= $venc) {
        return 0;
    }
    return (int) $venc->diff($ref)->days;
}

 
 
 
 
 
 
function calcular_juros(float $valor, string $data_vencimento, ?string $referencia = null): array
{
    $dias = dias_em_atraso($data_vencimento, $referencia);

    if ($dias === 0) {
        return ["dias" => 0, "multa" => 0.0, "juros" => 0.0, "total" => round($valor, 2)];
    }

    $multa = $valor * (MULTA_PERCENTUAL / 100);
    $juros = $valor * (JUROS_MENSAL_PERCENTUAL / 100 / 30) * $dias;

    return [
        "dias"  => $dias,
        "multa" => round($multa, 2),
        "juros" => round($juros, 2),
        "total" => round($valor + $multa + $juros, 2),
    ];
}

 
function moeda(float $v): string
{
    return "R$ " . number_format($v, 2, ",", ".");
}

 
 
 
 
 
function obter_resumo_financeiro(mysqli $conexao): array
{
     
    atualizar_atrasados($conexao);

     
    $totais = ["pago" => [0, 0.0], "pendente" => [0, 0.0], "atrasado" => [0, 0.0]];
    $res = $conexao->query("SELECT status, COUNT(*) AS qtd, COALESCE(SUM(valor),0) AS total FROM pagamentos GROUP BY status");
    while ($l = $res->fetch_assoc()) {
        if (isset($totais[$l["status"]])) {
            $totais[$l["status"]] = [(int)$l["qtd"], (float)$l["total"]];
        }
    }

     
    $recebido_mes = (float) $conexao->query(
        "SELECT COALESCE(SUM(valor),0) AS t FROM pagamentos
         WHERE status = 'pago'
           AND MONTH(data_pagamento) = MONTH(CURDATE())
           AND YEAR(data_pagamento)  = YEAR(CURDATE())"
    )->fetch_assoc()["t"];

     
    $inadimplentes = (int) $conexao->query(
        "SELECT COUNT(DISTINCT cliente_id) AS t FROM pagamentos WHERE status = 'atrasado'"
    )->fetch_assoc()["t"];

     
    $atrasados = [];
    $encargos = 0.0;
    $total_atualizado = 0.0;

    $res = $conexao->query(
        "SELECT p.id, p.valor, p.data_vencimento, c.nome AS cliente,
                COALESCE(cu.nome, pa.nome, 'Curso/pacote') AS curso
         FROM pagamentos p
         JOIN clientes c ON c.id = p.cliente_id
         LEFT JOIN cursos cu ON cu.id = p.curso_id
         LEFT JOIN pacotes pa ON pa.id = p.pacote_id
         WHERE p.status = 'atrasado'
         ORDER BY p.data_vencimento ASC"
    );
    while ($l = $res->fetch_assoc()) {
        $calc = calcular_juros((float)$l["valor"], $l["data_vencimento"]);
        $encargos         += $calc["multa"] + $calc["juros"];
        $total_atualizado += $calc["total"];
        $atrasados[] = [
            "id"              => (int)$l["id"],
            "cliente"         => $l["cliente"],
            "curso"           => $l["curso"],
            "data_vencimento" => $l["data_vencimento"],
            "valor"           => (float)$l["valor"],
            "dias_atraso"     => $calc["dias"],
            "multa"           => $calc["multa"],
            "juros"           => $calc["juros"],
            "total"           => $calc["total"],
        ];
    }

    return [
        "recebido"      => ["quantidade" => $totais["pago"][0],     "total" => $totais["pago"][1], "mes_atual" => $recebido_mes],
        "pendente"      => ["quantidade" => $totais["pendente"][0], "total" => $totais["pendente"][1]],
        "atrasado"      => ["quantidade" => $totais["atrasado"][0], "total" => $totais["atrasado"][1],
                            "inadimplentes" => $inadimplentes,
                            "encargos" => round($encargos, 2),
                            "total_com_encargos" => round($total_atualizado, 2)],
        "lista_atrasados" => $atrasados,
    ];
}
