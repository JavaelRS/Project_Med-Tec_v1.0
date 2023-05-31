<?php
    if ($_POST) {
        include('../connection/Connection.php');
        include('../connection/StaffDAO.php');

        $staffDAO = new StaffDAO();

        $username = addslashes($_POST['usuario']);
        $password = addslashes($_POST['senha']);

        $staff = $staffDAO->login($username, $password);

        if($staff) {
            session_start();
            $_SESSION['type'] = "funcionario";
            $_SESSION['usuario'] = $username;
            $_SESSION['senha'] = $password;
            header('location: ../view/systemStaff.php');
        }
        else {
            header('location: ../view/loginStaff.php?erro=senha');
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
    <link rel="stylesheet" href="../css/login.css">
    <title>Entrar - Hospital Geral</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="../assets/logoStaff.png" alt="logo hospital geral">
        </div>
        <form action="#" method="post">
            <div class="username">
                <label for="username">Usuário</label>
                <input type="text" class="form-control" name="usuario" id="username" required>
            </div>
            <div class="password">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="senha" id="password" required>
            </div>
            <div class="button">
                <input type="submit" value="Entrar" class="btn btn-block btn-primary">
            </div>
        </form>
        <div class="back">
            <a href="../view/option.php">< Voltar</a>
        </div>
    </div>
</body>
<?php
  if(isset($_GET['erro'])) {
    echo "<script>alert('Usuário ou senha incorretos.');</script>";
  }
?>
</html>