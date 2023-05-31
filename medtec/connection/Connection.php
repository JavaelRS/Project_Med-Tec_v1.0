<?php

class Connection {

    private $user = "root";
    private $pass = "";
    private $data = "medtec";
    private $host = "localhost";
    
    private $conn;

    public function __construct() {
        $this -> conn =  mysqli_connect($this -> host, $this -> user, $this -> pass) or 
        die ("Erro na conexão".mysqli_error($this -> conn));

        mysqli_select_db($this -> conn, $this -> data) or
         die("Erro na conexão".mysqli_error($this -> conn));
    }

    public function getConn() {
        return $this -> conn;
    }
}

?>