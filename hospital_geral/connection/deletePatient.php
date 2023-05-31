<?php

    include ('../connection/Connection.php');
    include ('../connection/PatientDAO.php');

    if (isset($_GET['patientID'])) {
        $ID = $_GET['patientID'];

        $delete = new PatientDAO();

        $exito = $delete->deletePatient($ID);

        if ($exito) {
            header('location:../view/deleteStatus.php?delete_success');
        }
        else {
            header('location:../view/deleteStatus.php?delete_fail');
        }
    }