<html>
    <head>
        <title>
            Delete Car
        </title>
    </head>
    <body>
        <h1>Delete Car</h1>
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
                <link rel="stylesheet" type="text/css" href="/car-rental-system/car/delete-car/delete-car-form-css.css"> 
                <div class="main">  
            ';
                
            $registration_number = $_REQUEST['registration_number'];

            $qry = "SELECT model_id FROM vehicles WHERE registration_number = '$registration_number'";

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            $qry = "SELECT brand_name, model_name FROM vehicle_models WHERE model_id = ".$res['model_id'];

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            echo '
                <form action="delete-car.php" method="POST">
                    <input type="hidden" name="registration_number" id="registration_number" value="'.$registration_number.'">

                    <label for="brand name">Brand Name: </label><p>'.$res['brand_name'].'</p>
                    <br><br>

                    <label for="model name">Model Name: </label><p>'.$res['model_name'].'</p>
                    <br><br>

                    <label for="registration number">Registration Number: </label><p>'.$registration_number.'</p>
                    <br><br>

                    <div class="message">Do you really want to delete this car?</div>
                    <br><br>

                    <div class="buttons">
                        <input type="submit" class="submit" value="Delete Vehicle">
                        <a href="/car-rental-system/car/view-car/view-all-cars.php">Go back</a>
                    </div>
                </form>
            ';
        ?>
    </body>
</html>
