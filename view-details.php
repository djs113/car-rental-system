<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'car_rental_system';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
        die("Connection failed<br>Connection Error: ".$conn->connect_error);
  
    $sql = "SELECT * FROM user_details INNER JOIN user_emails ON user_details.username = user_emails.username 
    INNER JOIN user_phone_numbers ON user_details.username = user_phone_numbers.username";
    
    
?>