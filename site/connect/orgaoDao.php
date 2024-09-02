<?php

namespace connect;

class OrgaoDao {
    public function create(Orgao $p) {
        $sql = 'insert into orgao (razao_social, cnpj, pais, poder_id, esfera_id) values (?,?,?,?,?)';
        $stmt = Conn::getConn()->prepare($sql); 
  
        // $p que está vindo como uma instância, para depois podermos acessar os dados que quisermos da classe Produto, basicamente só retornando o valor 
        $stmt->bindValue(1, $p->getRazao()); 
        $stmt->bindValue(2, $p->getCnpj()); 
        $stmt->bindValue(3, $p->getPais()); 
        $stmt->bindValue(4, $p->getPoder()); 
        $stmt->bindValue(5, $p->getEsfera()); 
 
        // depois usamos o execute() para fazer a query com o banco de dados   
        if ($stmt->execute()):
            return true;
        else:
            return false;
        endif;
        
    }
}