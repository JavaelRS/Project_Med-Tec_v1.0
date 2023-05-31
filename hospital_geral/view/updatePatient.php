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

    include ('../connection/Connection.php');
    include ('../connection/PatientDAO.php');

    if (isset($_GET['patientID'])) {
        $ID = $_GET['patientID'];

        $read = new PatientDAO();
        $sql = "SELECT * FROM hg_patients WHERE ID = '$ID'";

        $execute = mysqli_query($read->getConnection(), $sql);

        if (mysqli_num_rows($execute) > 0) {
            while ($row = $execute->fetch_assoc()) {
                $firstName = $row['firstName'];
                $surname = $row['surname'];
                $sex = $row['sex'];
                $email = $row['email'];
                $rg = $row['rg'];
                $cpf = $row['cpf'];
                $birthdate = $row['birthdate'];
            }
        }
    }

    if (isset($_POST['atualizar'])) {
        $update = new PatientDAO();

        $ID = $_POST['ID'];
        $firstName_ = trim(strip_tags($_POST['nome']));
        $surname_ = $_POST['sobrenome'];
        $sex_ = trim(strip_tags($_POST['sexo']));
        $email_ = trim(strip_tags($_POST['e-mail']));
        $rg_ = trim(strip_tags($_POST['r_g']));
        $cpf_ = trim(strip_tags($_POST['ncpf']));

        $exito = $update->updatePatient(intval($ID), $firstName_, $surname_, $sex_, $email_, $rg_, $cpf_);

        if ($exito) {
            header('location:../view/updateStatus.php?update_success');
        }
        else {
            header('location:../view/updateStatus.php?update_fail');
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
    <link rel="stylesheet" href="../css/updatePatient.css">
    <title>Atualizar Dados de Paciente - Hospital Geral</title>
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
            <a href="../view/readPatients.php">< Pacientes Cadastrados</a>
        </div>
        <div class="title">Atualizar Dados de Pacientes</div>
        <div class="create">
            <form action="#" method="POST">
                <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                <div class="first_name">
                    <label for="first_name">Nome</label>
                    <input type="text" class="form-control" name="nome" id="first_name" value="<?php echo $firstName ?>" required>
                </div>
                <div class="surname">
                    <label for="surname">Sobrenome</label>
                    <input type="text" class="form-control" name="sobrenome" id="surname" value="<?php echo $surname ?>" required>
                </div>
                <div class="sex">
                    <label for="surname">Sexo (M/F)</label>
                    <input type="text" class="form-control" name="sexo" id="sex" placeholder="S" value="<?php echo $sex ?>" required>
                </div>
                <div class="email">
                    <label for="email">Endereço de Email</label>
                    <input type="text" class="form-control" name="e-mail" id="email" placeholder="example@email.com" value="<?php echo $email ?>" required>
                </div>
                <div class="rg">
                    <label for="rg">RG</label>
                    <input type="text" class="form-control" name="r_g" id="rg" placeholder="00.000.000-0" value="<?php echo $rg ?>" required>
                </div>
                <div class="cpf">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" name="ncpf" id="cpf" placeholder="000.000.000-00" value="<?php echo $cpf ?>" required>
                </div>
                <div class="button">
                    <input type="submit" value="Atualizar Paciente" name="atualizar" onclick="return confirm('Tem certeza que deseja atualizar estes dados?');" class="btn btn-block btn-primary">
                </div>
            </form>
        </div>
    </section> 
</body>
</html>