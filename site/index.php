<!DOCTYPE html>
<html>
    <?php
    // começa uma sessão cURL
    $curl = curl_init();

    $url = "https://pncp.gov.br/api/consulta/v1/contratos?dataInicial=20230122&dataFinal=20231002&cnpjOrgao=33004540000100&pagina=1";

    // Configurações da sessão cURL
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true, // Retorna a resposta como string
        CURLOPT_HTTPHEADER => [
            'accept: */*' // requisição
        ],
    ]);

    // executando
    $response = curl_exec($curl);

    if(curl_errno($curl)) {
        echo 'Erro: ' . curl_error($curl);
    } else {
        // JSON para um array PHP
        $data = json_decode($response, true);

        # dados
       $razaoSocial = $data['data'][0]['orgaoEntidade']['razaoSocial'];
       $cnpj        = $data['data'][0]['orgaoEntidade']['cnpj'];
       $pais        = $data['data'][0]['codigoPaisFornecedor'];
       $poder       = $data['data'][0]['orgaoEntidade']['poderId'];
       $esfera      = $data['data'][0]['orgaoEntidade']['esferaId'];

        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);
        // acessando as datas escolhidadas no filtro pela url
        $dataInicial = $params['dataInicial'];
        $data_obj = DateTime::createFromFormat('Ymd', $dataInicial);
        $dataFormatada = $data_obj->format('Y-m-d');

        $total = 0;
        foreach ($data['data'] as $value): 
            $total += $value['valorInicial']; 
        endforeach;

    ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PNCP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="orgaoInfo">
        <h1>Informações do Órgão</h1>
        <p>Razão Social: <?php echo $razaoSocial; ?></p>
        <p>CNPJ: <?php echo $cnpj; ?></p>
        <p>Código do País Fornecedor: <?php echo $pais; ?></p>
        <p>PoderId: <?php echo $poder; ?>, EsferaId: <?php echo $esfera; ?></p>
    </div>

    <form class="pesquisa" action="save.php" method="POST">
        <input type="hidden" name="data" value="<?php echo htmlspecialchars(json_encode($data)); ?>">
        Salvar Informações:<input name="save" type="submit">
    </form>

    <div class="total">
        Total: R$<?php echo $total; }?>
    </div>

    <div class="contratos">
        <?php foreach ($data['data'] as $value): ?>
            <div>
                <h3>Contrato: <?php echo $value['nomeRazaoSocialFornecedor']; ?></h3>
                <p>Objeto: <?php echo $value['objetoContrato']; ?></p>
                <p>Data de Vigência: <?php echo $value['dataVigenciaInicio'] . " até " . $value['dataVigenciaFim']; ?></p>
                <p>
                    Valor Inicial: R$<?php echo $value['valorInicial'];?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>