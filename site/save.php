<?php

namespace app;

use connect\Conn;
use connect\Orgao;
use connect\OrgaoDao;
use connect\Contrato;
use connect\ContratoDao;

include_once 'connect/connect.php';
include_once 'connect/orgao.php';
include_once 'connect/orgaoDao.php';
include_once 'connect/contrato.php';
include_once 'connect/contratoDao.php';
 // verifica se o usuário enviou 
if (isset($_POST['save'])) {
    $orgao       = new Orgao();
    $orgaoDao    = new OrgaoDao();
    $contrato    = new Contrato();
    $contratoDao = new ContratoDao();
    
    $data = json_decode($_POST['data'], true);
    // verifica se há algum valor da API
    if (isset($data['data'][0])) {
        $razaoSocial = $data['data'][0]['orgaoEntidade']['razaoSocial'];
        $cnpj        = $data['data'][0]['orgaoEntidade']['cnpj'];
        $pais        = $data['data'][0]['codigoPaisFornecedor'];
        $poder       = $data['data'][0]['orgaoEntidade']['poderId'];
        $esfera      = $data['data'][0]['orgaoEntidade']['esferaId'];
        
        $orgao->setRazao($razaoSocial);
        $orgao->setCnpj($cnpj);
        $orgao->setPais($pais);
        $orgao->setPoder($poder);
        $orgao->setEsfera($esfera);
        if($orgaoDao->create($orgao)): # verifica se conseguiu inserir o novo orgao

            # busca o id do ultimo orgao inserido 
            $sql = "SELECT id FROM orgao ORDER BY id DESC LIMIT 1";
            $stmt = Conn::getConn()->prepare($sql);
            $stmt->execute();
            $id_orgao = $stmt->fetchColumn();

            # inserindo os contratos
            foreach ($data['data'] as $value) {
                $contrato->setNome($value['nomeRazaoSocialFornecedor']);
                $contrato->setObjeto($value['objetoContrato']); 
                $contrato->setValor($value['valorInicial']); 
                $contrato->setDataFim($value['dataVigenciaFim']); 
                $contrato->setDataIni($value['dataVigenciaInicio']); 
                $contrato->setOrgaoId($id_orgao);
                $contratoDao->create($contrato);          
            }
        endif;

        header("Location: index.php");
        exit();
    } else {
        echo "Dados não encontrados no JSON.";
    }
} else {
    echo "Erro ao processar o formulário.";
}
?>
