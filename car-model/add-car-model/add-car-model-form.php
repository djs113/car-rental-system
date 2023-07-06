<html>
    <head>
        <title>
            Add Car Model
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
        <h2><u>Add Car Model</u></h2>
        <form action="add-car-model.php" method="POST">
            <label for="brand name">Brand Name: </label><input type="text" name="brand_name" id="brand_name" />
            <br><br>

            <label for="model name">Model Name: </label><input type="text" name="model_name" id="model_name" />
            <br><br>

            <label for="vehicle type">Vehicle Type: </label><input type="text" name="vehicle_type" id="vehicle_type" />
            <br><br>

            <label for="per hour price">Per Hour Price: </label><input type="text" name="hour_price" id="hour_price" />
            <br><br>

            <label for="per day price">Per Day Price: </label><input type="text" name="day_price" id="day_price" />
            <br><br>

            <label for="per week price">Per Week Price: </label><input type="text" name="week_price" id="week_price" />
            <br><br>

            <label for="per month price">Per Month Price: </label><input type="text" name="month_price" id="month_price" />
            <br><br>

            <input type="submit" value="Add Model" />
        </form>
    </body>
</html>