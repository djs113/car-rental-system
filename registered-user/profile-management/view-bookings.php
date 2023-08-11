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

    $qry = "SELECT card_id FROM user_cards WHERE username = '$username'";
    $res_array = mysqli_query($conn, $qry);
    
    while ($res = mysqli_fetch_array($res_array))
    {
        $card_id = $res['card_id'];

        $qry = "SELECT registration_number FROM card_id = $card_id";
        
    }
?>