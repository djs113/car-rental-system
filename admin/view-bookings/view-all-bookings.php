<?php

    session_start();

    if (!(isset($_SESSION['login_admin'])))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login-form.php");
        exit;
    }

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "car_rental_system";
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
    if ($conn->connect_error)
        die("Connection failed<br>Connection Error: ".$conn->connect_error);
    
    $card_booking_qry = "SELECT * FROM card_booking_details";

    $card_booking_res_array = mysqli_query($conn, $card_booking_qry);
    $card_booking_count = mysqli_num_rows($card_booking_res_array);

    $cash_booking_qry = "SELECT * FROM cash_booking_details";

    $cash_booking_res_array = mysqli_query($conn, $cash_booking_qry);
    $cash_booking_count = mysqli_num_rows($cash_booking_res_array);

    $total_bookings = $card_booking_count + $cash_booking_count;

    echo '
        <div class="main">
    ';

    if ($total_bookings != 0)
    {
        if ($card_booking_count != 0)
        {
            echo '
                <div class="card_booking_details">
                    <h1>Card Booking Details</h1>
                    <div class="table">
                        <table border="1">
                            <tr>
                                <th>Booking Id</th>
                                <th>Pick up date</th>
                                <th>Pick up time</th>
                                <th>Drop off date</th>
                                <th>Drop off time</th>
                                <th>Payment Amount</th>
                                <th>Payment time</th>
                                <th>Card Id</th>
                                <th>Registration number</th>
                            </tr>
                            
            ';

            while ($card_booking_res = mysqli_fetch_array($card_booking_res_array))
            {
                echo '
                    <tr>
                        <td>'.$card_booking_res['booking_id'].'</td>
                        <td>'.$card_booking_res['pick_up_date'].'</td>
                        <td>'.$card_booking_res['pick_up_time'].'</td>
                        <td>'.$card_booking_res['drop_off_date'].'</td>
                        <td>'.$card_booking_res['drop_off_time'].'</td>
                        <td>'.$card_booking_res['payment_amount'].'</td>
                        <td>'.$card_booking_res['payment_time'].'</td>
                        <td>'.$card_booking_res['card_id'].'</td>
                        <td>'.$card_booking_res['registration_number'].'</td>
                        <td>
                            <form action="/car-rental-system/registered-user/profile-management/cancel-booking.php" method="POST">
                                <input type="hidden" id="booking_id" name="booking_id" value="'.$card_booking_res['booking_id'].'" />
                                <input type="submit" value="Cancel booking" />
                            </form>
                        </td>
                    </tr> 
                ';
            }

            echo '
                        </table>
                    </div>
                </div>     
            ';
        } else 
        {
            echo '
                <p>No card bookings</p>
            ';
        }
        
        if ($cash_booking_count != 0) 
        {
            echo '
                <div class="cash_booking_details">
                    <h1>Cash Booking Details</h1>
                    <div class="table">
                        <table border="1">
                            <tr>
                                <th>Booking Id</th>
                                <th>Pick up date</th>
                                <th>Pick up time</th>
                                <th>Drop off date</th>
                                <th>Drop off time</th>
                                <th>Payment amount</th>
                                <th>Username</th>
                                <th>Registration number</th>
                            </tr>
            ';

            while ($cash_booking_res = mysqli_fetch_array($cash_booking_res_array))
            {
                echo '
                    <tr>
                        <td>'.$cash_booking_res['booking_id'].'</td>
                        <td>'.$cash_booking_res['pick_up_date'].'</td>
                        <td>'.$cash_booking_res['pick_up_time'].'</td>
                        <td>'.$cash_booking_res['drop_off_date'].'</td>
                        <td>'.$cash_booking_res['drop_off_time'].'</td>
                        <td>'.$cash_booking_res['payment_amount'].'</td>
                        <td>'.$cash_booking_res['username'].'</td>
                        <td>'.$cash_booking_res['registration_number'].'</td>
                        <td>
                            <form method="/car-rental-system/registered-user/profile-managment/cancel-booking.php" method="POST">
                                <input type="hidden" id="booking_id" name="booking_id" value="'.$cash_booking_res['booking_id'].'" />
                                <input type="submit" value="Cancel booking" /> 
                            </form>
                        </td>
                    </tr> 
                ';
            }

            echo '
                        </table>
                    </div>
                </div> 
            ';
        } else 
        {
            echo '
                <p>No cash bookings</p> 
            ';
        }
    } else 
    {
        echo '
            <p>No bookings</p> 
        ';
    }

    echo '
            <a href="/car-rental-system/admin/admin-home/admin-home-page.php">Go back</a>
        </div> 
    ';
?>