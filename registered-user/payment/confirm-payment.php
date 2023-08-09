<?php
    session_start();

    if (!isset($_SESSION['login_user']))
    {
        header("location:/car-rental-system/registered-user/user-login/user-login-page.html");
        exit;
    }

    if ($_POST['otp'])
    {
        $_SESSION['payment_success'] = TRUE;

        echo '
            <p>
                Payment is successful.
            </p>
        ';

        sleep(3);

        header("location:/car-rental-system/registered-user/booking/booking-processing-script.php");
    } else
    {
        sleep(3);
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    }
?>