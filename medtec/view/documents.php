<?php
  if ($_POST) {
    include('../connection/Connection.php');
    include('../connection/CodeDAO.php');

    $codeDAO = new CodeDAO();

    $codeValue = addslashes($_POST['codigo']);
    $cpf = addslashes($_POST['ncpf']);

    $code = $codeDAO->validate($codeValue, $cpf);

    if($code == true) {
        echo "<script>alert('O Código informado consta em nossa base de dados e está ligado ao CPF informado, o documento é válido.');</script>";
    }
    else {
        echo "<script>alert('O Código e CPF informados não estão ligados de acordo com nossa base de dados, ou não existem, o documento é inválido.');</script>";
    }
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/documents.css">
        <link rel="shortcut icon" type="image/png" href="../assets/medtec-logo.png">
        <title>Hospitais - Med-Tec Sistemas</title>
    </head>
    <body>
        <header>
            <div class="logo">
                <img src="../assets/medtec-logo.png" alt="logo medtec">
            </div>
            <div class="menu-login">
                <div class="menu">
                    <a href="../index.php">Página Principal</a>
                    <a href="../view/hospitals.php">Hospitais</a>
                    <a href="../view/documents.php">Documentos</a>
                    <a href="../view/contact.php">Contato</a>
                </div>
            </div>
        </header>
        <section>
            <div class="content">
                <div class="title">
                    <h1>Validação de documentos com o Código Med-Tec</h1>
                </div>
                <div class="text">Documentos emitidos pela Med-Tec têm um código gerado automaticamente para verificar sua autencidade, para evitar falsificações de documentos médicos.</div>
                <div class="valid">
                    <form action="#" method="post">
                        <div class="code">
                            <label for="code">Código Med-Tec</label>
                            <input type="text" class="form-control" name="codigo" id="code" required>
                        </div>
                        <div class="cpf">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" name="ncpf" id="cpf" required>
                        </div>
                        <div class="button">
                            <input type="submit" value="Validar" class="btn btn-block btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>