<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'books';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
    {
        die("Connection error".$conn->connect_error);
    }

    echo "Connection successful<br>";

    // $sql = "CREATE DATABASE books";
    // $sql = "CREATE TABLE library (book_id INT PRIMARY KEY, book_name VARCHAR(30), author VARCHAR(30), book_price FLOAT, quantity INT, date_of_purchase DATE)"; 
    // $sql = "INSERT INTO library VALUES (1, 'dfsa', 'sdvsfvs', 1200, 3, '2020-02-04')";
    // $sql = "UPDATE library SET book_id = 2 WHERE book_id = 1";
    // $sql = "INSERT INTO library VALUES (1, 'kasdlksjf', 'slkalja', 3888, 5, '2010-04-11')";
    $sql = "DELETE FROM library WHERE book_id = 2";
   
    if ($conn->query($sql) === TRUE)
    {
        echo "Record deletion successful";
    } else 
    {
        echo "Error in record deletion";
    }
?>