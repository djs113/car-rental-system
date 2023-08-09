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

    if ($_REQUEST['payable_amount'])
    {
        $payable_amount = $_REQUEST['payable_amount'];
        $_SESSION['payable_amount'] = $payable_amount;

        echo '
            <form action="payment-script.php" method="POST">
                <label for="payable_amount">Payable amount: </label>Rs.'.$payable_amount.'
                <br><br>

                <input type="radio" id="card" name="payment_method" value="card" />
                <label for="card">card</label>
                <br><br>

                <input type="radio" id="cash" name="payment_method" value="cash" />
                <label for="cash">cash</label>
                <br><br>

                <input type="submit" value="Next" />
            </form>
        ';
    } else
    {
        sleep(3);
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    }

?>