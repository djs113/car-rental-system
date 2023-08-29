<?php
    session_start();

    if (!isset($_SESSION['login_admin']))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login-form.php");
        exit;
    }

    $brand_name = $_POST['brand_name'];
    $model_name = $_POST['model_name'];
    $vehicle_type = $_POST['vehicle_type'];
    $hour_price = $_POST['hour_price'];
    $day_price = $_POST['day_price'];
    $week_price = $_POST['week_price'];
    $month_price = $_POST['month_price'];

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection failed<br>Connection Error: ".$conn->connect_error);

    echo '
        <link rel="stylesheet" type="text/css" href="/car-rental-system/car-model/add-car-model/add-car-model-css.css">    
        <div class="main">
            <p>   
    ';

    $qry = "INSERT INTO vehicle_models (brand_name, model_name, vehicle_type, hour_price, day_price, week_price, month_price) VALUES ('$brand_name', '$model_name', '$vehicle_type', $hour_price, $day_price, $week_price, $month_price)";
    
    if ($conn->query($qry) === TRUE)
        echo "Car model successfuly added<br>";
    else
        echo "Error in addition of car model<br>Error: ".$conn->error."<br>";

    echo '
            </p>
            <a href="/car-rental-system/car-model/add-car-model/add-car-model-form.php">Go back</a> 
        </div> 
    ';
?>