<?php
    session_start();

    if (!(isset($_SESSION['login_admin'])))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login-form.php");
        exit;
    }

    $conn = mysqli_connect("localhost", "root", "", "car_rental_system");

    if ($conn->connect_error) 
        die("Connection failed<br>Connection Error: ".$conn->connect_error);


    if (isset($_POST['booking_id'])) 
    {
        echo '
            <link rel="stylesheet" type="text/css" href="/car-rental-system/admin/delete-bookings/delete-booking-script-css.css"> 
            <div class="main">
                <p>    
        ';

        $booking_id = $_POST['booking_id'];
        $invalid_booking_id_flag = 0;

        if ($booking_id < 2000000000)
        {
            $card_booking_qry = "SELECT registration_number FROM card_booking_details WHERE booking_id = $booking_id";

            $card_booking_res_array = mysqli_query($conn, $card_booking_qry);
            $card_booking_count = mysqli_num_rows($card_booking_res_array);

            if ($card_booking_count == 1)
            {
                $booking_res = mysqli_fetch_array($card_booking_res_array);
                $booking_deletion_qry = "DELETE FROM card_booking_details WHERE booking_id = $booking_id";
            }
            else
                $invalid_booking_id_flag = 1;
        } else 
        {
            $cash_booking_qry = "SELECT registration_number FROM cash_booking_details WHERE booking_id = $booking_id";

            $cash_booking_res_array = mysqli_query($conn, $cash_booking_qry);
           

            $cash_booking_count = mysqli_num_rows($cash_booking_res_array);

            if ($cash_booking_count == 1)
            {
                $booking_res = mysqli_fetch_array($cash_booking_res_array);
                $booking_deletion_qry = "DELETE FROM cash_booking_details WHERE booking_id = $booking_id";
            }
            else 
                $invalid_booking_id_flag = 1;
        }

        if ($invalid_booking_id_flag == 0) 
        {
            if ($conn->query($booking_deletion_qry) == TRUE) 
            {
                echo '
                    Successfully deleted booking 
                ';

                $registration_number = $booking_res['registration_number'];

                $card_booked_vehicle_count_qry = "SELECT COUNT(*) FROM card_booking_details WHERE registration_number = '$registration_number'";
            
                $card_booked_vehicle_count_res_array = mysqli_query($conn, $card_booked_vehicle_count_qry);
                $card_booked_vehicle_count_res = mysqli_fetch_array($card_booked_vehicle_count_res_array);

                $card_booked_vehicle_count = $card_booked_vehicle_count_res[0];

                $cash_booked_vehicle_count_qry = "SELECT COUNT(*) FROM cash_booking_details WHERE registration_number = '$registration_number'";

                $cash_booked_vehicle_count_res_array = mysqli_query($conn, $cash_booked_vehicle_count_qry);
                $cash_booked_vehicle_count_res = mysqli_fetch_array($cash_booked_vehicle_count_res_array);

                $cash_booked_vehicle_count = $cash_booked_vehicle_count_res[0];

                $total_bookings = $card_booked_vehicle_count + $cash_booked_vehicle_count;

                if ($total_bookings == 0) 
                {
                    $updation_qry = "UPDATE vehicles SET is_booked = 0 WHERE registration_number = '$registration_number'";
                    mysqli_query($conn, $updation_qry);
                }

            } else
            {
                echo '
                    Error in deletion of booking<br>
                    Error: '.$conn->error;
            }
        } else 
        {
            echo '
                Invalid booking id 
            ';
        }

        echo '
                </p>
                <a href="/car-rental-system/admin/view-bookings/view-all-bookings.php">Go back</a>
            </div>
        ';
    } else 
        header("location:/car-rental-system/admin/view-bookings/view-all-bookings.php");
?>