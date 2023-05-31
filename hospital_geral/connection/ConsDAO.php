<?php

    class ConsDAO {

        private $connection;

        public function __construct() {
            $this -> connection = new Connection();
        }

        public function createCons($statusCons ,$patient_name, $patient_surname, $patient_email, $patient_sex, $patient_rg, $patient_cpf, $patient_birth, $cons_text) {

            $sql = "INSERT hg_consultas(statusCons, nome_paciente, sobrenome_paciente, email_paciente, sexo_paciente, rg_paciente, cpf_paciente, data_nascimento, texto_consulta) VALUES
            ('$statusCons', '$patient_name', '$patient_surname', '$patient_email', '$patient_sex', '$patient_rg', '$patient_cpf', '$patient_birth', '$cons_text')";

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_affected_rows($this->connection->getConn()) > 0) {
                return true;
            }
            else {
                return false;
            }
        }

        public function readFirstCons($firstName, $surname) {

            $sql = "";

            if ($firstName == "" and $surname == "") {
                $sql = "SELECT * FROM hg_consultas WHERE statusCons = 'Solicitada' ORDER BY data_solicitada";
            }
            else {
                $sql = "SELECT * FROM hg_consultas WHERE statusCons = 'Solicitada' AND nome_paciente = '$firstName' AND sobrenome_paciente = '$surname' ORDER BY data_solicitada";
            }

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_num_rows($execute) > 0) {
                while ($row = $execute->fetch_assoc()) {
                    echo "<div class='patient-card'>";
                    echo "<p><img src='../assets/cons.png' alt='../assets/cons.png'><span class='patient-info'>".$row['nome_paciente']." ".$row['sobrenome_paciente']."</span></p>";
                    echo "<hr>";
                    echo "<p>Status: <span class='patient-info'>" . $row['statusCons'] . "</span></p>";
                    echo "<br>";
                    echo "<p>Email: <span class='patient-info'>" . $row['email_paciente'] . "</span></p>";
                    echo "<p>Sexo: <span class='patient-info'>" . $row['sexo_paciente'] . "</span></p>";
                    echo "<p>RG: <span class='patient-info'>" . $row['rg_paciente'] . "</span></p>";
                    echo "<p>CPF: <span class='patient-info'>" . $row['cpf_paciente'] . "</span></p>";
                    echo "<p>Data de Nascimento: <span class='patient-info'>" . $row['data_nascimento'] . "</span></p>";
                    echo "<br>";
                    echo "<p>Motivo da Consulta: <span class='patient-info'>" . $row['texto_consulta'] . "</span></p>";
                    echo "<br>";
                    echo "<p>Data da Solicitação: <span class='patient-info'>" . $row['data_solicitada'] . "</span></p>";
                    echo "<p><a href='../view/updateCons.php?consID=".$row['ID']."'>Agendar Consulta</a></p>";
                    echo "<p><a href='../connection/endCons.php?consID=".$row['ID']."' onclick='return confirm(\"Tem certeza que deseja excluir esta solicitação?\")'>Excluir</a></p>";
                    echo "</div>";
                }
            }
        }

        public function readSecondCons($firstName, $surname) {

            $sql = "";

            if ($firstName == "" and $surname == "") {
                $sql = "SELECT * FROM hg_consultas WHERE statusCons = 'Agendada' ORDER BY data_consulta";
            }
            else {
                $sql = "SELECT * FROM hg_consultas WHERE statusCons = 'Agendada' AND nome_paciente = '$firstName' AND sobrenome_paciente = '$surname' ORDER BY data_consulta";
            }

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_num_rows($execute) > 0) {
                while ($row = $execute->fetch_assoc()) {
                    echo "<div class='patient-card'>";
                    echo "<p><img src='../assets/cons.png' alt='../assets/cons.png'><span class='patient-info'>".$row['nome_paciente']." ".$row['sobrenome_paciente']."</span></p>";
                    echo "<p>Nome de Usuário: <span class='patient-info'>".$row['usuario_paciente']."</span></p>";
                    echo "<hr>";
                    echo "<p>Status: <span class='patient-info'>" . $row['statusCons'] . "</span></p>";
                    echo "<p>Email: <span class='patient-info'>" . $row['email_paciente'] . "</span></p>";
                    echo "<br>";
                    echo "<p>Motivo da Consulta: <span class='patient-info'>" . $row['texto_consulta'] . "</span></p>";
                    echo "<br>";
                    echo "<p>Data e Hora da Consulta: <span class='patient-info'>" . $row['data_consulta'] . "</span></p>";
                    echo "<p><a href='../connection/endCons.php?consID=".$row['ID']."' onclick='return confirm(\"Tem certeza que deseja encerrar esta consulta?\")'>Encerrar Consulta</a></p>";
                    echo "</div>";
                }
            }
        }

        public function readConsPatients($username) {

            $sql = "SELECT * FROM hg_consultas WHERE usuario_paciente = '$username' ORDER BY data_consulta";

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_num_rows($execute) > 0) {
                while ($row = $execute->fetch_assoc()) {
                    echo "<div class='patient-card'>";
                    echo "<p><img src='../assets/cons.png' alt='../assets/cons.png'><span class='patient-info'>".$row['nome_paciente']." ".$row['sobrenome_paciente']."</span></p>";
                    echo "<hr>";
                    echo "<p>Status: <span class='patient-info'>" . $row['statusCons'] . "</span></p>";
                    echo "<br>";
                    echo "<p>Motivo da Consulta: <span class='patient-info'>" . $row['texto_consulta'] . "</span></p>";
                    echo "<br>";
                    echo "<p>Data e Hora da Consulta: <span class='patient-info'>" . $row['data_consulta'] . "</span></p>";
                    echo "<p><a href='../connection/cancelCons.php?consID=".$row['ID']."' onclick='return confirm(\"Tem certeza que deseja cancelar esta consulta?\")'>Cancelar Consulta</a></p>";
                    echo "</div>";
                }
            }
        }

        public function updateFirstCons($ID, $date_agend, $username) {

            $sql = "UPDATE hg_consultas SET statusCons = 'Agendada', data_consulta = '$date_agend', usuario_paciente = '$username' WHERE ID = '$ID'";

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_affected_rows($this->connection->getConn()) > 0) {
                return true;
            }
            else {
                return false;
            }
        }

        public function deleteSecondCons($ID) {

            $sql = "DELETE FROM hg_consultas WHERE ID = '$ID'";

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_affected_rows($this->connection->getConn()) > 0) {
                return true;
            }
            else {
                return false;
            }
        }
    }