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

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO user_details VALUES ('$username', '$oasswd', '$first_name', '$last_name')";

    if ($conn->query($sql) === TRUE)
    {
        echo "Book successfully added<br>";
    } else
    {
        echo "Error in addition of book<br>Error: ".$conn->error;
    }

    $conn->close();

?>