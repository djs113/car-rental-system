<?php
    require '/opt/lampp/htdocs/car-rental-system/login/login-functions/password-check.php';
    require '/opt/lampp/htdocs/car-rental-system/common-functions.php';
    
    $conn = dbConnection();
    passwordCheck('admins', $conn);
?>