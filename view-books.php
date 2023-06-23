<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'car-rental-system';
   
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
        die("Connection failed".$conn->connect_error);
   
    $sql = "SELECT * FROM user_details, user_emails, user_phone_numbers WHERE user_email.username = user_details.username = user_phone_numbers.username";
    $res_array = mysqli_query($conn, $sql);

    // echo '<table '
    while ($result = mysqli_fetch_array($res_array))
    {
        
    }

    

?>