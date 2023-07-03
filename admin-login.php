<?php
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $enc_passwd = md5($passwd);

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'car_rental_system';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $qry = "SELECT passwd FROM admins WHERE username='$username'";
    $res_array = mysqli_query($conn, $qry);

    while ($res = mysqli_fetch_array($res_array))
    {
        if ($enc_passwd == $res['passwd'])
            echo "Successfully logged in";
        else 
            echo "Invalid username or password";
    }

?>