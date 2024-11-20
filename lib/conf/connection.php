<?php
class Connection {
    private $host;
    private $user;
    private $pass;
    private $database;
    private $port;
    private $link;


function __construct(){
    $this->setConnect(); 
    $this->connect();
}
private function setConnect(){
    require_once 'conf.php';

    $this->host = $host;
    $this->user = $user;
    $this->pass = $pass;
    $this->port = $port;
    $this->database = $database;

}

private function connect() {
    // Crear la cadena de conexión
    $connectionString = "host={$this->host} port={$this->port} dbname={$this->database} user={$this->user} password={$this->pass}";

    // Intentar conectar con PostgreSQL
    $this->link = pg_connect($connectionString);

    // Verificar si la conexión fue exitosa
    if ($this->link) {
        //echo "Conexión exitosa <br>";
    } else {
        die("Error de conexión: " . pg_last_error());
    }
}

public function getConnect(){
    return $this->link;
}
public function close(){
    pg_close($this->link);
}
}



?>