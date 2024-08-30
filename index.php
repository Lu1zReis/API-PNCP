<?php
// começa uma sessão cURL
$curl = curl_init();

$url = "https://pncp.gov.br/api/consulta/v1/contratos?dataInicial=20230116&dataFinal=20240116&cnpjOrgao=33004540000100&pagina=1";

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

    echo "<b>Informações do Orgão</b><br>";
    echo "Razão Social: ".$razaoSocial."<br>";
    echo "CNPJ: ".$cnpj."<br>";
    echo "Código do País Fornecedor: ".$pais."<br>";
    echo "PoderId: {$poder}, EsferaId: {$esfera}<br><br>";
    

    $queryString = parse_url($url, PHP_URL_QUERY);

    parse_str($queryString, $params);

    // acessando as datas escolhidadas no filtro pela url
    $dataInicial = $params['dataInicial'];
    $data_obj = DateTime::createFromFormat('Ymd', $dataInicial);
    $dataFormatada = $data_obj->format('Y-m-d');

    $total = 0;
    // processa os dados retornados
    foreach ($data['data'] as $value) {
        if (strtotime($value['dataVigenciaInicio']) >= strtotime($dataFormatada)) {
            echo "Nome Razão Social Fornecedor: {$value['nomeRazaoSocialFornecedor']}<br>";
            echo "Objeto de Contrato: {$value['objetoContrato']}<br>";
            echo "datas: {$value['dataVigenciaInicio']} => {$value['dataVigenciaFim']}<br>";
            echo "Valor Inicial: {$value['valorInicial']}<br>";
            echo "<br>";
            $total += $value['valorInicial'];
        }
    }
    echo "Total: R$".$total;
}

curl_close($curl);
?>

