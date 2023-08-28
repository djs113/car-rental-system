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

    echo '
        <link rel="stylesheet" type="text/css" href="/car-rental-system/car/add-car/add-car-script-css.css">
        <div class="main">
            <p>
    ';


    $brand_name = $_POST['brand_name'];
    $model_name = $_POST['model_name'];
    $registration_number = $_POST['registration_number'];
    $engine_number = $_POST['engine_number'];
    $vehicle_color = $_POST['vehicle_color'];

    $qry = "SELECT model_id FROM vehicle_models WHERE brand_name = '$brand_name' AND 
            model_name = '$model_name'";
    
    $res_array = mysqli_query($conn, $qry);

    $res = mysqli_fetch_array($res_array);
    $model_id = $res['model_id'];

    $qry = "INSERT INTO vehicles (registration_number, vehicle_color, model_id) VALUES 
    ('$registration_number', '$vehicle_color', '$model_id');";
    
    $qry .= "INSERT INTO engine_numbers VALUES ('$engine_number', '$registration_number');";
    
    if ($conn->multi_query($qry) == TRUE)
        echo 'Successfully added car!';
    else
        echo 'Error in addition of car';

    echo '
            </p>
            <button><a href="/car-rental-system/car/add-car/add-car-form.php">Go back</a></button>
        </div>    
    '; 
?>