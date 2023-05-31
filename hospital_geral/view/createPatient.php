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

    if(isset($_POST['cadastrar'])) {

        include ('../connection/Connection.php');
        include ('../connection/PatientDAO.php');

        $patient = new PatientDAO();

        $username = trim(strip_tags($_POST['usuario']));
        $password = trim(strip_tags($_POST['senha']));
        $firstName = trim(strip_tags($_POST['nome']));
        $surname = $_POST['sobrenome'];
        $sex = trim(strip_tags($_POST['sexo']));
        $email = trim(strip_tags($_POST['e-mail']));
        $rg = trim(strip_tags($_POST['r_g']));
        $cpf = trim(strip_tags($_POST['ncpf']));

        $data = trim(strip_tags($_POST['data_nasc']));
        $dataObject = DateTime::createFromFormat('d-m-Y', $data);
        if ($dataObject !== false) {
            $birthdate = $dataObject->format('Y-m-d');
        } 
        else {
            echo 'Data inválida. Verifique o formato (Dia-Mês-Ano).';
        }
        $exito = $patient->createPatient($username, $password, $firstName, $surname, $sex, $email, $rg, $cpf, $birthdate);

        if ($exito) {
            echo "<script>alert('Paciente cadastrado com sucesso.');</script>";
        }
        else {
            echo "<script>alert('Não foi possível cadastrar o paciente.');</script>";
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
    <link rel="stylesheet" href="../css/createPatient.css">
    <title>Cadastro de Pacientes - Hospital Geral</title>
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
        <div class="title">Cadastro de pacientes</div>
        <div class="create">
            <form action="#" method="POST">
                <div class="username">
                    <label for="username">Nome de Usuário(a)</label>
                    <input type="text" class="form-control" name="usuario" id="username" required>
                </div>
                <div class="password">
                    <label for="surname">Senha de Usuário(a)</label>
                    <input type="text" class="form-control" name="senha" id="password" required>
                </div>
                <div class="first_name">
                    <label for="first_name">Nome</label>
                    <input type="text" class="form-control" name="nome" id="first_name" required>
                </div>
                <div class="surname">
                    <label for="surname">Sobrenome</label>
                    <input type="text" class="form-control" name="sobrenome" id="surname" required>
                </div>
                <div class="sex">
                    <label for="surname">Sexo (M/F)</label>
                    <input type="text" class="form-control" name="sexo" id="sex" placeholder="S" required>
                </div>
                <div class="email">
                    <label for="email">Endereço de Email</label>
                    <input type="text" class="form-control" name="e-mail" id="email" placeholder="example@email.com" required>
                </div>
                <div class="rg">
                    <label for="rg">RG</label>
                    <input type="text" class="form-control" name="r_g" id="rg" placeholder="00.000.000-0" required>
                </div>
                <div class="cpf">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" name="ncpf" id="cpf" placeholder="000.000.000-00" required>
                </div>
                <div class="birthdate">
                    <label for="birthdate">Data de Nascimento</label>
                    <input type="text" class="form-control" name="data_nasc" id="birthdate" placeholder="Dia-Mês-Ano" required>
                </div>
                <div class="button">
                    <input type="submit" value="Cadastrar Paciente" name="cadastrar" class="btn btn-block btn-primary">
                </div>
            </form>
        </div>
    </section>   
</body>
</html>