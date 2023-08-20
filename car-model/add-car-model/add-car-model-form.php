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
        <script>
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
                    alert("Hour price should be a number");
                    return false;
                }

                if (day_price == "")
                {
                    alert("Enter day price");
                    return false;
                } else if (isNaN(day_price))
                {
                    alert("Day price should be a number");
                    return false;
                }

                if (week_price == "")
                {
                    alert("Enter week price");
                    return false;
                } else if (isNaN(week_price))
                {
                    alert("Week price should be a number");
                    return false;
                }
                
                if (month_price == "")
                {
                    alert("Enter month price");
                    return false;
                } else if (isNaN(month_price))
                {
                    alert("Month price should be a number");
                    return false;
                }
            }
        </script>
        <h2><u>Add Car Model</u></h2>
        <form action="add-car-model.php" method="POST" onsubmit="return formValidate()">
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