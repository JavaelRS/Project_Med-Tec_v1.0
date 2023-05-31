<?php

    include ('../connection/Connection.php');
    include ('../connection/RequireDAO.php');

    if (isset($_GET['reqID'])) {
        $ID = $_GET['reqID'];

        $delete = new RequireDAO();

        $exito = $delete->deleteRequire($ID);

        if ($exito) {
            header('location:../view/deleteStatus.php?delete_success');
        }
        else {
            header('location:../view/deleteStatus.php?delete_fail');
        }
    }