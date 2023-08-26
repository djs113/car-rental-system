<?php
    session_start();

    if (!isset($_SESSION['login_user']))
    {
        header("location:/car-rental-system/registered-user/user-login/user-login-page.html");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $username = $_SESSION['login_user'];

    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone_number']))
    {
        echo '
            <link rel="stylesheet" type="text/css" href="edit-profile-script-css.css">
            <div class="main">
        ';
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];

        $qry = "UPDATE user_details SET first_name = '$first_name', last_name = '$last_name' WHERE 
                username = '$username';";
        $qry .= "UPDATE user_emails SET email = '$email' WHERE username = '$username';";
        $qry .= "UPDATE user_phone_numbers SET phone_number = $phone_number WHERE username = '$username';";

        if ($conn->multi_query($qry) == TRUE)
            echo 'Successfully updated profile';
        else
        {
            echo '
                Error in profile updation<br>     
                Error: '.$conn->error;
        }

        echo '
            </div>
            <br><br>
            <button><a href="/car-rental-system/registered-user/profile-management/edit-profile.php">Go back</a></button> 
        ';
    } else
        header("location:/car-rental-system/registered-user/edit-profile.php");
?>