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
        $booking_flag = 0;
        $booking_id = $_REQUEST['booking_id'];

        $qry = "SELECT card_booking_details.*, vehicles.registration_number, vehicle_models.brand_name, 
                vehicle_models.model_name FROM card_booking_details LEFT JOIN vehicles ON 
                card_booking_details.registration_number = vehicles.registration_number LEFT JOIN 
                vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE 
                card_booking_details.booking_id = $booking_id";

        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);

        $booking_count = mysqli_num_rows($res_array);

        echo '
            <link rel="stylesheet" type="text/css" href="/car-rental-system/registered-user/profile-management/manage-booking-css.css">
            <div class="main">
        ';

        if ($booking_count != 0)
        {
            $booking_flag = 1;

            echo '
                <label for="booking_id">Booking Id: </label> <p>'.$res['booking_id'].'</p>
                <br>
                <br>

                <label for="registration_number">Registration Number: </label> <p>'.$res['registration_number'].'</p>
                <br>
                <br>

                <label for="brand_name">Brand Name: </label> <p>'.$res['brand_name'].'</p>
                <br>
                <br>

                <label for="model_name">Model Name: </label> <p>'.$res['model_name'].'</p>
                <br>
                <br>

                <label for="pick_up_date">Pick up date: </label> <p>'.$res['pick_up_date'].'</p>
                <br>
                <br>

                <label for="pick_up_time">Pick up time: </label> <p>'.$res['pick_up_time'].'</p>
                <br>
                <br>

                <label for="drop_off_date">Drop off date: </label> <p>'.$res['drop_off_date'].'</p>
                <br>
                <br>

                <label for="drop_off_time">Drop off time: </label> <p>'.$res['drop_off_time'].'</p>
                <br>
                <br>

                <label for="payment_amount">Payment amount: </label> <p>'.$res['payment_amount'].'</p>
                <br>
                <br>

                <label for="payment_time">Payment time: </label> <p>'.$res['payment_time'].'</p>
                <br>
                <br>

                <label for="card_id">Card Id: </label> <p>'.$res['card_id'].'</p>
                <br>
                <br>
            ';
        } else
        {
            $qry = "SELECT cash_booking_details.*, vehicles.registration_number, vehicle_models.brand_name, 
                    vehicle_models.model_name FROM cash_booking_details LEFT JOIN vehicles ON 
                    cash_booking_details.registration_number = vehicles.registration_number LEFT JOIN 
                    vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE booking_id = $booking_id";

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            $booking_count = mysqli_num_rows($res_array);

            if ($booking_count != 0)
            {
                $booking_flag = 1;

                echo '
                    <label for="booking_id">Booking Id: </label> <p>'.$res['booking_id'].'</p>
                    <br>
                    <br>

                    <label for="registration_number">Registration Number: </label> <p>'.$res['registration_number'].'</p>
                    <br>
                    <br>

                    <label for="brand_name">Brand Name: </label> <p>'.$res['brand_name'].'</p>
                    <br>
                    <br>

                    <label for="model_name">Model Name: </label> <p>'.$res['model_name'].'</p>
                    <br>
                    <br>

                    <label for="pick_up_date">Pick up date: </label> <p>'.$res['pick_up_date'].'</p>
                    <br>
                    <br>

                    <label for="pick_up_time">Pick up time: </label> <p>'.$res['pick_up_time'].'</p>
                    <br>
                    <br>

                    <label for="drop_off_date">Drop off date: </label> <p>'.$res['drop_off_date'].'</p>
                    <br>
                    <br>

                    <label for="drop_off_time">Drop off time: </label> <p>'.$res['drop_off_time'].'</p>
                    <br>
                    <br>

                    <label for="payment_amount">Payment amount: </label> <p>'.$res['payment_amount'].'</p>
                    <br>
                    <br>
            ';
            } else
            {
                echo '
                    <div class="invalid_message">
                        Invalid booking id
                        <br><br>
                    </div>   
                    <button><a href="/car-rental-system/registered-user/profile-management/view-bookings.php">Go back</a></button>
                ';
            }
        }
        
        echo '
            </div> 
        ';
    } else
        header("location:/car-rental-system/registered-user/profile-management/view-bookings.php");
    
    if ($booking_flag == 1)
    {
            echo '
                <div class="buttons">
                    <button><a href="/car-rental-system/registered-user/profile-management/view-bookings.php">Go back</a></button> 
                    <br>
                    
                    <form action="cancel-booking.php" method="POST">
                        <input type="hidden" id="booking_id" name="booking_id" value="'.$res['booking_id'].'" />
                        <input type="submit" value="Cancel Booking" />
                    </form>
                </div>
            ';
    }
?>