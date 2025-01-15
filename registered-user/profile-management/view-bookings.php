<?php
    session_start();

    if (!isset($_SESSION['login_user']))
    {
        header("location:/car-rental-system/registered-user/user-login/user-login-page.php");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $username = $_SESSION['login_user'];

    $qry = "SELECT card_id FROM user_cards WHERE username = '$username'";
    $res_array = mysqli_query($conn, $qry);

    $count_qry = "SELECT COUNT(*) FROM card_booking_details LEFT JOIN user_cards ON 
                    card_booking_details.card_id = user_cards.card_id WHERE user_cards.username = '$username'";

    $card_count_res_array = mysqli_query($conn, $count_qry);
    $card_count_res = mysqli_fetch_array($card_count_res_array);

    $count_qry = "SELECT COUNT(*) FROM cash_booking_details WHERE username = '$username'";

    $cash_count_res_array = mysqli_query($conn, $count_qry);
    $cash_count_res = mysqli_fetch_array($cash_count_res_array);

    if (is_null($card_count_res))
        $card_count_res[0] = 0;
    
    if (is_null($cash_count_res))
        $cash_count_res[0] = 0;

    $total_bookings = $card_count_res[0] + $cash_count_res[0];

    echo '
        <link rel="stylesheet" type="text/css" href="/car-rental-system/registered-user/profile-management/view-bookings-css.css">    
        <div class="main">  
    ';

    if ($total_bookings != 0)
    {
        echo '
        <div class="tbl">
            <table border="1"> 
            <tr>
                <th>Booking ID</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>Pick up date</th>
            </tr>    
    ';

        if ($card_count_res[0] == 0)
        {
            $qry = "SELECT cash_booking_details.booking_id, vehicle_models.brand_name, vehicle_models.model_name, 
                    cash_booking_details.pick_up_date FROM cash_booking_details LEFT JOIN vehicles ON 
                    cash_booking_details.registration_number = vehicles.registration_number LEFT JOIN 
                    vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE username = '$username'";
        
            $booking_res_array = mysqli_query($conn, $qry);

            while ($booking_res = mysqli_fetch_array($booking_res_array))
            {
                echo '
                    <tr>
                        <td>'.$booking_res[0].'</td>
                        <td>'.$booking_res[1].'</td>
                        <td>'.$booking_res[2].'</td>
                        <td>'.$booking_res[3].'</td>
                        <td><a href="/car-rental-system/registered-user/profile-management/manage-booking.php?booking_id='.$booking_res[0].'">View Booking</a></td>
                    </tr> 
                ';
            }
        } else
        {
            while ($res = mysqli_fetch_array($res_array))
            {
                $card_id = $res[0];

                $qry = "SELECT card_booking_details.booking_id, vehicle_models.brand_name, 
                        vehicle_models.model_name, card_booking_details.pick_up_date FROM card_booking_details LEFT JOIN vehicles ON 
                        card_booking_details.registration_number = vehicles.registration_number LEFT JOIN 
                        vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE 
                        card_booking_details.card_id = $card_id
                        UNION
                        SELECT cash_booking_details.booking_id, vehicle_models.brand_name, vehicle_models.model_name, 
                        cash_booking_details.pick_up_date FROM cash_booking_details LEFT JOIN vehicles ON 
                        cash_booking_details.registration_number = vehicles.registration_number LEFT JOIN 
                        vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE username = '$username'";
                
                $booking_res_array = mysqli_query($conn, $qry);

                while ($booking_res = mysqli_fetch_array($booking_res_array))
                {
                    echo '
                        <tr>
                            <td>'.$booking_res[0].'</td>
                            <td>'.$booking_res[1].'</td>
                            <td>'.$booking_res[2].'</td>
                            <td>'.$booking_res[3].'</td>
                            <td><a href="/car-rental-system/registered-user/profile-management/manage-booking.php?booking_id='.$booking_res[0].'">View Booking</a></td>
                        </tr> 
                    ';
                }
            }
        }

        echo '
                    </table>
                </div>
                <br><br>
        ';
    } else
    {
        echo '
            <p>No bookings available!</p>
            <br><br>     
        ';
    }

    echo '   
        <a id="go_back" href="/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php">Go back</a>
        </div>
    ';
?>