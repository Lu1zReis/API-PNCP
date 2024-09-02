<?php

namespace connect;

class ContratoDao {
    public function create(Contrato $p) {
        $sql = 'insert into contratos (orgao_id, nome_razao_social_fornecedor, objeto_contrato, data_vigencia_inicio, data_vigencia_fim, valor_inicial) values (?,?,?,?,?,?)';
        $stmt = Conn::getConn()->prepare($sql); 
  
        // $p que está vindo como uma instância, para depois acessarmos os dados que quisermos da classe, basicamente só retornando o valor 
        $stmt->bindValue(1, $p->getOrgaoId()); 
        $stmt->bindValue(2, $p->getNome()); 
        $stmt->bindValue(3, $p->getObjeto()); 
        $stmt->bindValue(4, $p->getDataIni()); 
        $stmt->bindValue(5, $p->getDataFim()); 
        $stmt->bindValue(6, $p->getValor()); 
 
        // depois usamos o execute() para fazer a query com o banco de dados   
        if($stmt->execute()):
            return true;
        else:
            return false;
        endif;
    }
}