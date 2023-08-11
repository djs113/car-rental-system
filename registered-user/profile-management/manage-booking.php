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

    if (isset($_REQUEST['booking_id']))
    {
        $booking_id = $_REQUEST['booking_id'];

        $qry = "SELECT card_booking_details.*, vehicles.registration_number, vehicle_models.brand_name, 
                vehicle_models.model_name FROM card_booking_details LEFT JOIN vehicles ON 
                card_booking_details.registration_number = vehicles.registration_number LEFT JOIN 
                vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE 
                card_booking_details.booking_id = $booking_id";

        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);

        $booking_count = mysqli_num_rows($res_array);

        if ($booking_count != 0)
        {
            echo '
                <label for="booking_id">Booking Id: </label> '.$res['booking_id'].'
                <br>
                <br>

                <label for="registration_number">Registration Number: </label> '.$res['registration_number'].'
                <br>
                <br>

                <label for="brand_name">Brand Name: </label> '.$res['brand_name'].'
                <br>
                <br>

                <label for="model_name">Model Name: </label> '.$res['model_name'].'
                <br>
                <br>

                <label for="pick_up_date">Pick up date: </label> '.$res['pick_up_date'].'
                <br>
                <br>

                <label for="pick_up_time">Pick up time: </label> '.$res['pick_up_time'].'
                <br>
                <br>

                <label for="drop_off_date">Drop off date: </label> '.$res['drop_off_date'].'
                <br>
                <br>

                <label for="drop_off_time">Drop off time: </label> '.$res['drop_off_time'].'
                <br>
                <br>

                <label for="payment_amount">Payment amount: </label> '.$res['payment_amount'].'
                <br>
                <br>

                <label for="payment_time">Payment time: </label> '.$res['payment_time'].'
                <br>
                <br>

                <label for="card_id">Card Id: </label> '.$res['card_id'].'
                <br>
                <br>
            ';

        }
    }
?>