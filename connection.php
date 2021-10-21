<?php
    class Connection extends PDO{
        private $typebd='mysql';
        private $host='localhost';
        private $namebd='cels';
        private $user='root';
        private $password='';

        public function __construct()
        {
            try{
                parent::__construct("{$this->typebd}; dbname={$this->namebd
                }; host={$this->host}; charset=utf8", $this->user, $this->password);
                
            } catch(PDOException $e) {
                echo "Existe un error: " .$e->getMessage();
            }
        }
    }
?>