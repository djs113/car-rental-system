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

    if ($_POST['model_id'] && $_POST['pick_up_date'] && $_POST['pick_up_time'] && $_POST['drop_off_date'] && $_POST['drop_off_time'])
    {
        $model_id = $_POST['model_id'];

        $pick_up_date = new DateTime($_POST['pick_up_date']);
        $pick_up_time = strtotime($_POST['pick_up_date']." ".$_POST['pick_up_time'].":00");
        $drop_off_date = new DateTime($_POST['drop_off_date']);
        $drop_off_time = strtotime($_POST['drop_off_date']." ".$_POST['drop_off_time'].":00");

        $qry = "SELECT brand_name, model_name, hour_price, day_price, week_price, month_price FROM vehicle_models WHERE model_id = $model_id";
        
        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);

        // price calculation
        
        $payment_amount = 0;

        $date_diff = $drop_off_date->diff($pick_up_date);
        
        $month_diff = $date_diff->m;
        $day_diff = $date_diff->d;

        if ($month_diff != 0)
            $payment_amount += $res['month_price'] * $month_diff;
        
        if ($day_diff != 0)
        {
            if ($day_diff >= 7)
            {
                $week_diff = $day_diff / 7;
                $payment_amount += $res['week_price'] * $week_diff;
                
                $day_diff = $day_diff % 7;
            }

            $payment_amount += $res['day_price'] * $day_diff;
        } else 
        {
            $hour_diff = ($drop_off_time - $pick_up_time) / 3600;
            $payment_amount += $res['hour_price'] * $hour_diff;
        }

        $_SESSION['model_id'] = $_POST['model_id'];
        $_SESSION['pick_up_date'] = $_POST['pick_up_date'];
        $_SESSION['pick_up_time'] = $_POST['pick_up_time'];
        $_SESSION['drop_off_date'] = $_POST['drop_off_date'];
        $_SESSION['drop_off_time'] = $_POST['drop_off_time'];

        echo '
            <link rel="stylesheet" type="text/css" href="confirm-booking-css.css">

            <div class="main"> 
                <label for="brand_name">Brand Name: </label><p>'.$res[0].'</p>
                <br><br>

                <label for="model_name">Model Name: </label><p>'.$res[1].'</p>
                <br><br>

                <label for="pick_up_date">Pick up date: </label><p>'.$_POST['pick_up_date'].'</p>
                <br><br>

                <label for="pick_up_time">Pick up time: </label><p>'.$_POST['pick_up_time'].'</p>
                <br><br>

                <label for="drop_off_date">Drop off date: </label><p>'.$_POST['drop_off_date'].'</p>
                <br><br>

                <label for="drop_off_time">Drop off time: </label><p>'.$_POST['drop_off_time'].'</p>
                <br><br>

                <label for="payment_amount">Payable amount: </label><p>Rs.'.$payment_amount.'</p>
                <br><br>

                <div class="buttons">
                    <form action="/car-rental-system/registered-user/payment/payment-form.php" method="POST">      
                        <input type="hidden" id="payment_amount" name="payment_amount" value="'.$payment_amount.'" />
                        <input type="submit" value="Proceed to payment" />  
                    </form>

                    <a href="/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php">Go home</a>
                </div>
            </div>            
        ';
    } else
    {
        sleep(3);
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    }
    
?>