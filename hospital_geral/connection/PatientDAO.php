<?php

class PatientDAO {

    private $connection;

    public function __construct() {
        $this -> connection = new Connection();
    }

    public function getConnection() {
        return $this->connection->getConn();
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM hg_patients WHERE usernamePat = '$username' AND passwordPat = '$password'";

        $execute = mysqli_query($this -> connection -> getConn(), $sql);
        
        if (mysqli_num_rows($execute) > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function createPatient($username, $password, $firstName, $surname, $sex, $email, $rg, $cpf, $birthdate) {

        $sql = "INSERT hg_patients(usernamePat, passwordPat, firstName, surname, sex, email, rg, cpf, birthdate) VALUES 
        ('$username', '$password', '$firstName', '$surname', '$sex', '$email', '$rg', '$cpf', '$birthdate')";

        $execute = mysqli_query($this -> connection -> getConn(), $sql);

        if (mysqli_affected_rows($this->connection->getConn()) > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function readPatients($firstName, $surname) {

        $sql = "";

        if ($firstName == "" and $surname == "") {
            $sql = "SELECT * FROM hg_patients ORDER BY firstName";
        }
        else {
            $sql = "SELECT * FROM hg_patients WHERE firstName = '$firstName' AND surname = '$surname'";
        }

        $execute = mysqli_query($this->connection->getConn(), $sql);

        if (mysqli_num_rows($execute) > 0) {
            while ($row = $execute->fetch_assoc()) {
                echo "<div class='patient-card'>";
                echo "<p><img src='../assets/profile.png' alt='../assets/profile.png'><span class='patient-info'>   ".$row['firstName']." ".$row['surname']."</span></p>";
                echo "<hr>";
                echo "<p>ID: <span class='patient-info'>".$row['ID']."</span></p>";
                echo "<p>Usuário: <span class='patient-info'>" . $row['usernamePat'] . "</span></p>";
                echo "<p>Email: <span class='patient-info'>" . $row['email'] . "</span></p>";
                echo "<p>Sexo: <span class='patient-info'>" . $row['sex'] . "</span></p>";
                echo "<p>RG: <span class='patient-info'>" . $row['rg'] . "</span></p>";
                echo "<p>CPF: <span class='patient-info'>" . $row['cpf'] . "</span></p>";
                echo "<p>Data de Nascimento: <span class='patient-info'>" . $row['birthdate'] . "</span></p>";
                echo "<p>Data que Entrou: <span class='patient-info'>" . $row['date_joined'] . "</span></p>";
                echo "<p><a href=../view/updatePatient.php?patientID=".$row['ID'].">Atualizar</a></p>";
                echo "<p><a href='../connection/deletePatient.php?patientID=".$row['ID']."' onclick='return confirm(\"Tem certeza que deseja deletar esse registro?\")'>Excluir</a></p>";
                echo "</div>";
            }
        }
    }

    public function readPatientProfile($username) {

        $sql = "SELECT * FROM hg_patients WHERE usernamePat = '$username'";

        $execute = mysqli_query($this->connection->getConn(), $sql);

        if (mysqli_num_rows($execute) > 0) {
            while ($row = $execute->fetch_assoc()) {
                echo "<div class='patient-card'>";
                echo "<p><img src='../assets/profile.png' alt='../assets/profile.png'><span class='patient-info'>   ".$row['firstName']." ".$row['surname']."</span></p>";
                echo "<hr>";
                echo "<p>Usuário: <span class='patient-info'>" . $row['usernamePat'] . "</span></p>";
                echo "<br>";
                echo "<p>Email: <span class='patient-info'>" . $row['email'] . "</span></p>";
                echo "<br>";
                echo "<p>Sexo: <span class='patient-info'>" . $row['sex'] . "</span></p>";
                echo "<br>";
                echo "<p>RG: <span class='patient-info'>" . $row['rg'] . "</span></p>";
                echo "<br>";
                echo "<p>CPF: <span class='patient-info'>" . $row['cpf'] . "</span></p>";
                echo "<br>";
                echo "<p>Data de Nascimento: <span class='patient-info'>" . $row['birthdate'] . "</span></p>";
                echo "<br>";
                echo "<p>Data que Entrou: <span class='patient-info'>" . $row['date_joined'] . "</span></p>";
                echo "<br>";
                echo "<p><a href=../view/resetPassword.php?patientID=".$row['ID'].">Definir Nova Senha</a></p>";
                echo "</div>";
            }
        }
    }

    public function updatePatient($ID, $firstName, $surname, $sex, $email, $rg, $cpf) {
        
        $sql = "UPDATE hg_patients SET firstName = '$firstName', surname = '$surname', sex = '$sex', email = '$email', 
        rg = '$rg', cpf = '$cpf' WHERE ID = '$ID'";

        $execute = mysqli_query($this -> connection -> getConn(), $sql);

        if (mysqli_affected_rows($this->connection->getConn()) > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function resetPassword($ID, $newPassword) {

        $sql = "UPDATE hg_patients SET passwordPat = '$newPassword' WHERE ID = '$ID'";

        $execute = mysqli_query($this -> connection -> getConn(), $sql);

        if (mysqli_affected_rows($this->connection->getConn()) > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function deletePatient($ID) {

        $sql = "DELETE FROM hg_patients WHERE ID = '$ID'";

        $execute = mysqli_query($this -> connection -> getConn(), $sql);

        if (mysqli_affected_rows($this->connection->getConn()) > 0) {
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