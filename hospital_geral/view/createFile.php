<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit();
    }
    else if ($_SESSION['type'] != "funcionario") {
        header("Location: ../view/systemPatients.php");
        exit();
    }

    if(isset($_POST['registrar'])) {

        include ('../connection/Connection.php');
        include ('../connection/FileDAO.php');

        $createFile = new FileDAO();

        $patientName = trim(strip_tags($_POST['nomePaciente']));
        $patientSurname = $_POST['sobrenomePaciente'];
        $patientUsername = trim(strip_tags($_POST['usuarioPaciente']));
        $docType = trim(strip_tags($_POST['tipoDocumento']));
        $file = $_FILES['arquivo'];
        $docName = $file['name']; 
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $fileTmp = $file['tmp_name'];

        $dir = 'C:/XAMPP/htdocs/hospital_geral/files/'.$docName;
        move_uploaded_file($fileTmp, $dir);

        $exito = $createFile->createFile($docName, $docType, $fileType, $fileSize, $dir, $patientUsername, $patientName, $patientSurname);

        if ($exito) {
            echo "<script>alert('Documento armazenado com sucesso.');</script>";
        }
        else {
            echo "<script>alert('Não foi possível armazenar o documento.');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../assets/icon.png">
    <link rel="stylesheet" href="../css/createFile.css">
    <title>Armazenar Documentos - Hospital Geral</title>
</head>
<body>
    <header>
        <div class="head">
            <div class="logo">
                <img src="../assets/logoStaff.png" alt="logo hospital geral">
            </div>
            <div class="user">
                <h1>Olá, <?php echo $_SESSION['usuario']; ?>.</h1>
                <a href="../connection/logoutStaff.php">Sair</a>
            </div>
        </div>
        <div class="menu">
            <div class="drop-down">
                <select class="drop" name="secretaria" id="secretaria" onclick="resetSelectedOption()">
                    <option value="" disabled selected hidden>Secretaria</option>
                    <option value="cad_paciente" data-href="../view/createPatient.php">Cadastrar Paciente</option>
                    <option value="pacientes" data-href="../view/readPatients.php">Pacientes Cadastrados</option>
                </select>
                <script>
                    function resetSelectedOption() {
                        const selectElement = document.getElementById('secretaria');
                        selectElement.selectedIndex = 0;
                    }

                    const selectElement = document.getElementById('secretaria');
                    selectElement.addEventListener('change', function() {
                        const selectedOption = this.options[this.selectedIndex];
                        const href = selectedOption.getAttribute('data-href');
                        window.location.href = href;
                    });
                </script>
            </div>
            <div class="drop-down">
                <select class="drop" name="const" id="const" onclick="resetSelectedOption5()">
                    <option value="" disabled selected hidden>Consultas</option>
                    <option value="const_ag" data-href="../view/readFirstCons.php">Agendar Consultas</option>
                    <option value="const_ag_" data-href="../view/readSecondCons.php">Consultas Agendadas</option>
                </select>
                <script>
                    function resetSelectedOption5() {
                        const selectElement5 = document.getElementById('const');
                        selectElement5.selectedIndex = 0;
                    }

                    const selectElement5 = document.getElementById('const');
                    selectElement5.addEventListener('change', function() {
                        const selectedOption5 = this.options[this.selectedIndex];
                        const href5 = selectedOption5.getAttribute('data-href');
                        window.location.href = href5;
                    });
                </script>
            </div>
            <div class="drop-down">
                <select class="drop" name="documents" id="documents" onclick="resetSelectedOption3()">
                    <option value="" disabled selected hidden>Documentos</option>
                    <option value="cr_docs" data-href="../view/createFile.php">Armazenar Documento</option>
                    <option value="docs_ar" data-href="../view/readFiles.php">Documentos Armazenados</option>
                    <option value="docs_sol" data-href="../view/readRequires.php">Documentos Solicitados</option>
                </select>
                <script>
                    function resetSelectedOption3() {
                        const selectElement3 = document.getElementById('documents');
                        selectElement3.selectedIndex = 0;
                    }

                    const selectElement3 = document.getElementById('documents');
                    selectElement3.addEventListener('change', function() {
                        const selectedOption3 = this.options[this.selectedIndex];
                        const href3 = selectedOption3.getAttribute('data-href');
                        window.location.href = href3;
                    });
                </script>
            </div>
        </div>
    </header>
    <section>
        <div class="back">
            <a href="../view/systemStaff.php">< Página Principal</a>
        </div>
        <div class="title">Armazenar Documentos de Clientes</div>
        <div class="create">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="docType">
                    <input type="text" class="form-control" name="tipoDocumento" id="docType" placeholder="Categoria do Documento" required>
                </div>
                <div class="patientName">
                    <input type="text" class="form-control" name="nomePaciente" id="patientName" placeholder="Nome do(a) Paciente" required>
                </div>
                <div class="patientSurname">
                    <input type="text" class="form-control" name="sobrenomePaciente" id="patientSurname" placeholder="Sobrenome do(a) Paciente" required>
                </div>
                <div class="patientUsername">
                    <input type="text" class="form-control" name="usuarioPaciente" id="patientUsername" placeholder="Nome de Usuário do(a) Paciente" required>
                </div>
                <div class="file">
                    <label for="file">Arquivo do Documento</label>
                    <input type="file" name="arquivo" id="file" accept=".pdf" required>
                </div>
                <div class="button">
                    <input type="submit" value="Armazenar Documento" name="registrar" class="btn btn-block btn-primary">
                </div>
            </form>
        </div>
    </section>
</body>
</html>