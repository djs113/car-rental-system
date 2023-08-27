<?php
    session_start();
    
    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    if ($_POST['pick_up_date'] && $_POST['pick_up_time'] && $_POST['drop_off_date'] && $_POST['drop_off_time'])
    {
        echo '
            <link rel="stylesheet" type="text/css" href="vehicle-search-script-css.css">
            <div class="main">
        ';

        $_SESSION['booking_ongoing'] = TRUE;

        $given_pick_up_date = $_POST['pick_up_date'];
        $given_pick_up_time = $_POST['pick_up_time'];
    
        $given_drop_off_date = $_POST['drop_off_date'];
        $given_drop_off_time = $_POST['drop_off_time'];

        $available_models = array();
    
        // unbooked vehicle details
    
        $qry = "SELECT DISTINCT vehicle_models.model_name, vehicle_models.brand_name, vehicle_models.model_id FROM vehicles LEFT JOIN vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE vehicles.is_booked = 0 GROUP BY vehicle_models.model_id";
        $unbooked_vehicles_array = mysqli_query($conn, $qry);

        $unbooked_vehicles_count = mysqli_num_rows($unbooked_vehicles_array);

        while ($res = mysqli_fetch_array($unbooked_vehicles_array))
            array_push($available_models, $res[2]);
        
        // details of currently booked vehicles that satisfies given booking period details
            
        $model_qry = "SELECT model_id FROM vehicle_models";
        $model_res_array = mysqli_query($conn, $model_qry);

        while ($model_res = mysqli_fetch_array($model_res_array))
        {
            $unbookable_vehicles = array();
            $model_id = $model_res[0];

            $qry = "SELECT vehicles.registration_number, card_booking_details.pick_up_date, 
                card_booking_details.pick_up_time, card_booking_details.drop_off_date, card_booking_details.drop_off_time FROM 
                card_booking_details LEFT JOIN vehicles ON card_booking_details.registration_number = vehicles.registration_number 
                WHERE vehicles.model_id = $model_id 
                UNION
                SELECT vehicles.registration_number, cash_booking_details.pick_up_date, 
                cash_booking_details.pick_up_time, cash_booking_details.drop_off_date, cash_booking_details.drop_off_time FROM 
                cash_booking_details LEFT JOIN vehicles ON cash_booking_details.registration_number = vehicles.registration_number
                WHERE vehicles.model_id = $model_id 
                ";
                
            $vehicles_array = mysqli_query($conn, $qry);
            $flag = 1;
            
            while ($vehicles_res = mysqli_fetch_row($vehicles_array))
            {
                $registration_number = $vehicles_res[0];
                $pick_up_date = $vehicles_res[1];
                $pick_up_time = $vehicles_res[2];
                $drop_off_date = $vehicles_res[3];
                $drop_off_time = $vehicles_res[4];
                
                if (!(($given_drop_off_date < $pick_up_date) || ($given_pick_up_date > $drop_off_date)))
                {
                    if (!(in_array($registration_number, $unbookable_vehicles)))
                        array_push($unbookable_vehicles, $registration_number);
                }
            }

            $vehicles_array = mysqli_query($conn, $qry);

            while (($vehicles_res = mysqli_fetch_row($vehicles_array)))
            {
                $registration_number = $vehicles_res[0];
                $pick_up_date = $vehicles_res[1];
                $pick_up_time = $vehicles_res[2];
                $drop_off_date = $vehicles_res[3];
                $drop_off_time = $vehicles_res[4];

                if (($given_drop_off_date < $pick_up_date) || ($given_pick_up_date > $drop_off_date))
                {
                    if (!(in_array($registration_number, $unbookable_vehicles)))
                    {
                        if (!(in_array($model_id, $available_models)))
                            array_push($available_models, $model_id);
                        break;
                    }
                }
            }  
        }

        $number_of_available_models = count($available_models);

        if (($unbooked_vehicles_count == 0) && ($number_of_available_models == 0))
        {
            $_SESSION['booking_ongoing'] = FALSE;

            echo 'No available vehicles for this time period
                  <br><br>
                  <button><a href="/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php">Search again</a></button>
                  </div>
            ';
    
        } else
        {
            echo '
                <table border="1">
                    <th>Model Name</th>
                    <th>Brand Name</th>
            ';

            if ($unbooked_vehicles_count != 0)
            {

                while ($res = mysqli_fetch_array($unbooked_vehicles_array))
                {
                    echo '
                        <tr>
                            <td>'.$res[0].'</td>
                            <td>'.$res[1].'</td>
                            <td>
                                <form action="/car-rental-system/registered-user/booking/confirm-booking.php" method="POST">
                                    <input type="hidden" name="model_id" id="model_id" value="'.$res[2].'" />
                                    <input type="hidden" name="pick_up_date" id="pick_up_date" value="'.$given_pick_up_date.'" />
                                    <input type="hidden" name="pick_up_time" id="pick_up_time" value="'.$given_pick_up_time.'" />
                                    <input type="hidden" name="drop_off_date" id="drop_off_date" value="'.$given_drop_off_date.'" />
                                    <input type="hidden" name="drop_off_time" id="drop_off_time" value="'.$given_drop_off_time.'" />
                                    <input type="submit" value="Book" />
                                </form>
                            </td>
                        </tr>
                    ';
                }
            } 
            
            if ($number_of_available_models != 0)
            {
                foreach ($available_models as $available_model_id)
                {
                    $qry = 'SELECT model_name, brand_name FROM vehicle_models WHERE model_id = '.$available_model_id;
                    
                    $res_array = mysqli_query($conn, $qry);
                    $res = mysqli_fetch_array($res_array);

                    echo '
                        <tr>
                            <td>'.$res[0].'</td>
                            <td>'.$res[1].'</td>
                            <td>
                                <form action="/car-rental-system/registered-user/booking/confirm-booking.php" method="POST">
                                    <input type="hidden" name="model_id" id="model_id" value="'.$available_model_id.'" />
                                    <input type="hidden" name="pick_up_date" id="pick_up_date" value="'.$given_pick_up_date.'" />
                                    <input type="hidden" name="pick_up_time" id="pick_up_time" value="'.$given_pick_up_time.'" />
                                    <input type="hidden" name="drop_off_date" id="drop_off_date" value="'.$given_drop_off_date.'" />
                                    <input type="hidden" name="drop_off_time" id="drop_off_time" value="'.$given_drop_off_time.'" />
                                    <input type="submit" value="Book" />
                                </form>
                            </td>
                        </tr>
                    ';
                }
            }

            echo '
                    </table>
                    <button><a href="/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php">Go back</a></button>
                </div>
            ';
        }
    } else
    {
        sleep(3);
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    }
?>