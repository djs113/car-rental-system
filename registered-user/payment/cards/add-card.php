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

    echo '
        <form action="card-addition-script.php" method="POST">
            <label for="card_number">Card Number: </label><input type="text" id="card_number" name="card_number" />
            <br><br>
                <label for="name_on_card">Name on Card: </label><input type="text" id="name_on_card" name="name_on_card" />
                <br><br>

                <label for="expiry_date">Expiry date: </label><input type="date" id="expiry_date" name="expiry_date" />
                <br><br>

                <label for="card_name">Card Name: </label><input type="text" id="card_name" name="card_name" />
                <br><br>

                <input type="submit" value="Add card" />
        </form> 
    ';

?>