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
            
            $res = mysqli_query($conn, $qry);
            $res_array = mysqli_fetch_array($res);

            $unbooked_vehicle_count = mysqli_num_rows($res);

            if ($unbooked_vehicle_count != 0)
            {
                
            }
        }
        else 
        {
            header("location:/car-rental-system/registered-user/vehicle-search-form.php");
            exit;
        }
    }
    
?>