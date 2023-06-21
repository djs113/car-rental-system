<?php
    $username = $_POST[''];
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
        die("Connection error".$conn->connect_error);
    }

    $sql = "INSERT INTO library VALUES ('$book_id', '$book_name', '$author', '$price', '$quantity', '$date_of_purchase')";

    if ($conn->query($sql) === TRUE)
    {
        echo "Book successfully added<br>";
    } else
    {
        echo "Error in addition of book<br>Error: ".$conn->error;
    }

    $conn->close();

?>