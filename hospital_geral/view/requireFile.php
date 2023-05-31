<?php
    session_start();
    
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit();
    }
    
    if (isset($_POST['solicitar'])) {

        include ('../connection/Connection.php');
        include ('../connection/RequireDAO.php');

        $require = new RequireDAO();

        $patientUsername = $_SESSION['usuario'];
        $patientName = trim(strip_tags($_POST['nome']));
        $patientSurname = $_POST['sobrenome'];
        $textoSolicitacao = $_POST['texto'];

        $exito = $require->createRequire($patientUsername, $patientName, $patientSurname, $textoSolicitacao);

        if ($exito) {
            echo "<script>alert('Solicitação realizada com sucesso, caso encontremos o documento, nós o enviaremos para você via email, aguarde.');</script>";
        }
        else {
            echo "<script>alert('Não foi possível realizar a solicitação.');</script>";
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
    <link rel="stylesheet" href="../css/requireFile.css">
    <title>Solicitar Documento - Hospital Geral</title>
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
            <a href="../view/systemPatients.php">< Página Principal</a>
        </div>
        <div class="content">
            <div class="title">
                Solicite um Documento em falta
            </div>
            <div class="appot">
                <form action="#" method="post">
                    <div class="name">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="nome" id="name" required>
                    </div>
                    <div class="surname">
                        <label for="surname">Sobrenome</label>
                        <input type="text" class="form-control" name="sobrenome" id="surname" required>
                    </div>
                    <div class="textR">
                        <textarea id="text" name="texto" rows="5" maxlength="500" placeholder="Nos informe sua situação, e o documento que deseja solicitar." required></textarea>
                    </div>
                    <div class="button">
                        <input type="submit" value="Solicitar Documento" name="solicitar" class="btn btn-block btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>