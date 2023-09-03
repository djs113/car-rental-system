<?php
    session_start();

    if (!isset($_SESSION['login_user']))
    {
        header("location:/car-rental-system/registered-user/user-login/user-login-page.php");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);
    
    if (isset($_POST['card_name']) && (isset($_POST['card_id'])))
    {
        echo '
            <link rel="stylesheet" type="text/css" href="modify-card-script-css.css">
            <div class="main">        
        ';

        $card_name = $_POST['card_name'];
        $card_id = $_POST['card_id'];
        
        $qry = "UPDATE user_cards SET card_name = '$card_name' WHERE card_id = $card_id";
        
        if ($conn->query($qry) == TRUE)
        {
            echo '
                Successfully updated card details
                <br><br>
                <a href="/car-rental-system/registered-user/profile-management/view-cards.php">Go back</a>     
            ';
        } else
        {
            echo '
                Error in updation of card details<br>
                Error: '.$conn->error.'
                <br><br>
                <a href="/car-rental-system/registered-user/payment/cards/modify-card/modify-card-form.php">Try again</a> 
            ';
        }

        echo '</div>';
    } else
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
?>