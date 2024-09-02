<?php 

namespace connect;

// conexao com o banco de dados
class Conn {
    private static $instance;
    
    public static function getConn() {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new \PDO(
                    'pgsql:host=babar.db.elephantsql.com;dbname=qykyqlfl',
                    'qykyqlfl', 
                    '6OiUQSxqXf21E9k2ytVP7aBPMlFwVbq1'
                );
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                echo "Erro ao conectar: " . $e->getMessage();
            }
        }
        return self::$instance;
    }
}
?>
