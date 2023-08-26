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

    if (isset($_POST['card_id']))
    {
        echo '
            <link rel="stylesheet" type="text/css" href="delete-card-script-css.css">
            <div class="main">
        ';

        $card_id = $_POST['card_id'];

        $qry = "SELECT card_number FROM user_cards WHERE card_id = $card_id";
        
        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);

        $card_number = $res['card_number'];

        $qry = "SELECT COUNT(*) FROM card_booking_details WHERE card_id = $card_id";

        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);

        $booking_count = $res[0];

        if ($booking_count == 0)
        {
            $qry = "SELECT COUNT(*) FROM user_cards WHERE card_number = $card_number";

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            $card_count = $res[0];

            $qry = "DELETE FROM user_cards WHERE card_id = $card_id";

            if ($conn->query($qry) == TRUE)
            {
                if ($card_count == 1)
                {
                    $qry = "DELETE FROM card_details WHERE card_number = $card_number";
                    mysqli_query($conn, $qry);
                }

                echo 'Card successfully deleted';
            } else 
            {
                echo '
                    Error in deletion of card<br>
                    Error: '.$conn->error;
            }
            
        } else
        {
            echo 'There are currently open bookings using this card, please close those bookings to
                 delete this card';
        }       
        
        echo '
                <br><br>
                <button><a href="/car-rental-system/registered-user/profile-management/view-cards.php">Go back</a></button>
            </div>
        ';
    } else
        header("location:/car-rental-system/registered-user/profile-management/view-cards.php");
?>