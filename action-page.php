<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'car_rental_sytem';
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
    {
        die("Connection error".$conn->connect_error);
    }

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO user_details VALUES ('$username', '$passwd', '$first_name', '$last_name')";

    if ($conn->query($sql) === TRUE)
    {
        echo "User successfully added<br>";
    } else
    {
        echo "Error in addition of user<br>Error: ".$conn->error;
    }

    $conn->close();

?>