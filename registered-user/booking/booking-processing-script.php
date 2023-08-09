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
            $registration_number;

            if ($unbooked_vehicle_count != 0)
            {
                $res = mysqli_fetch_array($res_array);

                $_GLOBALS['registration_number'] = $res[0];
                $registration_number = $res[0];

                $qry = "UPDATE vehicles SET is_booked = 1 WHERE registration_number = '$registration_number';";
                
                mysqli_query($conn, $qry);
            } else
            {
                $qry = "SELECT card_booking_details.registration_number, card_booking_details.pick_up_date, 
                        card_booking_details.pick_up_time, card_booking_details.drop_off_date, 
                        card_booking_details.drop_off_time FROM card_booking_details LEFT JOIN vehicles 
                        ON card_booking_details.registration_number = vehicles.registration_number 
                        WHERE vehicles.model_id = $model_id
                        UNION
                        SELECT cash_booking_details.registration_number, cash_booking_details.pick_up_date, 
                        cash_booking_details.pick_up_time, cash_booking_details.drop_off_date, 
                        cash_booking_details.drop_off_time FROM cash_booking_details LEFT JOIN vehicles 
                        ON cash_booking_details.registration_number = vehicles.registration_number WHERE 
                        vehicles.model_id = $model_id";
                
                $res_array = mysqli_query($conn, $qry);
                $booked_vehicle_count = mysqli_num_rows($res_array);

                if ($booked_vehicle_count != 0)
                {
                    $unbookable_vehicles = [];

                    while ($res = mysqli_fetch_array($res_array))
                    {   
                        $registration_number = $res[0];
                        $pick_up_date = $res[1];
                        $pick_up_time = $res[2];
                        $drop_off_date = $res[3];
                        $drop_off_time = $res[4];

                        if (!(($given_drop_off_date < $pick_up_date) || ($given_pick_up_date > $drop_off_date)))
                        {
                            if (!(in_array($registration_number, $unbookable_vehicles)))
                                array_push($unbookable_vehicles, $registration_number);
                        } 
                    }

                    $res_array = mysqli_query($conn, $qry);

                    while ($res = mysqli_fetch_array($res_array))
                    {
                        $registration_number = $res[0];
                        $pick_up_date = $res[1];
                        $pick_up_time = $res[2];
                        $drop_off_date = $res[3];
                        $drop_off_time = $res[4];

                        if (($given_drop_off_date < $pick_up_date) || ($given_pick_up_date > $drop_off_date))
                        {
                            if (!(in_array($registration_number, $unbookable_vehicles)))
                            {
                                $_GLOBALS['registration_number'] = $registration_number;
                                break;
                            }        
                        } 
                    }
                }
            }

            $registration_number = $_GLOBALS['registration_number'];

            $qry = "INSERT INTO card_booking_details (pick_up_date, pick_up_time, drop_off_date, drop_off_time, 
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
        }
        else 
        {
            header("location:/car-rental-system/registered-user/vehicle-search-form.php");
            exit;
        }
    }
    
?>