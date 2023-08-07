<?php
    session_start();

    if (!isset($_SESSION['login_user']))
    {
        header("location:/car-rental-system/registered-user/user-login/user-login-page.html");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');
        
    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $model_id = $_SESSION['model_id'];
    
    if (!isset($_SESSION['payment_success']))
    {
        header("location:/car-rental-system/registered-user/vehicle-search-form.php");
        exit;
    }

    // retreive unbooked vehicles

    $qry = "SELECT ";
?>