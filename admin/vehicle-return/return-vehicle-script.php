<?php
    session_start();

    if (!isset($_SESSION['login_admin']))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login-form.php");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
    {    
        die("Connection failed<br>
            Connection Error: ".$conn->connect_error);
    }

    if ((isset($_POST['booking_id'])) && (isset($_POST['registration_number'])))
    {
        echo '
            <link rel="stylesheet" type="text/css" href="/car-rental-system/admin/vehicle-return/return-vehicle-script-css.css">
            <div class="main">     
        ';

        $booking_id = $_POST['booking_id'];
        $registration_number = $_POST['registration_number'];

        if ($booking_id < 2000000000)
            $qry = "DELETE FROM card_booking_details WHERE booking_id = $booking_id";        
        else
            $qry = "DELETE FROM cash_booking_details WHERE booking_id = $booking_id";
        
        if ($conn->query($qry) == TRUE)
        {
            $card_qry = "SELECT COUNT(*) FROM card_booking_details WHERE 
                        registration_number = '$registration_number'";

            $card_res_array = mysqli_query($conn, $card_qry);
            $card_res = mysqli_fetch_array($card_res_array);

            $cash_qry = "SELECT COUNT(*) FROM cash_booking_details WHERE 
                        registration_number = '$registration_number'";

            $cash_res_array = mysqli_query($conn, $cash_qry);
            $cash_res = mysqli_fetch_array($cash_res_array);

            $total_bookings = $card_res[0] + $cash_res[0];

            if ($total_bookings == 0)
            {
                $qry = "UPDATE vehicles SET is_booked = 0 WHERE 
                        registration_number = '$registration_number'";

                mysqli_query($conn, $qry);
            }
            
            echo '
                <p>
                    Successfully returned vehicle
                    <br><br>
                </p>
            ';
        } else
        {
            echo '
                <p>
                    Error in returning vehicle<br>
                    Error: '.$conn->error.'<br><br>
                </p>
            ';
        }

        echo '
                <button><a href="/car-rental-system/admin/vehicle-return/returning-vehicles-display.php">Go back</a></button>
            </div>   
        '; 
    } else
        header("location:/car-rental-system/admin/vehicle-return/returning-vehicles-display.php");
?>