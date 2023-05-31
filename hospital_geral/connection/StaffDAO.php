<?php

class StaffDAO {

    private $connection;

    public function __construct() {
        $this -> connection = new Connection();
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM hospital_geral_staff WHERE usernameMed = '$username' AND passwordMed = '$password'";

        $execute = mysqli_query($this -> connection -> getConn(), $sql);
        
        if (mysqli_num_rows($execute) > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function logout() {
        session_start();

        session_destroy();
        header('location:../index.php?success=logout');
        exit();
    }
}