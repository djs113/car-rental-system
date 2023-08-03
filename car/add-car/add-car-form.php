<html>
    <head>
        <title>
            Add Car
        </title>
    </head>
    <?php
        session_start();

        if (!isset($_SESSION['login_admin']))
        {
            header("location:/car-rental-system/admin/admin-login/admin-login.php");
            exit;
        }
    ?>
    <body>
        <h2><u>Add Car</u></h2>
        <?php
            session_start();

            if (!isset($_SESSION['login_admin']))
            {
                header("location:/car-rental-system/admin/admin-login/admin-login.php");
                exit;
            }
        
            $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');
        
            if ($conn->connect_error)
                die("Connection error".$conn->connect_error);

            $qry = "SELECT brand_name FROM vehicle_models";
            $res_array = mysqli_query($conn, $qry);

            echo '
                <form action="add-car-script.php" method="POST">
                    <label for="brand name">Brand Name: </label>
                    <select name="brand_name" id="brand_name">      
            ';

            while ($res = mysqli_fetch_array($res_array))
                echo '<option value="'.$res['brand_name'].'">'.$res['brand_name'].'</option>';
            
            $qry = "SELECT model_name FROM vehicle_models";
            $res_array = mysqli_query($conn, $qry);

            echo '
                </select>
                <br><br>

                <label for="model name">Model Name: </label>
                <select name="model_name" id="model_name"> 
            ';
            
            while ($res = mysqli_fetch_array($res_array))
                echo '<option value="'.$res['model_name'].'">'.$res['model_name'].'</option>';
            
            echo '  
                    </select>
                    <br><br>

                    <label for="registration number">Registration Number: </label><input type="text" name="registration_number" id="registration_number" />
                        <br><br>

                    <label for="engine number">Engine Number: </label><input type="text" name="engine_number" id="engine_number" />
                    <br><br>

                    <label for="vehicle color">Vehicle Color: </label><input type="text" name="vehicle_color" id="vehicle_color" />
                    <br><br>

                    <input type="submit" value="Add Vehicle" />
                </form>
            ';
        ?>
        <button><a href="/car-rental-system/admin/admin-home/admin-home-page.php">Home Page</a></button>
    </body>
</html>