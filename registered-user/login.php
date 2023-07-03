<?php
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $enc_passwd = md5($passwd);

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'car_rental_system';
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
    {
        die("Connection failed<br>Connection Error: ".$conn->connect_error);
    }

    $qry = "SELECT passwd from user_details WHERE username='$username'";
    $res_array = mysqli_query($conn, $qry);
    
    while ($res = mysqli_fetch_array($res_array))
    {
        if ($enc_passwd == $res['passwd']) 
            echo "Successfully logged in";
        else 
            echo "Incorrect password or username"; 
    }
?>
