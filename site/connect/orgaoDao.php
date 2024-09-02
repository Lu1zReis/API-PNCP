<?php

namespace connect;

class OrgaoDao {
    public function create(Orgao $p) {
        // insercao no bd 
        $sql = 'insert into orgao (razao_social, cnpj, pais, poder_id, esfera_id) values (?,?,?,?,?)';
        $stmt = Conn::getConn()->prepare($sql); 
  
        // acessando os dados da classe Orgao, com os getters 
        $stmt->bindValue(1, $p->getRazao()); 
        $stmt->bindValue(2, $p->getCnpj()); 
        $stmt->bindValue(3, $p->getPais()); 
        $stmt->bindValue(4, $p->getPoder()); 
        $stmt->bindValue(5, $p->getEsfera()); 
 
        // fazendo a query com o banco de dados   
        if ($stmt->execute()):
            return true;
        else:
            return false;
        endif;
        
    }
}