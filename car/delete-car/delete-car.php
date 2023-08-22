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

    $registration_number = $_POST['registration_number'];

    $qry = "DELETE FROM card_booking_details WHERE registration_number = '$registration_number';";
    $qry .= "DELETE FROM cash_booking_details WHERE registration_number = '$registration_number';";

    $qry .= "DELETE FROM engine_numbers WHERE registration_number = '$registration_number';";
    $qry .= "DELETE FROM vehicles WHERE registration_number = '$registration_number';";
 
    if ($conn->multi_query($qry) == TRUE)
        echo "Car successfully deleted.<br>";
    else
        echo "Error in deletion of car.<br>Error: ".$conn->error;
?>