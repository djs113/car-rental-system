<?php
    function dbConnection() {
        $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

        if ($conn->connect_error)
            die("Connection failed<br>Connection Error: ".$conn->connect_error);
        
        return $conn;
    }
?>