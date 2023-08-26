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
            <link rel="stylesheet" type="text/css" href="modify-card-form-css.css">

            <script type="text/javascript">
                function formValidate()
                {
                    var card_name = document.getElementById("card_name").value;

                    if (card_name == "")
                    {
                        alert("Enter card name");
                        return false;
                    }
                }
            </script>

            <div class="main">
                <form action="/car-rental-system/registered-user/payment/cards/modify-card/modify-card-script.php" method="POST" onsubmit="return formValidate()">
                    <label for="card_id">Card Id: </label><p>'.$res['card_id'].'</p>
                    <br><br>
                    
                    <label for="card_number">Card number: </label><p>'.$res['card_number'].'</p>
                    <br><br>

                    <label for="name_on_card">Name on card: </label><p>'.$res['name_on_card'].'</p>
                    <br><br>

                    <label for="expiry_date">Expiry date: </label><p>'.$res['expiry_date'].'</p>
                    <br><br>

                    <label for="card_name">Card name: </label><input type="text" class="card_name" id="card_name" name="card_name" value="'.$res['card_name'].'" />
                    <br><br>

                    <input type="hidden" id="card_id" name="card_id" value="'.$res['card_id'].'" />

                    <input type="submit" class="submit"value="Modify" /> 
                </form>
            </div>
        ';
    } else
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
?>