<?php
    session_start();

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $enc_passwd = md5($passwd);
    
    $qry = "SELECT passwd FROM user_details WHERE username='$username'";
    $res_array = mysqli_query($conn, $qry);

    $row_count = mysqli_num_rows($res_array);
    $res = mysqli_fetch_array($res_array);

    if (($row_count == 1) && ($res['passwd'] == $enc_passwd))
    {
        $_SESSION['login_user'] = $username;
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    } else
        header("location:/car-rental-system/registered-user/user-login/incorrect-login-details.php");
    
?>