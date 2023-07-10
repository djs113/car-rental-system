<?php
    session_start();

    if (!isset($_SESSION['login_admin']))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login.php");
        exit;
    }
    
    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    // $brand_name = $_POST['brand_name'];
    // $model_name = $_POST['model_name'];

    $model_id = $_POST['model_id'];

    $qry = "DELETE FROM vehicle_models WHERE model_id = $model_id";
 
    if ($conn->query($qry) == TRUE)
        echo "Car model successfully deleted.<br>";
    else
        echo "Error in deletion of car model.<br>Error: ".$conn->error;
?>