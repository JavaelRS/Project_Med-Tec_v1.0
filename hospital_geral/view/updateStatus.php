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

    if (isset($_GET['update_success'])) {
        echo "<script>alert('Registro atualizado com sucesso.');</script>";
    }
    else if (isset($_GET['update_fail'])) {
        echo "<script>alert('Não foi possível atualizar o registro.');</script>";
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../assets/icon.png">
    <link rel="stylesheet" href="../css/updateStatus.css">
    <title>Hospital Geral</title>
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
    </section>
</body>
</html>