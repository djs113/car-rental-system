<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'car_rental_system';
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);
    
    echo '
        <link rel="stylesheet" type="text/css" href="registration-action-page-css.css">    
    ';

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $enc_passwd = md5($passwd);

    $user_count_qry = "SELECT COUNT(*) FROM user_details WHERE username = '$username'";

    $user_count_res_array = mysqli_query($conn, $user_count_qry);
    $user_count_res = mysqli_fetch_array($user_count_res_array);

    $email_count_query = "SELECT COUNT(*) FROM user_emails WHERE email = '$email'";

    $email_count_res_array = mysqli_query($conn, $email_count_query);
    $email_count_res = mysqli_fetch_array($email_count_res_array);

    $phone_no_count_qry = "SELECT COUNT(*) FROM user_phone_numbers WHERE phone_number = $phone_number";

    $phone_no_count_res_array = mysqli_query($conn, $phone_no_count_qry);
    $phone_no_count_res = mysqli_fetch_array($phone_no_count_res_array);

    if (is_null($user_count_res))
        $user_count_res[0] = 0;
    
    if (is_null($email_count_res))
        $email_count_res[0] = 0;

    if (is_null($phone_no_count_res))
        $phone_no_count_res[0] = 0;

    if (($user_count_res[0] == 0) && ($email_count_res[0] == 0) && ($phone_no_count_res[0] == 0))
    {
        $sql = "INSERT INTO user_details (username, passwd, first_name, last_name) VALUES ('$username', '$enc_passwd', '$first_name', '$last_name');";
        $sql .= "INSERT INTO user_emails VALUES ('$email', '$username');";
        $sql .= "INSERT INTO user_phone_numbers VALUES ('$phone_number', '$username');";
        
        echo '
            <div class="main">    
        ';

        if ($conn->multi_query($sql) == TRUE)
        {
        echo '
                <p>User successfully added</p><br>
                <a href="/car-rental-system/registered-user/user-login/user-login-page.php">Login</a>
        ';
        } else
        {
            echo '
                <p>
                    Error in addition of user<br>
                    Error: '.$conn->error.'
                </p>
                <a href="/car-rental-system/registration/registration-form.html">Registration</a>
            ';       
        }
    } else 
    {
        echo '
            <div class="duplicate_details">
        ';
        
        if ($user_count_res[0] != 0)
        {
            echo '
                <p>There is already a user with this username</p>
            ';
        } else if ($email_count_res[0] != 0)
        {
            echo '
                <p>There is already a user with this email</p> 
            ';
        } else 
        {
            echo '
                <p>There is already a user with this phone number</p> 
            ';
        }

        echo '
            <a href="/car-rental-system/registration/registration-form.html">Go back</a> 
        ';
    }

    echo '
        </div>
    ';
?>