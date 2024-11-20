<?php
    
    include_once '../lib/conf/connection.php';

    Class MasterModel extends Connection{

        public function insert($sql){
            $result = pg_query($this->getConnect(), $sql);
            return $result;
        }
        public function consult($sql){
            $result = pg_query($this->getConnect(), $sql);

            return pg_fetch_all($result);
        }
        public function update($sql){
            $result = pg_query($this->getConnect(), $sql);

            return $result;
        }
        public function delete($sql){
            $result = pg_query($this->getConnect(), $sql);

            return $result;
        }

        public function autoIncrement($table, $field){

            $sql = "SELECT MAX($field) FROM $table";
            $result = pg_query($this->getConnect(), $sql);

            $resp= pg_fetch_row($result);

            return $resp[0]+1;
            
        }
    
    }

?>