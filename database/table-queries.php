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
        // Table creation
            // $sql = "CREATE TABLE admins (username VARCHAR(20) PRIMARY KEY, passwd VARCHAR(40))"; 
        
            // Record insertion
            // $sql = "INSERT INTO admins VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3')";
    
    // Vehicle tables
        // Table creation
            // $sql = "CREATE TABLE vehicle_models (model_id INT PRIMARY KEY AUTO_INCREMENT, brand_name VARCHAR(20), model_name VARCHAR(30), vehicle_type VARCHAR(20), hour_price INT, day_price INT, week_price INT, month_price INT)";
            // $sql = "CREATE TABLE vehicles (registration_number VARCHAR(11) PRIMARY KEY, vehicle_color VARCHAR(20), is_booked TINYINT DEFAULT 0, model_id int, FOREIGN KEY (model_id) REFERENCES vehicle_models(model_id))";
            // $sql = "CREATE TABLE engine_numbers (engine_number VARCHAR(20) PRIMARY KEY, registration_number VARCHAR(11) UNIQUE, FOREIGN KEY (registration_number) REFERENCES vehicles(registration_number))";

        // Record Insertion
            //$sql = "INSERT INTO vehicles VALUES ('MN43LLJ23', 'lkcvlv', 0, 4)";
            //$sql = "INSERT INTO engine_numbers VALUES ('343BDSN452', 'MN43LLJ23')";
    
    // Booking table
        // Table creation
            // $sql = "CREATE TABLE booking_details (booking_id INT PRIMARY KEY, is_booked_for VARCHAR(20), booking_duration INT, pick_up_date DATE, pick_up_time TIME, payment_amount INT, payment_time DATETIME, card_number INT DEFAULT NULL, username VARCHAR(20), registration_number VARCHAR(11), FOREIGN KEY (username) REFERENCES user_details(username), FOREIGN KEY (registration_number) REFERENCES vehicles(registration_number))";
        
        // Record insertion
            $sql = "INSERT INTO booking_details VALUES (22, 'hours', 5, '2023-06-09', '09:07:00', 1000, '2023:06:08:14:05:06', 2342453, 'aa', 'MN43LLJ23')";
            
    if ($conn->query($sql) === TRUE)
    {
        echo "Query successful";
    } else 
    {
        echo "Error in executing query".$conn->error;
    }
?>