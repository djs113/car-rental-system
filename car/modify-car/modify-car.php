<?php
    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $registration_number = $_POST['registration_number'];
    $vehicle_color = $_POST['vehicle_color'];
    $is_booked = $_POST['is_booked'];
    $model_id = $_POST['model_id'];
   
    $qry = "UPDATE vehicles SET vehicle_color = '$vehicle_color', is_booked = '$is_booked', model_id = '$model_id' WHERE registration_number = '$registration_number';";
 
    if ($conn->query($qry) == TRUE)
        echo "Car successfully modified<br>";
    else
        echo "Error in modification of car<br>Error: ".$conn->error;
    
?>
