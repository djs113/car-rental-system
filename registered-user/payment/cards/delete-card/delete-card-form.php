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
            <form action="/car-rental-system/registered-user/payment/cards/delete-card/delete-card-script.php" method="POST">
                <label for="card_id">Card Id: </label>'.$res['card_id'].'
                <br><br>
                
                <label for="card_number">Card number: </label>'.$res['card_number'].'
                <br><br>

                <label for="card_name">Card name: </label>'.$res['card_name'].'
                <br><br>

                <label for="expiry_date">Expiry date: </label>'.$res['expiry_date'].'
                <br><br>

                <label for="name_on_card">Name on card: </label>'.$res['name_on_card'].'
                <br><br>

                <input type="hidden" id="card_id" name="card_id" value="'.$res['card_id'].'" />

                Do you really want to delete this card?
                <br><br>

                <input type="submit" value="Delete" />
                <button><a href="/car-rental-system/registered-user/profile-management/view-cards.php">Go back</a></button>
            </form>
        ';
    } else
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
?>