<html>
    <head>
        <title>
            Delete Car
        </title>
    </head>
    <body>
        <h2><u>Delete Car</u></h2>
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
                
            $registration_number = $_REQUEST['registration_number'];

            $qry = "SELECT model_id FROM vehicles WHERE registration_number = '$registration_number'";

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            $qry = "SELECT brand_name, model_name FROM vehicle_models WHERE model_id = ".$res['model_id'];

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            echo '
                Do you really want to delete this car?
                <br><br>

                <form action="delete-car.php" method="POST">
                    <input type="hidden" name="registration_number" id="registration_number" value="'.$registration_number.'">

                    <label for="brand name">Brand Name: </label>'.$res['brand_name'].'
                    <br><br>

                    <label for="model name">Model Name: </label>'.$res['model_name'].'
                    <br><br>

                    <label for="registration number">Registration Number: </label>'.$registration_number.'
                    <br><br>

                    <input type="submit" value="Delete Vehicle">
                </form>
            ';
        ?>
    </body>
</html>
