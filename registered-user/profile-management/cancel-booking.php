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
        <link rel="stylesheet" type="text/css" href="/car-rental-system/registered-user/profile-management/cancel-booking-css.css"> 
        <div class="main">
    ';

    if (isset($_POST['booking_id']))
    {
        $booking_id = $_POST['booking_id'];
        
        if ($booking_id < 2000000000)
        {
            $qry = "SELECT registration_number FROM card_booking_details WHERE booking_id = $booking_id";
            
            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            $booking_count = mysqli_num_rows($res_array);
            
            if ($booking_count == 1)
                $deletion_qry = "DELETE FROM card_booking_details WHERE booking_id = $booking_id";
        } else 
        {
            $qry = "SELECT registration_number FROM cash_booking_details WHERE booking_id = $booking_id";

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            $booking_count = mysqli_num_rows($res_array);
            
            if ($booking_count == 1)
                $deletion_qry = "DELETE FROM cash_booking_details WHERE booking_id = $booking_id";
        }

        $card_qry = "SELECT COUNT(*) FROM card_booking_details WHERE registration_number = 
        '$res[0]'";

        $cash_qry = "SELECT COUNT(*) FROM cash_booking_details WHERE registration_number = 
        '$res[0]'";

        $card_res_array = mysqli_query($conn, $card_qry);
        $card_res = mysqli_fetch_array($card_res_array);

        $cash_res_array = mysqli_query($conn, $cash_qry);
        $cash_res = mysqli_fetch_array($cash_res_array);

        $total_bookings = $card_res[0] + $cash_res[0];

        if ($total_bookings == 1)
        {
            $updation_qry = "UPDATE vehicles SET is_booked = 0 WHERE registration_number = '$res[0]'";
            mysqli_query($conn, $updation_qry);
        }

        if ($conn->query($deletion_qry) == TRUE)
            echo 'Successfully deleted booking';
        else
        {
            echo '
                Error in deleting booking
                <br>
                Error: '.$conn->error;  
        }

        echo '
            </div>
            <button><a href="/car-rental-system/registered-user/profile-management/view-bookings.php">Go back</a></button> 
        ';
    } else
        header("location:/car-rental-system/registered-user/profile-management/view-bookings.php"); 
?>