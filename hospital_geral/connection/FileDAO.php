<?php

    class FileDAO {

        private $connection;

        public function __construct() {
            $this -> connection = new Connection();
        }

        public function createFile($docName, $docType, $fileType, $fileSize, $dir, $patientUsername, $patientName, $patientSurname) {

            $sql = "INSERT hg_documents(docName, docType, fileType, fileSize, dir, patientUsername, patientName, patientSurname) VALUES 
            ('$docName', '$docType', '$fileType', '$fileSize', '$dir', '$patientUsername', '$patientName', '$patientSurname')";

            $execute = mysqli_query($this -> connection -> getConn(), $sql);

            if (mysqli_affected_rows($this->connection->getConn()) > 0) {
                return true;
            }
            else {
                return false;
            }
        }

        public function readFiles($patientName, $patientSurname) {

            $sql = "SELECT * FROM hg_documents WHERE patientName = '$patientName' AND patientSurname = '$patientSurname' ORDER BY data_emissao DESC";

            $execute = mysqli_query($this->connection->getConn(), $sql);

            if (mysqli_num_rows($execute) > 0) {
                while ($row = $execute->fetch_assoc()) {
                    echo "<div class='patient-card'>";
                    echo "<p><img src='../assets/file.png' alt='../assets/file.png'><span class='patient-info'>".$row['docType']." - ".$row['patientName']." ".$row['patientSurname']."</span></p>";
                    echo "<hr>";
                    echo "<p>Data do Documento: <span class='patient-info'>" . $row['data_emissao'] . "</span></p>";
                    echo "<a href='../connection/download.php?file=".$row['dir']."'>".$row['docName']."</a><br>";
                    echo "</div>";
                }
            }
        }

        public function readFilesPatient($patientUsername) {

            $sql = "SELECT * FROM hg_documents WHERE patientUsername = '$patientUsername' ORDER BY data_emissao DESC";

            $execute = mysqli_query($this->connection->getConn(), $sql);

            if (mysqli_num_rows($execute) > 0) {
                while ($row = $execute->fetch_assoc()) {
                    echo "<div class='patient-card'>";
                    echo "<p><img src='../assets/file.png' alt='../assets/file.png'><span class='patient-info'>".$row['docType']."</span></p>";
                    echo "<hr>";
                    echo "<p>Data do Documento: <span class='patient-info'>" . $row['data_emissao'] . "</span></p>";
                    echo "<a href='../connection/download.php?file=".$row['dir']."'>".$row['docName']."</a><br>";
                    echo "</div>";
                }
            }
        }
    }