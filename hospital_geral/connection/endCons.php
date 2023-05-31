<?php

    include ('../connection/Connection.php');
    include ('../connection/ConsDAO.php');

    if (isset($_GET['consID'])) {
        $ID = $_GET['consID'];

        $delete = new ConsDAO();

        $exito = $delete->deleteSecondCons($ID);

        if ($exito) {
            header('location:../view/deleteStatus.php?delete_success');
        }
        else {
            header('location:../view/deleteStatus.php?delete_fail');
        }
    }