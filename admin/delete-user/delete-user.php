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

    $username = $_POST['username'];

    $qry = "DELETE FROM cash_booking_details WHERE username = '$username';";
    $qry .= "DELETE FROM user_cards WHERE username = '$username';";
    
    $qry .= "DELETE FROM user_emails WHERE username = '$username';";
    $qry .= "DELETE FROM user_phone_numbers WHERE username = '$username';";
    
    $qry .= "DELETE FROM user_details WHERE username = '$username';";
 
    if ($conn->multi_query($qry) == TRUE)
        echo "User successfully deleted.<br>";
    else
        echo "Error in deletion of user.<br>Error: ".$conn->error;
?>