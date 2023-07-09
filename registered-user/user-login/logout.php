<?php
    session_start();
    session_unset();
    session_destroy();

    header("location:/car-rental-system/registered-user/user-login/user-login-page.html");
?>