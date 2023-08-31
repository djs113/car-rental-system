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
            <link rel="stylesheet" type="text/css" href="delete-card-form-css.css">
            
            <div class="main">
                <form action="/car-rental-system/registered-user/payment/cards/delete-card/delete-card-script.php" method="POST">
                    <label for="card_id">Card Id: </label><p>'.$res['card_id'].'</p>
                    <br><br>
                    
                    <label for="card_number">Card number: </label><p>'.$res['card_number'].'</p>
                    <br><br>

                    <label for="card_name">Card name: </label><p>'.$res['card_name'].'</p>
                    <br><br>

                    <label for="expiry_date">Expiry date: </label><p>'.$res['expiry_date'].'</p>
                    <br><br>

                    <label for="name_on_card">Name on card: </label><p>'.$res['name_on_card'].'</p>
                    <br><br>

                    <input type="hidden" id="card_id" name="card_id" value="'.$res['card_id'].'" />

                    <div class="deletion_confirmation">
                        Do you really want to delete this card?
                        <br><br>
                    </div>
                    
                    <div class="buttons">
                        <input type="submit" class="submit" value="Delete" />
                        <a href="/car-rental-system/registered-user/profile-management/view-cards.php">Go back</a>
                    </div>
                </form>
            </div>
        ';
    } else
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
?>