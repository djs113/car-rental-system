<?php
    session_start();
    unset($_SESSION['login_user']);
    
    header("location:/car-rental-system/registered-user/user-login/user-login-page.html");
?>