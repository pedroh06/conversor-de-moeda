<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>
            Coversor de Moeda v2
        </h1>
    </header>
    <main>
        <?php
        $dataInicio = date("m-d-Y", strtotime("-7 days"));
        $dataFim = date("m-d-Y");
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'' . $dataInicio . '\'&@dataFinalCotacao=\'' . $dataFim . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

        $dados = json_decode(file_get_contents($url), true);

        //var_dump($dados);

        $cotacao = $dados["value"][0]["cotacaoCompra"];

        // Quanto $$ o usuário tem
        $real = $_REQUEST["dinheiro"] ?? 0;
        
        //Equivalência em dólar
        $dolar = $real / $cotacao;

        // Mostrar resultado
        // echo "Seus R\$" . number_format($real, 2, ",", ".") . " equivalem a US\$" . number_format($dolar, 2, ",", ".");

        // Formatação de moedas com internacionalização
        // Biblioteca intl (Internallization PHP)

        $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

        echo "<p>Seus <strong>" . numfmt_format_currency($padrao, $real, "BRL") . "</strong> equivalem a <strong>" . numfmt_format_currency($padrao, $dolar, "USD") . "</strong></p>";
        ?>
        <button onclick="javascript:history.go(-1)">Voltar</button>
    </main>
</body>

</html>