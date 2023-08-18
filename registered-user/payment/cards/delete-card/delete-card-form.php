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
        $card_id = $_POST['card_id'];

        $qry = "SELECT user_cards.*, card_details.* FROM user_cards LEFT JOIN card_details ON
                user_cards.card_number = card_details.card_number WHERE user_cards.card_id = $card_id";
        
        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);

        echo '
            <form>
                <label for="">: </label>'.$res[''].'
                <br><br>
                
                <label for="">: </label>'.$res[''].'
                <br><br>

            </form>
        ';
    }
?>