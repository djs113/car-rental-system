<?php
    session_start();

    if (!isset($_SESSION['login_admin']))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login-form.php");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    echo '
        <link rel="stylesheet" type="text/css" href="/car-rental-system/car/add-car/add-car-script-css.css">
        <div class="main">
            <p>
    ';

    $brand_name = $_POST['brand_name'];
    $model_name = $_POST['model_name'];
    $registration_number = $_POST['registration_number'];
    $engine_number = $_POST['engine_number'];
    $vehicle_color = $_POST['vehicle_color'];

    $reg_no_count_qry = "SELECT COUNT(*) FROM vehicles WHERE registration_number = '$registration_number'";

    $reg_no_res_array = mysqli_query($conn, $reg_no_count_qry);
    $reg_no_res = mysqli_fetch_array($reg_no_res_array);

    $eng_no_count_qry = "SELECT COUNT(*) FROM engine_numbers WHERE engine_number = '$engine_number'";

    $eng_no_res_array = mysqli_query($conn, $eng_no_count_qry);
    $eng_no_res = mysqli_fetch_array($eng_no_res_array);

    if (is_null($reg_no_res))
        $reg_no_res[0] = 0;

    if (is_null($eng_no_res))
        $eng_no_res[0] = 0;    

    if (($eng_no_res[0] == 0) && ($reg_no_res[0] == 0))
    {
        $qry = "SELECT model_id FROM vehicle_models WHERE brand_name = '$brand_name' AND 
        model_name = '$model_name'";

        $res_array = mysqli_query($conn, $qry);

        $res = mysqli_fetch_array($res_array);
        $model_id = $res['model_id'];

        $qry = "INSERT INTO vehicles (registration_number, vehicle_color, model_id) VALUES 
        ('$registration_number', '$vehicle_color', '$model_id');";

        $qry .= "INSERT INTO engine_numbers VALUES ('$engine_number', '$registration_number');";

        if ($conn->multi_query($qry) == TRUE)
            echo 'Successfully added car!';
        else
            echo 'Error in addition of car';

        echo '
                </p>
                <a href="/car-rental-system/car/add-car/add-car-form.php">Go back</a>
            </div>    
        ';
    } else  
    {
        echo '
            <span> 
        ';
        if ($reg_no_res[0] != 0)
        {
            echo '
                Another vehicle with this registration number has already been added
            ';
        } else 
        {
            echo '
                Another vehicle with this engine number has already been added 
            ';
        }

        echo '
                    </span>
                </p>
                <a href="/car-rental-system/car/add-car/add-car-form.php">Go back</a>
            </div>
        ';
    }
?>