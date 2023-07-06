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
        <form action="add-car.php" method="POST">
            <label for="brand name">Brand Name: </label><input type="text" name="brand_name" id="brand_name" />
            <br><br>

            <label for="model name">Model Name: </label><input type="text" name="model_name" id="model_name" />
            <br><br>

            <label for="registration number">Registration Number: </label><input type="text" name="registration_number" id="registration_number" />
            <br><br>

            <label for="engine number">Engine Number: </label><input type="text" name="engine_number" id="engine_number" />
            <br><br>

            <label for="vehicle color">Vehicle Color: </label><input type="text" name="vehicle_color" id="vehicle_color" />
            <br><br>

            <input type="submit" value="Add Vehicle" />
        </form>
    </body>
</html>