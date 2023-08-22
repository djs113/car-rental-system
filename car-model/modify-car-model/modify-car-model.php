<?php
    session_start();

    if (!isset($_SESSION['login_admin']))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login-form.php");
        exit;
    }
    
    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $model_id = $_POST['model_id'];
    $brand_name = $_POST['brand_name'];
    $model_name = $_POST['model_name'];
    $vehicle_type = $_POST['vehicle_type'];
    $hour_price = $_POST['hour_price'];
    $day_price = $_POST['day_price'];
    $week_price = $_POST['week_price'];
    $month_price = $_POST['month_price'];

    $qry = "UPDATE vehicle_models SET brand_name = '$brand_name', model_name = '$model_name', vehicle_type = '$vehicle_type', hour_price = $hour_price, day_price = $day_price, week_price = $week_price, month_price = $month_price WHERE model_id = $model_id;";
 
    if ($conn->query($qry) == TRUE)
        echo "Car model successfully modified.<br>";
    else
        echo "Error in modification of car model.<br>Error: ".$conn->error;
?>