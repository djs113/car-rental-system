<html>
    <head>
        <title>
            Modify Car
        </title>
        <script type="text/javascript">
            var xhr = new XMLHttpRequest();
            var data;

            xhr.open('POST', '/car-rental-system/car/add-car/get-model-data.php');
            xhr.send();

            xhr.onload = function () {
                data = JSON.parse(xhr.response);
            }

            function form_validate()
            {
                // var registration_number = document.getElementById("registration_number").value;
                // var brand_name = document.getElementById("brand_name").value;
                // var model_name = document.getElementById("model_name").value;
                var engine_number = document.getElementById("engine_number").value;
                var vehicle_color = document.getElementById("vehicle_color").value;
                var is_booked = document.getElementById("is_booked").value;
                var model_id = document.getElementById("model_id").value;
                
                /* 
                if (registration_number == "")
                {
                    alert("Enter registration number");
                    return false;
                }

                
                if (brand_name == "")
                {
                    alert("Enter brand_name");
                    return false;
                }

                if (model_name == "")
                {
                    alert("Enter model name");
                    return false;
                }
                */

                if (engine_number == "")
                {
                    alert("Enter engine number");
                    return false;
                }

                if (vehicle_color == "")
                {
                    alert("Enter vehicle color");
                    return false;
                }
                
                if (is_booked == "")
                {
                    alert("Enter booking status");
                    return false;
                } else if (isNaN(is_booked))
                {
                    alert("Booking status must be 0 or 1");
                    return false;
                }

                if (model_id == "")
                {
                    alert("Enter model id");
                    return false;
                } else if (isNaN(model_id))
                {
                    alert("Model Id should be a number");
                    return false;
                }
            }
        </script>
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

            if (isset($_REQUEST['registration_number']))
            {
                $registration_number = $_REQUEST['registration_number'];
            
                $qry = "SELECT * FROM vehicles LEFT JOIN engine_numbers on vehicles.registration_number = engine_numbers.registration_number WHERE vehicles.registration_number='$registration_number'";
                $res_array = mysqli_query($conn, $qry);
                $res = mysqli_fetch_array($res_array);

                $model_qry = "SELECT brand_name, model_name FROM vehicle_models WHERE model_id = ".$res['model_id'];
                
                $model_array = mysqli_query($conn, $model_qry);
                $model_res = mysqli_fetch_array($model_array);
        
                echo '
                    <h2><u>Modify Car</u></h2>
                    <form action="modify-car.php" method="POST" onsubmit="return form_validate()">
                        <label for="registration_number">Registration Number: <input type="text" id="registration_number" name="registration_number" value="'.$registration_number.'" />
                        <br><br>

                        <label for="brand_name">Brand Name: </label><select id="brand_name" name="brand_name">
                ';

                $qry = "SELECT brand_name FROM vehicle_models";
                $res_array = mysqli_query($conn, $qry);
                
                while ($res = mysqli_fetch_array($res_array))
                    echo '<option value="'.$res['brand_name'].'">'.$res['brand_name'].'</option>';
                
                echo '
                        </select>
                        <br><br>

                        <label for="model_name">Model Name: </label><select id="model_name" name="model_name">
                ';
            
                $qry = "SELECT model_name FROM vehicle_models WHERE brand_name = '<script>document.getElementById('brand_name').value</script>'";
                echo $qry;

                $res = mysqli_query($conn, $qry);

                while ($res = mysqli_fetch_array($res_array))
                    echo '<option value="'.$res['model_name'].'">'.$res['model_name'].'</option>';
                
                echo '
                        </select>

                        <label for="engine_number">Engine Number: </label><input type="text" name="engine_number" id="engine_number" value="'.$res['engine_number'].'" />
                        <br><br>

                        <label for="vehicle_color">Vehicle Color: </label><input type="text" name="vehicle_color" id="vehicle_color" value="'.$res['vehicle_color'].'" />
                        <br><br>

                        <label for="is_booked">Booking Status: </label><input type="text" name="is_booked" id="is_booked" value="'.$res['is_booked'].'" />
                        <br><br>

                        <label for="model id">Model Id: </label><input type="text" name="model_id" id="model_id" value="'.$res['model_id'].'" />
                        <br><br>

                        <input type="submit" value="Modify Vehicle" />
                    </form>
                </body>
            </html>
                ';
            } else
                header("location:/car-rental-system/admin/admin-home/admin-home-page.php");
?>