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

    $username = $_SESSION['login_user'];

    $qry = "SELECT user_cards.*, card_details.* FROM user_cards LEFT JOIN card_details ON 
            user_cards.card_number = card_details.card_number WHERE user_cards.username = '$username'";
        
    $res_array = mysqli_query($conn, $qry);
    
    $card_count = mysqli_num_rows($res_array);

    echo '
        <link rel="stylesheet" type="text/css" href="view-cards-css.css">
    ';

    if ($card_count != 0)
    {
        echo '
            <div class="main">
                <table border="1">
                    <th>Card number</th>
                    <th>Name on card</th>
                    <th>Expiry Date</th>
                    <th>Card Id</th>
                    <th>Card name</th>
        ';

        while ($res = mysqli_fetch_array($res_array))
        {
            echo '
                    <tr>
                        <td>'.$res['card_number'].'</td>
                        <td>'.$res['name_on_card'].'</td>
                        <td>'.$res['expiry_date'].'</td>
                        <td>'.$res['card_id'].'</td>
                        <td>'.$res['card_name'].'</td>
                        <td>
                            <form action="/car-rental-system/registered-user/payment/cards/modify-card/modify-card-form.php" method="POST">
                                
                                <input type="hidden" id="card_id" name="card_id" value="'.$res['card_id'].'" />
                                <input type="submit" class="submit" value="Modify card" />
                                
                            </form>
                        </td>
                        <td>
                            <form action="/car-rental-system/registered-user/payment/cards/delete-card/delete-card-form.php" method="POST">
                            
                                <input type="hidden" id="card_id" name="card_id" value="'.$res['card_id'].'" />
                                <input type="submit" class="submit" value="Delete" />
                            </form>
                        </td>
                </tr>
            ';
        }

        echo '
                </table>
        ';
    } else
    {
        echo '
            <div class="main">
                No saved cards
                <br><br>
            
                <a href="/car-rental-system/registered-user/payment/cards/add-card.php">Add card</a>
        ';
    }

    echo '
            <br><br>
            <div class="back_button">
                <a href="/car-rental-system/registered-user/profile-management/view-profile.php">Go back</a>
            </div>
        </div>
    ';
?>