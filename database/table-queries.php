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
   
    // User tables

        // Table creation
            // $sql = "CREATE TABLE user_details (username VARCHAR(20) PRIMARY KEY, passwd VARCHAR(40), first_name VARCHAR(20), last_name VARCHAR(20), is_admin TINYINT DEFAULT 0)"; 
            // $sql = "CREATE TABLE user_emails (email varchar(30) PRIMARY KEY, username VARCHAR(30) UNIQUE NOT NULL)";
            // $sql = "CREATE TABLE user_phone_numbers (phone_number INT PRIMARY KEY, username VARCHAR(30) UNIQUE NOT NULL)";
            // $sql = "CREATE TABLE admins (username VARCHAR(20), passwd VARCHAR(40))";

        // $sql = "ALTER TABLE user_phone_numbers ADD CONSTRAINT FOREIGN KEY (username) REFERENCES user_details(username)";
        // $sql = "ALTER TABLE user_emails ADD CONSTRAINT FOREIGN KEY (username) REFERENCES user_details(username)";

    // Admin table 
        // $sql = "CREATE TABLE user_details (username VARCHAR(20) PRIMARY KEY, passwd VARCHAR(40))"; 
    
        if ($conn->query($sql) === TRUE)
    {
        echo "Query successful";
    } else 
    {
        echo "Error in executing query".$conn->error;
    }
?>