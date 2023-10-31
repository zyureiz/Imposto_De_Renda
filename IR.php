<!DOCTYPE html>
<html>
<head>
    <title>Imposto de Renda</title>
</head>
<body>
    <h1>Calculadora de Imposto de Renda</h1>
    <form method="get">
        <label for="cpf">CPF:</label>
        <br><input type="text" name="cpf" id="cpf" required>

        <br><label for="dependentes">Número de Dependentes:</label>
        <br><input type="text" name="dependentes" id="dependentes" required>

        <br><label for="renda_mensal">Renda Mensal (em salários mínimos):</label>
        <br><input type="text" name="renda_mensal" id="renda_mensal" required>

        <br><br><input type="submit" value="Calcular Imposto">
    </form>

    <?php
    function calcularImpostoRenda($renda, $dependentes) {
        $salario_minimo = 1100;
        $renda_em_reais = $renda * $salario_minimo;
        $desconto_dependentes = $dependentes * (0.05 * $salario_minimo);
        
        $renda_liquida = $renda_em_reais - $desconto_dependentes;
        
        if ($renda_liquida <= 3 * $salario_minimo) {
            return 0;
        } elseif ($renda_liquida <= 4 * $salario_minimo) {
            return $renda_liquida * 0.07;
        } elseif ($renda_liquida <= 5 * $salario_minimo) {
            return $renda_liquida * 0.15;
        } elseif ($renda_liquida <= 6 * $salario_minimo) {
            return $renda_liquida * 0.22;
        } else {
            return $renda_liquida * 0.27;
        }
    }

    if(isset($_GET['cpf']) && isset($_GET['dependentes']) && isset($_GET['renda_mensal'])) {
        $cpf = $_GET['cpf'];
        $dependentes = intval($_GET['dependentes']);
        $renda_mensal = floatval($_GET['renda_mensal']);

        $imposto = calcularImpostoRenda($renda_mensal, $dependentes);

        echo "<h2>Resultado para o CPF: $cpf</h2>";
        echo "Número de Dependentes: $dependentes<br>";
        echo "Renda Mensal (em salários mínimos): $renda_mensal<br>";
        echo "Imposto de Renda devido: R$ " . number_format($imposto, 2);
    }
    ?>
</body>
</html>