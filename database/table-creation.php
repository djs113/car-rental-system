<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = "";
    $dbname = "books";
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if ($conn->connect_error)
    {
        die("Connection error".$conn->connect_error);
    }

    echo "Connection successful<br>";

    // $sql = "INSERT INTO library VALUES (1, 'aaa', 'abc', 1000, 3, '2010-01-03')";
    // $sql = "UPDATE library SET book_name = 'bbb' WHERE book_id = 1";
    // $sql = "INSERT INTO library VALUES (2, 'aaa', 'cac', 3000, 6, '2020-05-03')";
    
    $sql = "DELETE FROM library WHERE book_id = 1";

    if ($conn->query($sql) === TRUE)
    {
        echo "Successfully deleted record";
    } else
    {
        echo "Error in record deletion";
    }
    
    $conn->close();
?>