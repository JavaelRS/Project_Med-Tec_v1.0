<?php

class CodeDAO {

    private $connection;

    public function __construct() {
        $this -> connection = new Connection();
    }

    public function validate($code, $cpf) {
        $sql = "SELECT * FROM codes WHERE code = '$code' AND cpf = '$cpf'";
        
        $execute = mysqli_query($this -> connection -> getConn(), $sql);
        
        if (mysqli_num_rows($execute) > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}