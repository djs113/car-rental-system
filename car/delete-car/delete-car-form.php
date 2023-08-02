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
                header("location:/car-rental-system/admin/admin-login/admin-login.php"); 
                exit; 
            } 

            $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system'); 

            if ($conn->connect_error) 
                die("Connection failed<br>Connection Error: ".$conn->connect_error);
                
            $registration_number = $_REQUEST['registration_number'];

            $qry = "SELECT model_id FROM vehicles WHERE registration_number = $registration_number";

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            echo '
                <form action="delete-car.php" method="POST">
                    <label for="brand name">Brand Name: </label>'.$res['brand_name'].'
                    <br><br>

                    <label for="model name">Model Name: </label><input type="text" name="model_name" id="model_name">
                    <br><br>

                    <label for="registration number">Registration Number: </label><input type="text" name="registration_number" id="registration_number">
                    <br><br>

                    <input type="submit" value="Delete Vehicle">
                </form>
            ';
        ?>
    </body>
</html>
