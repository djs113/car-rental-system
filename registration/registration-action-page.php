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

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $enc_passwd = md5($passwd);

    $sql = "INSERT INTO user_details (username, passwd, first_name, last_name) VALUES ('$username', '$enc_passwd', '$first_name', '$last_name');";
    $sql .= "INSERT INTO user_emails VALUES ('$email', '$username');";
    $sql .= "INSERT INTO user_phone_numbers VALUES ('$phone_number', '$username');";
    
    if ($conn->multi_query($sql) == TRUE)
    {
       echo 'User successfully added<br>
             <button><a href="/car-rental-system/registered-user/user-login/user-login-page.html">Login</a></button>
       ';
    } else
    {
        echo 'Error in addition of user<br>Error: '.$conn->error.'
              <button><a href="/car-rental-system/registration/registration-form.html">Registration</a></button>
        ';
             
    }

    $conn->close();

?>