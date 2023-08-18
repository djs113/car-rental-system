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

        $qry = "SELECT card_details.*, user_cards.* FROM user_cards LEFT JOIN card_details ON 
                user_cards.card_number = card_details.card_number WHERE user_cards.card_id = $card_id";

        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);
    
        echo '
            <form action="/car-rental-system/registered-user/payment/cards/modify-card/modify-card-script.php" method="POST">
                <label for="card_id">: </label>'.$res['card_id'].'
                <br><br>
                
                <label for="card_number">: </label>'.$res['card_number'].'
                <br><br>

                <label for="name_on_card">: </label>'.$res['name_on_card'].'
                <br><br>

                <label for="expiry_date">: </label>'.$res['expiry_date'].'
                <br><br>

                <label for="card_name">: </label><input type="text" id="card_name" name="card_name" value="'.$res['card_name'].'" />
                <br><br>

                <label for="">: </label><input type="text" id="" name="" value="'.$res[''].'" />
                <br><br>
            </form>
        ';
    }
?>