<?php
    session_start();
    session_unset();
    session_destroy();

    header("location:/car-rental-system/admin/admin-login/admin-login.php");
?>