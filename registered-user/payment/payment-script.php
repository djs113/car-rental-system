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

    $payment_method = $_POST['payment_method'];
    $username = $_SESSION['login_user'];

    if ($payment_method == 'card')
    {
        $qry = "SELECT card_name, card_number FROM user_cards WHERE username='$username'";
        $res_array = mysqli_query($conn, $qry);
        
        $num_of_cards = mysqli_num_rows($res_array);

        if ($num_of_cards != 0)
        {
            if ($num_of_cards == 1)
            {
                $res = mysqli_fetch_array($res_array);
                $masked_card_number = "XXXXX".substr($res[1], -4);
                
                echo '
                    <form action="process-payment.php" method="POST">
                        <label for="card_name">Card Name: '.$res[0].'</label>
                        <br><br>

                        <label for="card_number">Card Number: '.$masked_card_number.'</label>
                        <input type="hidden" id="card_number" name="card_number" value="'.$res[1].'" />
                        <br><br>

                        <input type="submit" value="Pay" />
                    </form>
                ';
            } else
            {
                echo '
                    <h2>Card Name (Card Number)</h2>
                    <form action="process-payment.php" method="POST"> 
                ';

                while ($res = mysqli_fetch_array($res_array))
                {
                    $masked_card_number = "XXXXX".substr($res[1], -4);
                    echo '
                        <input type="radio" name="card" value="'.$res[1].'" />
                        <label for="card">'.$res[0].' ('.$masked_card_number.')</label>
                    ';
                }

                echo '
                        <input type="submit" value="Pay"
                    </form>  
                ';
            }
        }

        echo '
            <button><a href="/car-rental-system/registered-user/payment/cards/add-card.php">Add new card</a></button> 
        ';
    }
?>