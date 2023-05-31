<?php

    include ('../connection/Connection.php');
    include ('../connection/ConsDAO.php');

    if (isset($_GET['consID'])) {
        $ID = $_GET['consID'];

        $cancel = new ConsDAO();

        $exito = $cancel->deleteSecondCons($ID);

        if ($exito) {
            header('location:../view/cancelStatus.php?cancel_success');
        }
        else {
            header('location:../view/cancelStatus.php?cancel_fail');
        }
    }