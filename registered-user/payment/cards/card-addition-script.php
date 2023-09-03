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

    echo '
        <link rel="stylesheet" type="text/css" href="card-addition-script-css.css">
        <div class="main">
    ';

    // check for card in database

    $card_number = $_POST['card_number'];

    $qry = "SELECT count(*) FROM card_details WHERE card_number = $card_number";
    
    $res_array = mysqli_query($conn, $qry);
    $res = mysqli_fetch_array($res_array);

    $card_count = $res[0];
    $username = $_SESSION['login_user'];

    $add_card_flag = 1;

    if ($card_count == 0)
    {
        $name_on_card = $_POST['name_on_card'];
        $expiry_date = $_POST['expiry_date'];
        
        $qry = "INSERT INTO card_details VALUES ($card_number, '$name_on_card', '$expiry_date')";

        mysqli_query($conn, $qry);
    } else {
        $qry = "SELECT COUNT(*) FROM user_cards WHERE card_number = $card_number AND username = '$username'";

        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);

        $user_card_count = $res[0];

        if ($res[0] == 1)
        {
            echo '
                Card has already been added
                <br><br>
                </div>
                <a href="/car-rental-system/registered-user/payment/cards/add-card.php">Go back</a>
            ';

            $add_card_flag = 0;
        }
    }

    if ($add_card_flag == 1)
    {
        $card_name = $_POST['card_name'];

        $qry = "INSERT INTO user_cards (card_name, username, card_number) VALUES 
        ('$card_name', '$username', $card_number)";

        if ($conn->query($qry) == TRUE)
        {
            echo '
                Card successfully added
                <br><br>
            ';

            if ((isset($_SESSION['ongoing_payment'])) && ($_SESSION['ongoing_payment'] == TRUE))
            {
                echo '
                    <div class="submit">
                        <form action="/car-rental-system/registered-user/payment/payment-script.php" method="POST">

                            <input type="hidden" id="payment_method" name="payment_method" value="card"/>
                            <input type="submit" value="Return to payment" />

                        </form>
                    </div>
                ';
            } else
            {
                echo '
                    </div>
                    <a href="/car-rental-system/registered-user/profile-management/view-profile.php">Go back</a> 
                ';
            }
        } else
        {
            echo'
                Error in addition of card<br>
                Error: '.$conn->error.'
                </div>
                <a href="/car-rental-system/registered-user/payment/cards/add-card.php">Try again</a>    
            ';        
        }
    }
?>