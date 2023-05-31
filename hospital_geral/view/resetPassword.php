<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
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
                $currentPassword = $row['passwordPat'];
            }
        }
    }

    if (isset($_POST['reset'])) {
        $update = new PatientDAO();

        $ID = $_POST['ID'];
        $oldPassword = trim(strip_tags($_POST['senha_atual']));
        $newPassword = trim(strip_tags($_POST['senha_nova']));
        $confirm_newPassword = trim(strip_tags($_POST['confirmar_novaSenha']));

        if ($currentPassword != $oldPassword) {
            echo "<script>alert('Senha Atual incorreta.');</script>";
        }
        else {
            if ($newPassword != $confirm_newPassword) {
                echo "<script>alert('As senhas não coincidem.');</script>";
            }
            else {
                $exito = $update->resetPassword(intval($ID), $newPassword);

                if ($exito) {
                    echo "<script>alert('Senha alterada com sucesso.');</script>";
                }
                else {
                    echo "<script>alert('Não foi possível alterar a senha.');</script>";
                }
            }
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
    <link rel="stylesheet" href="../css/resetPassword.css">
    <title>Definir Nova Senha - Hospital Geral</title>
</head>
<body>
    <header>
        <div class="head">
            <div class="logo">
                <img src="../assets/logoPatients.png" alt="logo hospital geral">
            </div>
            <div class="user">
                <h1>Olá <?php echo $_SESSION['usuario']; ?>.</h1>
                <a href="../connection/logoutPatients.php">Sair</a>
            </div>
        </div>
        <div class="menu">
            <div class="drop-down">
                <select class="drop" name="const" id="const" onclick="resetSelectedOption5()">
                    <option value="" disabled selected hidden>Perfil</option>
                    <option value="const_ag" data-href="../view/userProfile.php">Meu Perfil</option>
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
                <select class="drop" name="documentos" id="documentos" onclick="resetSelectedOption()">
                    <option value="" disabled selected hidden>Documentos</option>
                    <option value="cons_patient" data-href="../view/readFilesPatient.php">Meus Documentos</option>
                    <option value="req_file" data-href="../view/requireFile.php">Solicitar Documento</option>
                </select>
                <script>
                    function resetSelectedOption() {
                        const selectElement = document.getElementById('documentos');
                        selectElement.selectedIndex = 0;
                    }

                    const selectElement = document.getElementById('documentos');
                    selectElement.addEventListener('change', function() {
                        const selectedOption = this.options[this.selectedIndex];
                        const href = selectedOption.getAttribute('data-href');
                        window.location.href = href;
                    });
                </script>
            </div>
            <div class="drop-down">
                <select class="drop" name="cons" id="cons" onclick="resetSelectedOption2()">
                    <option value="" disabled selected hidden>Consultas</option>
                    <option value="cr_sala" data-href="../view/readConsPatients.php">Minhas Consultas</option>
                </select>
                <script>
                    function resetSelectedOption2() {
                        const selectElement2 = document.getElementById('cons');
                        selectElement2.selectedIndex = 0;
                    }

                    const selectElement2 = document.getElementById('cons');
                    selectElement2.addEventListener('change', function() {
                        const selectedOption2 = this.options[this.selectedIndex];
                        const href2 = selectedOption2.getAttribute('data-href');
                        window.location.href = href2;
                    });
                </script>
            </div>
        </div>
    </header>
    <section>
        <div class="back">
            <a href="../view/userProfile.php">< Perfil do Usuário</a>
        </div>
        <div class="create">
            <form action="#" method="POST">
                <input type="hidden" name="ID" value="<?php echo $ID; ?>">
                <div class="old_password">
                    <label for="old_password">Senha Atual</label>
                    <input type="password" class="form-control" name="senha_atual" id="old_password" required>
                </div>
                <div class="new_password">
                    <label for="surname">Nova Senha</label>
                    <input type="password" class="form-control" name="senha_nova" id="new_password" required>
                </div>
                <div class="confirm_newPassword">
                    <label for="surname">Confirmar Nova Senha</label>
                    <input type="password" class="form-control" name="confirmar_novaSenha" id="confirm_newPassword" required>
                </div>
                <div class="button">
                    <input type="submit" value="Definir Nova Senha" name="reset" onclick="return confirm('Tem certeza que deseja definir uma nova senha?');" class="btn btn-block btn-primary">
                </div>
            </form>
        </div>
    </section>
</body>
</html>