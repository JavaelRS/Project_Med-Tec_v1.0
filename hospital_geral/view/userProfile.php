<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit();
    }

    $patientUsername = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../assets/icon.png">
    <link rel="stylesheet" href="../css/userProfile.css">
    <title>Perfil do Usuário - Hospital Geral</title>
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
                    <option value="const_ag" data-href="#">Meu Perfil</option>
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
            <a href="../view/systemPatients.php">< Página Principal</a>
        </div>
        <div class="container">
            <h1>Perfil de <?php echo $patientUsername ?></h1>
            <form action="#" method="POST">
                <div class="form-group">
                    <input type="submit" value="Meu Perfil" name="profile" class="btn btn-primary">
                </div>
            </form>  
            <?php
                include ('../connection/Connection.php');
                include ('../connection/PatientDAO.php');

                if(isset($_POST['profile'])) {

                    $profile = new PatientDAO();
                    $profile->readPatientProfile($patientUsername);
                }
            ?>      
        </div>
    </section>
</body>
</html>