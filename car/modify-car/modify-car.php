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
        <link rel="stylesheet" type="text/css" href="/car-rental-system/car/modify-car/modify-car-css.css"> 
        <div class="main">  
    ';

    $registration_number = $_POST['registration_number'];
    $vehicle_color = $_POST['vehicle_color'];
    $is_booked = $_POST['is_booked'];
    $model_id = $_POST['model_id_val'];
    $engine_number = $_POST['engine_number'];

    $qry = "UPDATE vehicles SET vehicle_color = '$vehicle_color', is_booked = '$is_booked', model_id = '$model_id' WHERE registration_number = '$registration_number';";
    $qry .= "UPDATE engine_numbers SET engine_number = '$engine_number' WHERE registration_number = '$registration_number'";
    
    if ($conn->multi_query($qry) == TRUE)
        echo "Car successfully modified.<br><br>";
    else
        echo "Error in modification of car.<br>Error: ".$conn->error;
   
    echo '
            <a href="/car-rental-system/admin/admin-home/admin-home-page.php">Go back</a>
        </div>
    ';
?>