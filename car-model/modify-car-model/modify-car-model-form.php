<html>
    <head>
        <title>
            Modify Car Model
        </title>
        <link rel="stylesheet" type="text/css" href="/car-rental-system/car-model/modify-car-model/modify-car-model-form-css.css">
    </head>
    <body>
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

        $model_id = $_REQUEST['model_id'];

        $qry = "SELECT * FROM vehicle_models WHERE model_id=".$model_id;
        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);
    ?>

        <script type="text/javascript">
            function formValidate()
            {
                var brand_name = document.getElementById("brand_name").value;
                var model_name = document.getElementById("model_name").value;
                var vehicle_type = document.getElementById("vehicle_type").value;
                var hour_price = document.getElementById("hour_price").value;
                var day_price = document.getElementById("day_price").value;
                var week_price = document.getElementById("week_price").value;
                var month_price = document.getElementById("month_price").value;

                if (brand_name == "")
                {
                    alert("Enter brand name");
                    return false;
                }

                if (model_name == "")
                {
                    alert("Enter model name");
                    return false;
                }

                if (vehicle_type == "")
                {
                    alert("Enter vehicle type");
                    return false;
                }

                if (hour_price == "")
                {
                    alert("Enter hour price");
                    return false;
                } else if (isNaN(hour_price))
                {
                    alert("Hour price must be a number");
                    return false;
                }

                if (day_price == "")
                {
                    alert("Enter day price");
                    return false;
                } else if (isNaN(day_price))
                {
                    alert("Day price must be a number");
                    return false;
                }

                if (week_price == "")
                {
                    alert("Enter week price");
                    return false;
                } else if (isNaN(week_price))
                {
                    alert("Week price must be a number");
                    return false;
                }

                if (month_price == "")
                {
                    alert("Enter month price");
                    return false;
                } else if (isNaN(month_price))
                {
                    alert("Month price must be a number");
                    return false;
                }
            }
        </script>

        <h1>Modify Car Model</h1>
        <div class="main">
            <form action="modify-car-model.php" method="POST" onsubmit="return formValidate()">
                <input type="hidden" name="model_id" value="<?php echo $model_id;?>" />
                <br><br>

                <label for="model_id">Model Id: </label><p><?php echo $res['model_id'];?></p>
                <br><br>

                <label for="brand_name">Brand Name: </label><input type="text" name="brand_name" id="brand_name" value="<?php echo $res['brand_name'];?>" />
                <br><br>

                <label for="model_name">Model Name: </label><input type="text" name="model_name" id="model_name" value="<?php echo $res['model_name']?>" />
                <br><br>

                <label for="vehicle_type">Vehicle Type: </label><input type="text" name="vehicle_type" id="vehicle_type" value="<?php echo $res['vehicle_type']?>" />
                <br><br>

                <label for="hour_price">Per Hour Price: </label><input type="text" name="hour_price" id="hour_price" value="<?php echo $res['hour_price']?>" />
                <br><br>

                <label for="day_price">Per Day Price: </label><input type="text" name="day_price" id="day_price" value="<?php echo $res['day_price']?>" />
                <br><br>

                <label for="week_price">Per Week Price: </label><input type="text" name="week_price" id="week_price" value="<?php echo $res['week_price']?>" />
                <br><br>

                <label for="month_price">Per Month Price: </label><input type="text" name="month_price" id="month_price" value="<?php echo $res['month_price']?>" />
                <br><br>

                <div class="buttons">
                    <input type="submit" class="submit" value="Update Model" />
                    <a href="/car-rental-system/car-model/view-car-model/view-all-models.php">Go back</a>
                </div>
            </form>
        </div>
    </body>
</html>