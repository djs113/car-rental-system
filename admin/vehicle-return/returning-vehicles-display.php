<?php
    session_start();

    if (!isset($_SESSION['login_admin']))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login-form.php");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection failed<br>Connection Error: ".$conn->connect_error);

    echo '
        <link rel="stylesheet" type="text/css" href="/car-rental-system/admin/vehicle-return/returning-vehicles-display-css.css"> 
        <div class="main">  
    ';

    date_default_timezone_set("Asia/Calcutta");
    $current_date = date("Y-m-d", time());

    $qry = "SELECT card_booking_details.booking_id, card_booking_details.drop_off_time, card_booking_details.registration_number, 
            vehicle_models.brand_name, vehicle_models.model_name FROM card_booking_details LEFT JOIN 
            vehicles ON card_booking_details.registration_number = vehicles.registration_number LEFT JOIN 
            vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE 
            card_booking_details.drop_off_date = '$current_date'
            UNION
            SELECT cash_booking_details.booking_id, cash_booking_details.drop_off_time, cash_booking_details.registration_number, vehicle_models.brand_name, 
            vehicle_models.model_name FROM cash_booking_details LEFT JOIN vehicles ON 
            cash_booking_details.registration_number = vehicles.registration_number LEFT JOIN vehicle_models ON 
            vehicles.model_id = vehicle_models.model_id WHERE cash_booking_details.drop_off_date = '$current_date'";

    $res_array = mysqli_query($conn, $qry);
    $return_count = mysqli_num_rows($res_array);

    if ($return_count != 0)
    {
        echo '
            <table border="1">
                <tr>
                    <th>Booking Id</th>
                    <th>Drop off time</th>
                    <th>Registration number</th>
                    <th>Brand name</th>
                    <th>Model name</th>
                </tr> 
        ';
        
        while ($res = mysqli_fetch_array($res_array))
        {
            echo '
                <tr> 
                    <td>'.$res['booking_id'].'</td>
                    <td>'.$res['drop_off_time'].'</td>
                    <td>'.$res['registration_number'].'</td>
                    <td>'.$res['brand_name'].'</td>
                    <td>'.$res['model_name'].'</td>
                    <td>
                        <form action="/car-rental-system/admin/vehicle-return/return-vehicle-script.php" 
                        method="POST">
                            <input type="hidden" id="booking_id" name="booking_id" 
                            value="'.$res['booking_id'].'" />

                            <input type="hidden" id="registration_number" name="registration_number" 
                            value="'.$res['registration_number'].'" />
                            
                            <input type="submit" class="submit" value="Accept return" />      
                        </form>
                    </td>
                </tr>
            ';
        }

        echo '
                </table>
                <button><a href="/car-rental-system/admin/admin-home/admin-home-page.php">Go back</a></button>
            </div>
        ';
    } else
    {
        echo '
                <p>No vehicles to be returned</p>
                <br><br>
                <button><a href="/car-rental-system/admin/admin-home/admin-home-page.php">Go back</a></button>    
            </div>     
        ';
    }
        
?>