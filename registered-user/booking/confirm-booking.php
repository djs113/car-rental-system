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
    $pick_up_time = new DateTime($_POST['pick_up_time']);
    $drop_off_date = new DateTime($_POST['drop_off_date']);
    $drop_off_time = new DateTime($_POST['drop_off_time']);

    $qry = "SELECT brand_name, model_name, hour_price, day_price, week_price, month_price FROM vehicle_models WHERE model_id = $model_id";
    
    $res_array = mysqli_query($conn, $qry);
    $res = mysqli_fetch_array($res_array);

    // price calculation
    
    $payable_amount = 0;

    $date_diff = $drop_off_date->diff($pick_up_date);
    
    $month_diff = $date_diff->m;
    $day_diff = $day_diff->d;

    // month price
    
    if ($month_diff != 0)
        $payable_amount += $res['month_price'] * $month_diff;
    
    if ($day_diff != 0)
        $payable_amount += $res['day_price'] * $day_diff;

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
    ';
?>