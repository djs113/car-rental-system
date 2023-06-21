<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'car_rental_system';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
    {
        die("Connection error".$conn->connect_error);
    }

    echo "Connection successful<br>";

    // $sql = "CREATE DATABASE car_rental_system";
    $sql = "CREATE TABLE user_details (username VARCHAR(20) PRIMARY KEY, passwd VARCHAR(20), first_name VARCHAR(20), last_name VARCHAR(20), is_admin TINYINT DEFAULT 0)"; 
    // $sql = "INSERT INTO library VALUES (1, 'dfsa', 'sdvsfvs', 1200, 3, '2020-02-04')";
    // $sql = "UPDATE library SET book_id = 2 WHERE book_id = 1";
    // $sql = "INSERT INTO library VALUES (1, 'kasdlksjf', 'slkalja', 3888, 5, '2010-04-11')";
    // $sql = "DELETE FROM library WHERE book_id = 2";
    
    if ($conn->query($sql) === TRUE)
    {
        echo "Query successful";
    } else 
    {
        echo "Error in executing query";
    }
?>