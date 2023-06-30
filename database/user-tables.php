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
    
    // Database creation
    // $sql = "CREATE DATABASE car_rental_system";
    
    // Table creation
    // $sql = "CREATE TABLE user_details (username VARCHAR(20) PRIMARY KEY, passwd VARCHAR(20), first_name VARCHAR(20), last_name VARCHAR(20), is_admin TINYINT DEFAULT 0)"; 
    // $sql = "CREATE TABLE user_emails (email varchar(30) PRIMARY KEY, username VARCHAR(30) UNIQUE NOT NULL)";
    // $sql = "CREATE TABLE user_phone_numbers (phone_number INT PRIMARY KEY, username VARCHAR(30) UNIQUE NOT NULL)";
    
    // $sql = "INSERT INTO user_details VALUES (1, 'dfsa', 'sdvsfvs', 1200, 3, '2020-02-04')";
    // $sql = "UPDATE library SET book_id = 2 WHERE book_id = 1";
    // $sql = "INSERT INTO library VALUES (1, 'kasdlksjf', 'slkalja', 3888, 5, '2010-04-11')";
    // $sql = "DELETE FROM library WHERE book_id = 2";
   
    //$sql = "ALTER TABLE user_phone_numbers ADD CONSTRAINT FOREIGN KEY (username) REFERENCES user_details(username)";
    $sql = "ALTER TABLE user_emails DROP username";
    if ($conn->query($sql) === TRUE)
    {
        echo "Query successful";
    } else 
    {
        echo "Error in executing query".$conn->error;
    }
?>