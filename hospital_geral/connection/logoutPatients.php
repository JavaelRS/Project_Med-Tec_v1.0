<?php

    include('../connection/Connection.php');
    include('../connection/PatientDAO.php');

    $patient = new PatientDAO();

    $logout = $patient -> logout();