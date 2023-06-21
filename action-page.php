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
<<<<<<< HEAD

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

     if ($conn->connect_error)
    {
        die("Connection failed".$conn->connect_error);
    }

    // echo "Connection Successful<br>";
    
=======
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
    {
        die("Connection error".$conn->connect_error);
    }

>>>>>>> refs/remotes/origin/main
    $sql = "INSERT INTO library VALUES ('$book_id', '$book_name', '$author', '$price', '$quantity', '$date_of_purchase')";

    if ($conn->query($sql) === TRUE)
    {
<<<<<<< HEAD
        echo "Book successfully added to the database";
    } else
    {
        echo "Error in addition of book".$conn->error;
    }

    $conn->close();
=======
        echo "Book successfully added<br>";
    } else
    {
        echo "Error in addition of book<br>Error: ".$conn->error;
    }

    $conn->close();

>>>>>>> refs/remotes/origin/main
?>