<html>
    <head>
        <title>
            Modify Car
        </title>
    </head>
    <body>
        <?php
            session_start();

            if (!isset($_SESSION['login_admin']))
            {
                header("location:/car-rental-system/admin/admin-login/admin-login.php");
                exit;
            }

            $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

            if ($conn->connect_error)
                die("Connection failed<br>Connection Error: ".$conn->connect_error);

            $registration_number = $_REQUEST['registration_number'];
            
            $qry = "SELECT * FROM vehicles LEFT JOIN engine_numbers on vehicles.registration_number = engine_numbers.registration_number WHERE vehicles.registration_number='$registration_number'";
            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            $model_qry = "SELECT brand_name, model_name FROM vehicle_models WHERE model_id = ".$res['model_id'];
            
            $model_array = mysqli_query($conn, $model_qry);
            $model_res = mysqli_fetch_array($model_array);
        ?>

        <h2><u>Modify Car</u></h2>
        <form action="modify-car.php" method="POST">
            <input type="hidden" name="registration_number" value="<?php echo $registration_number;?>" />
            <br><br>

            <label for="registration_number">Registration Number: <?php echo $res['registration_number'];?>
            <br><br>

            <label for="brand_name">Brand Name: </label><?php echo $model_res['brand_name'];?>
            <br><br>

            <label for="model_name">Model Name: </label><?php echo $model_res['model_name'];?>
            <br><br>

            <label for="engine_number">Engine Number: </label><input type="text" name="engine_number" id="engine_number" value="<?php echo $res['engine_number'];?>" />
            <br><br>

            <label for="vehicle_color">Vehicle Color: </label><input type="text" name="vehicle_color" id="vehicle_color" value="<?php echo $res['vehicle_color'];?>" />
            <br><br>

            <label for="is_booked">Booking Status: </label><input type="text" name="is_booked" id="is_booked" value="<?php echo $res['is_booked'];?>" />
            <br><br>

            <label for="model id">Model Id: </label><input type="text" name="model_id" id="model_id" value="<?php echo $res['model_id'];?>" />
            <br><br>

            <input type="submit" value="Modify Vehicle" />
        </form>
    </body>
</html>


         <!--
            <label for="registration number">Registration Number: </label><input type="text" name="registration_number" id="registration_number" value="<?php echo $res['registration_number'];?>" />
            <br><br>


            <label for="brand name">Brand Name: </label><input type="text" name="brand_name" id="brand_name" value="<?php echo $res['brand_name'];?>" />
            <br><br>

            <label for="model name">Model Name: </label><input type="text" name="model_name" id="model_name" value="<?php echo $res['model_name'];?>" />
            <br><br>
            
            <label for="engine number">Engine Number: </label><input type="text" name="engine_number" id="engine_number" value="<?php echo $res['engine_number'];?>" />
            <br><br>
        -->