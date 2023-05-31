<?php
    if(isset($_POST['agendar'])) {

        include ('../connection/Connection.php');
        include ('../connection/ConsDAO.php');

        $send = new ConsDAO();

        $statusCons = "Solicitada";
        $patient_name = trim(strip_tags($_POST['nome']));
        $patient_surname = $_POST['sobrenome'];
        $patient_email = trim(strip_tags($_POST['e-mail']));
        $patient_sex = trim(strip_tags($_POST['sexo']));
        $patient_rg = trim(strip_tags($_POST['nrg']));
        $patient_cpf = trim(strip_tags($_POST['ncpf']));
        $text_cons = $_POST['texto'];

        $data = trim(strip_tags($_POST['data_nasc']));
        $dataObject = DateTime::createFromFormat('d-m-Y', $data);
        if ($dataObject !== false) {
            $birthdate = $dataObject->format('Y-m-d');
        } 
        else {
            echo 'Data inválida. Verifique o formato (Dia-Mês-Ano).';
        }

        $exito = $send->createCons($statusCons, $patient_name, $patient_surname, $patient_email, $patient_sex, $patient_rg, $patient_cpf, $birthdate, $text_cons);

        if ($exito) {
            echo "<script>alert('Sua solicitação de consulta médica foi enviada com sucesso, logo você receberá um email confirmando o agendamento da consulta médica.');</script>";
        }
        else {
            echo "<script>alert('Não foi possível enviar sua solicitação de consulta médica, tente novamente.');</script>";
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
    <link rel="stylesheet" href="../css/contact.css">
    <title>Contato - Hospital Geral</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../assets/logo.png" alt="logo hospital geral">
        </div>
        <div class="menu">
            <a href="../index.php">Página Principal</a>
            <a href="../view/contact.php">Contato</a>
            <a href="../view/option.php">Entrar</a>
        </div>
    </header>
    <section>
        <div class="content">
                <div class="title">
                    <h1>Agende uma consulta com nós</h1>
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
                        <div class="email">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="e-mail" id="email" placeholder="exemplo@email.com" required>
                        </div>
                        <div class="sex">
                            <label for="sex">Sexo(M/F)</label>
                            <input type="text" class="form-control" name="sexo" id="sex" placeholder="S" required>
                        </div>
                        <div class="rg">
                            <label for="rg">RG</label>
                            <input type="text" class="form-control" name="nrg" id="rg" placeholder="00.000.000-0" required>
                        </div>
                        <div class="cpf">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" name="ncpf" id="cpf" placeholder="000.000.000-00" required>
                        </div>
                        <div class="birthdate">
                            <label for="birthdate">Data de Nascimento</label>
                            <input type="text" class="form-control" name="data_nasc" id="birthdate" placeholder="Dia-Mês-Ano" required>
                        </div>
                        <div class="textM">
                            <label for="text">Motivo da consulta</label>
                            <textarea id="text" name="texto" rows="5" maxlength="500" placeholder="Nos descreva a sua situação" required></textarea>
                        </div>
                        <div class="button">
                            <input type="submit" value="Agendar Consulta" name="agendar" class="btn btn-block btn-primary">
                        </div>
                    </form>
                </div>
            </div>
    </section>
</body>
</html>