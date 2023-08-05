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

    $model_id = $_POST['model_id'];

    $pick_up_date = new DateTime($_POST['pick_up_date']);
    $pick_up_time = strtotime($_POST['pick_up_date']." ".$_POST['pick_up_time'].":00");
    $drop_off_date = new DateTime($_POST['drop_off_date']);
    $drop_off_time = strtotime($_POST['drop_off_date']." ".$_POST['drop_off_time'].":00");

    $qry = "SELECT brand_name, model_name, hour_price, day_price, week_price, month_price FROM vehicle_models WHERE model_id = $model_id";
    
    $res_array = mysqli_query($conn, $qry);
    $res = mysqli_fetch_array($res_array);

    // price calculation
    
    $payable_amount = 0;

    $date_diff = $drop_off_date->diff($pick_up_date);
    
    $month_diff = $date_diff->m;
    $day_diff = $date_diff->d;

    if ($month_diff != 0)
        $payable_amount += $res['month_price'] * $month_diff;
    
    if ($day_diff != 0)
    {
        if ($day_diff >= 7)
        {
            $week_diff = $day_diff / 7;
            $payable_amount += $res['week_price'] * $week_diff;
            
            $day_diff = $day_diff % 7;
        }

        $payable_amount += $res['day_price'] * $day_diff;
    } else 
    {
        $hour_diff = ($drop_off_time - $pick_up_time) / 3600;
        $payable_amount += $res['hour_price'] * $hour_diff;
    }

    echo '
        <label for="brand_name">Brand Name: </label>'.$res[0].'
        <br><br>

        <label for="model_name">Model Name: </label>'.$res[1].'
        <br><br>

        <label for="pick_up_date">Pick up date: </label>'.$_POST['pick_up_date'].'
        <br><br>

        <label for="pick_up_time">Pick up time: </label>'.$_POST['pick_up_time'].'
        <br><br>

        <label for="drop_off_date">Drop off date: </label>'.$_POST['drop_off_date'].'
        <br><br>

        <label for="drop_off_time">Drop off time: </label>'.$_POST['drop_off_time'].'
        <br><br>

        <label for="payable_amount">Payable amount: </label>'.$payable_amount.'
        <br><br>
    ';
?>