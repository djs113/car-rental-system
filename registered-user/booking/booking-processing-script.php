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

    if ($_SESSION['model_id'])
    {
        $model_id = $_SESSION['model_id'];
    
        if ($_REQUEST['payment_success'])
        {
            // retreive unbooked vehicles

            $qry = "SELECT registration_number FROM vehicles WHERE model_id = $model_id AND is_booked = 0";
            
            $res_array = mysqli_query($conn, $qry);
        
            $unbooked_vehicle_count = mysqli_num_rows($res_array);

            $given_pick_up_date = $_SESSION['pick_up_date'];
            $given_pick_up_time = $_SESSION['pick_up_time'];
            $given_drop_off_date = $_SESSION['drop_off_date'];
            $given_drop_off_time = $_SESSION['drop_off_time'];
            $payment_amount = $_SESSION['payment_amount'];
            $payment_time = $_SESSION['payment_time'];
            $card_id = $_SESSION['card_id'];
            $payment_method = $_SESSION['payment_method'];

            if ($unbooked_vehicle_count != 0)
            {
                $res = mysqli_fetch_array($res_array);

                $registration_number = $res[0];

                $qry = "UPDATE vehicles SET is_booked = 1 WHERE registration_number = '$registration_number';";
                $qry .= "INSERT INTO card_booking_details (pick_up_date, pick_up_time, drop_off_date, drop_off_time, 
                        payment_amount, payment_time, card_id, registration_number) VALUES ('$given_pick_up_date', 
                        '$given_pick_up_time', '$given_drop_off_date', '$given_drop_off_time', $payment_amount, 
                        '$payment_time', $card_id, '$registration_number')";
                
                if ($conn->multi_query($qry))
                {
                    echo "Booking successful";
                } else
                {
                    echo "
                        Error while booking vehicle<br>
                        Error: ".$conn->error;
                }
            } else
                {
                    $qry = "SELECT DISTINCT card_booking_details.registration_number FROM card_booking_details 
                            LEFT JOIN vehicles ON card_booking_details.registration_number = 
                            vehicles.registration_number WHERE (vehicles.model_id = $model_id) AND 
                            (('$given_drop_off_date' < card_booking_details.pick_up_date) OR 
                            ('$given_pick_up_date' >  card_booking_details.drop_off_date)) 
                            UNION
                            SELECT DISTINCT cash_booking_details.registration_number FROM cash_booking_details 
                            LEFT JOIN vehicles ON cash_booking_details.registration_number = 
                            vehicles.registration_number WHERE (vehicles.model_id = $model_id) AND 
                            (('$given_drop_off_date' < cash_booking_details.pick_up_date) OR 
                            ('$given_pick_up_date' > cash_booking_details.drop_off_date))";

                    $res_array = mysqli_query($conn, $qry);
                    $booked_vehicle_count = mysqli_num_rows($res_array);

                    if ($booked_vehicle_count != 0)
                    {
                        $res = mysqli_fetch_array($res_array);

                        $qry = "INSERT INTO card_booking_details (pick_up_date, pick_up_time, drop_off_date, drop_off_time, 
                               payment_amount, payment_time, card_id, registration_number) VALUES ('$given_pick_up_date', 
                               '$given_pick_up_time', '$given_drop_off_date', '$given_drop_off_time', '$payment_amount', 
                               '$payment_time', '$card_id', '$res[0]')";

                        if ($conn->query($qry) == TRUE)
                            echo "Booking successful";
                        else
                        {
                            echo "
                                Error in booking vehicle<br>
                                Error: ".$conn->error;
                        }
                    }
                }
        }
        else 
        {
            header("location:/car-rental-system/registered-user/vehicle-search-form.php");
            exit;
        }
    }
    
?>