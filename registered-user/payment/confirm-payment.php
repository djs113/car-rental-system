<?php
    session_start();

    if (!isset($_SESSION['login_user']))
    {
        header("location:/car-rental-system/registered-user/user-login/user-login-page.html");
        exit;
    }

    if ($_POST['otp'])
    {
        echo '
            <link rel="stylesheet" type="text/css" href="confirm-payment-css.css">

            <div class="main">
                <p>
                    Payment is successful.
                </p> 
            </div>
        ';

        if (isset($_SESSION['ongoing_payment']) && ($_SESSION['ongoing_payment'] == TRUE))
            $_SESSION['ongoing_payment'] = FALSE;

        $payment_time = date("Y-m-d h:i:s");
        $_SESSION['payment_time'] = $payment_time;

        sleep(3);

        echo '
            <form action="/car-rental-system/registered-user/booking/booking-processing-script.php" method="POST">
                <input type="hidden" id="payment_success" name="payment_success" value="TRUE" />
                <input type="submit" value="Proceed" />
            </form>
        ';

        // header('location:/car-rental-system/registered-user/booking/booking-processing-script.php?payment_success="TRUE"');
    } else
    {
        sleep(3);
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    }
?>