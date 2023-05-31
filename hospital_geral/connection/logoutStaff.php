<?php

    include('../connection/Connection.php');
    include('../connection/StaffDAO.php');

    $staff = new StaffDAO();

    $logout = $staff -> logout();