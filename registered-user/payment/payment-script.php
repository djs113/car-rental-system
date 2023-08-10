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

    if ($_POST['payment_method'])
    {
        $_SESSION['ongoing_payment'] = TRUE;
        $payment_method = $_POST['payment_method'];
        
        // to retain value of payment method after leaving this page to add a new card
        
        if (!isset($_SESSION['payment_method']))
            $_SESSION['payment_method'] = $payment_method;
        else
            $payment_method = $_SESSION['payment_method'];

        $username = $_SESSION['login_user'];

        if ($payment_method == 'card')
        {
            $qry = "SELECT card_name, card_number, card_id FROM user_cards WHERE username='$username'";
            $res_array = mysqli_query($conn, $qry);
            
            $num_of_cards = mysqli_num_rows($res_array);

            if ($num_of_cards != 0)
            {
                if ($num_of_cards == 1)
                {
                    $res = mysqli_fetch_array($res_array);
                    $masked_card_number = "XXXXX".substr($res[1], -4);
                    
                    $_SESSION['card_id'] = $res[2];
                    
                    echo '
                        <form action="process-payment-form.php" method="POST">
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
                        <form action="process-payment-form.php" method="POST"> 
                    ';

                    while ($res = mysqli_fetch_array($res_array))
                    {
                        $_SESSION['card_id'] = $res[2];
                        $masked_card_number = "XXXXX".substr($res[1], -4);
                        
                        echo '
                            <input type="radio" name="card_number" value="'.$res[1].'" />
                            <label for="card">'.$res[0].' ('.$masked_card_number.')</label>
                        ';
                    }

                    echo '
                            <input type="submit" value="Pay" />
                        </form>  
                    ';
                }
            } else
                echo 'No saved cards.';

            echo '
                <button><a href="/car-rental-system/registered-user/payment/cards/add-card.php">Add new card</a></button> 
            ';
        } else 
        {
            sleep(3);
            header('location:/car-rental-system/registered-user/booking/booking-processing-script.php?cash_payment="TRUE"');
        }
    } else
    {
        sleep(3);
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    }
?>