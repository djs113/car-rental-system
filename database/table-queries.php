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
        // $sql = "CREATE DATABASE car_rental_system_1;";
    
    // Selecting database
        // $sql .= "USE car_rental_system_1;";
    
        // User tables
            // Table creation
                $sql = "CREATE TABLE user_details (username VARCHAR(20) PRIMARY KEY, passwd VARCHAR(40), first_name VARCHAR(20), last_name VARCHAR(20), is_admin TINYINT DEFAULT 0);"; 
                $sql .= "CREATE TABLE user_emails (email varchar(30) PRIMARY KEY, username VARCHAR(30) UNIQUE NOT NULL);";
                $sql .= "CREATE TABLE user_phone_numbers (phone_number INT PRIMARY KEY, username VARCHAR(30) UNIQUE NOT NULL);";

            // Table alteration
                $sql .= "ALTER TABLE user_phone_numbers ADD CONSTRAINT FOREIGN KEY (username) REFERENCES user_details(username);";
                $sql .= "ALTER TABLE user_emails ADD CONSTRAINT FOREIGN KEY (username) REFERENCES user_details(username);";
            
                // Record Insertion
                $sql .= "INSERT INTO `user_details` (`username`, `passwd`, `first_name`, `last_name`) VALUES('aa', '4124bc0a9335c27f086f24ba207a4912', 'aa', 'bb');";
                $sql .= "INSERT INTO `user_emails` (`email`, `username`) VALUES('a@gmail.com', 'aa');";
                $sql .= "INSERT INTO `user_phone_numbers` (`phone_number`, `username`) VALUES(2313312321323, 'aa');";

    // Admin table 
        // Table creation
            $sql .= "CREATE TABLE admins (username VARCHAR(20) PRIMARY KEY, passwd VARCHAR(40));"; 
        
            // Record insertion
                $sql .= "INSERT INTO admins VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3');";
    
    // Vehicle tables
        
        // Table creation
                $sql .= "CREATE TABLE vehicle_models (model_id INT PRIMARY KEY AUTO_INCREMENT, brand_name VARCHAR(20), model_name VARCHAR(30), vehicle_type VARCHAR(20), hour_price INT, day_price INT, week_price INT, month_price INT);";
                $sql .= "CREATE TABLE vehicles (registration_number VARCHAR(11) PRIMARY KEY, vehicle_color VARCHAR(20), is_booked TINYINT DEFAULT 0, model_id INT, FOREIGN KEY (model_id) REFERENCES vehicle_models(model_id));";
                $sql .= "CREATE TABLE engine_numbers (engine_number VARCHAR(20) PRIMARY KEY, registration_number VARCHAR(11) UNIQUE, FOREIGN KEY (registration_number) REFERENCES vehicles(registration_number));";

        // Record Insertion
            $sql = "INSERT INTO vehicle_models VALUES (4, 'xcvfs', 'vcvsdfsf', 'cvxsdfs', 300, 1000, 2300, 7000);";
            $sql .= "INSERT INTO vehicles VALUES ('MN43LLJ23', 'lkcvlv', 0, 4);";
            $sql .= "INSERT INTO engine_numbers VALUES ('343BDSN452', 'MN43LLJ23');";
    
    // Card tables

        // Table creation
            $sql .= "CREATE TABLE card_details (card_number BIGINT PRIMARY KEY, name_on_card VARCHAR(30), expiry_date DATE);"; 
            $sql .= "CREATE TABLE user_cards (card_id BIGINT PRIMARY KEY AUTO_INCREMENT, card_name VARCHAR(20), username VARCHAR(20), card_number BIGINT, FOREIGN KEY (username) REFERENCES user_details(username), FOREIGN KEY (card_number) REFERENCES card_details(card_number));";    
        
            // Record Insertion
            $sql .= "INSERT INTO card_details VALUES (2343131231, 'abc', '2024-04-06');";
            $sql .= "INSERT INTO user_cards VALUES (5643234, 'card', 'aa', 2343131231);";
            $sql .= "INSERT INTO user_cards VALUES ('dsfafwerw', 'aa',  6757345)";

    // Booking tables

        // Table creation
            $sql = "CREATE TABLE card_booking_details (booking_id INT PRIMARY KEY AUTO_INCREMENT, pick_up_date DATE, pick_up_time TIME, drop_off_date date, drop_off_time time, payment_amount INT, payment_time DATETIME, card_id BIGINT, registration_number VARCHAR(11), FOREIGN KEY (registration_number) REFERENCES vehicles(registration_number), FOREIGN KEY (card_id) REFERENCES user_cards(card_id));";
            $sql .= "CREATE TABLE cash_booking_details (booking_id INT PRIMARY KEY AUTO_INCREMENT, pick_up_date DATE, pick_up_time TIME, drop_off_date date, drop_off_time time, payment_amount INT, payment_time DATETIME, username VARCHAR(20), registration_number VARCHAR(11), FOREIGN KEY (registration_number) REFERENCES vehicles(registration_number), FOREIGN KEY (username) REFERENCES user_details(username)) AUTO_INCREMENT = 2000000000;";
        
            // Record insertion
                $sql .= "INSERT INTO card_booking_details (pick_up_date, pick_up_time, drop_off_date, drop_off_time, payment_amount, payment_time, card_id, registration_number) VALUES ('2023-06-09', '09:07:00', '2023-06-13', '19:07:00', 1000, '2023-06-08 14:05:06', 5643234, 'MN43LLJ23');";
                $sql .= "INSERT INTO cash_booking_details (pick_up_date, pick_up_time, drop_off_date, drop_off_time, payment_amount, payment_time, username, registration_number) VALUES ('2023-06-05', '10:00:04', '2023-06-15', '15:07:00', 5000, '2023-06-04 11:03:00', 'aa', 'MN43LLJ23');";

    // Contact tables
        // Table creation
            $sql .= "CREATE TABLE contact_details_1 (contact_email varchar(20) PRIMARY KEY, contact_number_1 BIGINT);";
            $sql .= "CREATE TABLE contact_details_2 (contact_number_2 BIGINT PRIMARY KEY, address VARCHAR(50));";

    if ($conn->multi_query($sql) === TRUE)
        echo "Query successful";
    else  
        echo "Error in executing query".$conn->error; 
?>