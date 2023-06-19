<?php
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $date_of_purchase = $_POST['date_of_purchase'];

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'books';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

     if ($conn->connect_error)
    {
        die("Connection failed".$conn->connect_error);
    }

    // echo "Connection Successful<br>";
    
    $sql = "INSERT INTO books VALUES ('$book_id', '$book_name', '$author', '$price', '$quantity', '$date_of_purchase')";

    if ($conn->query($sql) === TRUE)
    {
        echo "Book successfully added to the database";
    } else
    {
        echo "Error in addition of book";
    }

    $conn->close();
?>