<?php
    session_start();

    if (!isset($_SESSION['login_admin']))
    {
        header("location:/car-rental-system/registered-user/user-login/user-login-page.php");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');
        
    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $qry = "SELECT brand_name FROM vehicle_models";
    $brand_res_array = mysqli_query($conn, $qry);
    
    // $brand_res = mysqli_fetch_array($brand_res_array);
    
    $model_data = [];

    while ($brand_res = mysqli_fetch_array($brand_res_array))
    {
        $models = [];

        $qry = "SELECT model_name, model_id FROM vehicle_models WHERE brand_name = '$brand_res[0]'";
        $model_res_array = mysqli_query($conn, $qry);

        while ($model_res = mysqli_fetch_array($model_res_array))
            array_push($models, [$model_res['model_name'], $model_res['model_id']]);
        
        $model_data[$brand_res[0]] = $models;
    }

    $model_data = json_encode($model_data);
    echo $model_data;
?>