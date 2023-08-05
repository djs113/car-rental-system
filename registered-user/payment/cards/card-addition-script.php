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

    // check for card in database

    $card_number = $_POST['card_number'];

    $qry = "SELECT count(*) FROM card_details WHERE card_number = $card_number";
    $res_array = mysqli_query($conn, $qry);

    $card_count = mysqli_num_rows($res_array);

    if ($card_count == 1)
    {
        $card_name = $_POST['card_name'];
        $username = $_SESSION['login_user'];
        
        $qry = "INSERT INTO user_cards (card_name, username, card_number) VALUES 
        ('$card_name', '$username', '$card_number')";

        if ($conn->query($qry) == TRUE)
            echo 'Card successfully added';
        else
            echo 'Error in addition of card';
    } else
    {
        
    }
?>