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
            <p>
                Payment is successful.
            </p>
        ';

        $payment_time = date("Y-m-d h:i:s");
        $_SESSION['payment_time'] = $payment_time;

        sleep(3);

        header('location:/car-rental-system/registered-user/booking/booking-processing-script.php?payment_success="TRUE"');
    } else
    {
        sleep(3);
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    }
?>