<?php

    class RequireDAO {

        private $connection;

        public function __construct() {
            $this -> connection = new Connection();
        }

        public function createRequire($patientUsername, $patientName, $patientSurname, $textoSolicitacao) {

            $sql = "INSERT hg_solicitacoes(patientUsername, patientName, patientSurname, texto_solicitacao) VALUES 
            ('$patientUsername', '$patientName', '$patientSurname', '$textoSolicitacao')";

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_affected_rows($this->connection->getConn()) > 0) {
                return true;
            }
            else {
                return false;
            }
        }

        public function readRequires() {

            $sql = "SELECT * FROM hg_solicitacoes";

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_num_rows($execute) > 0) {
                while ($row = $execute->fetch_assoc()) {
                    echo "<div class='patient-card'>";
                    echo "<p><img src='../assets/file.png' alt='../assets/file.png'><span class='patient-info'>".$row['patientName']." ".$row['patientSurname']."</span></p>";
                    echo "<hr>";
                    echo "<p>Nome de Usuário: <span class='patient-info'>" . $row['patientUsername'] . "</span></p>";
                    echo "<br>";
                    echo "<p>Texto da Solicitação: <span class='patient-info'>" . $row['texto_solicitacao'] . "</span></p>";
                    echo "<br>";
                    echo "<p>Data da Solicitação: <span class='patient-info'>" . $row['data_emissao'] . "</span></p>";
                    echo "<p><a href='../connection/deleteRequire.php?reqID=".$row['ID']."' onclick='return confirm(\"Tem certeza que deseja finalizar esta solicitação?\")'>Excluir</a></p>";
                    echo "</div>";
                }
            }
        }

        public function deleteRequire($ID) {

            $sql = "DELETE FROM hg_solicitacoes WHERE ID = '$ID'";

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_affected_rows($this->connection->getConn()) > 0) {
                return true;
            }
            else {
                return false;
            }
        }
    }