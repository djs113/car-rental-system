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
        <html>
        <head>
            <title>
                Modify Car
            </title>
            <script type="text/javascript">
                var xhr = new XMLHttpRequest();
                var data;

                xhr.open("POST", "/car-rental-system/car/add-car/get-model-data.php");
                xhr.send();

                xhr.onload = function () {
                    data = JSON.parse(xhr.response);
                }

                function selectModels()
                {
                    var model_select_box = document.getElementById("model_name");
                    var model_id = document.getElementById("model_id");

                    var brand_name = document.getElementById("brand_name").value;
                    var model_data = data[brand_name];

                    while (model_select_box.firstChild)
                        model_select_box.removeChild(model_select_box.firstChild);

                    for (var model_number in model_data)
                    {
                        var model_option = document.createElement("option");
                        model_option.id = model_option.value = model_data[model_number][0];
                        model_option.innerText = model_data[model_number][0];
                        model_select_box.appendChild(model_option);
                    }
                }

                function getModelId()
                {
                    var model_id = document.getElementById("model_id");
                    var model_id_val = document.getElementById("model_id_val");
                    
                    var brand_name = document.getElementById("brand_name").value;
                    var model_name = document.getElementById("model_name").value;
                    
                    var model_data = data[brand_name];

                    console.log(model_data);

                    for (var model_number in model_data)
                    {
                        if (model_data[model_number][0] == model_name)
                        {   
                            model_id.innerText = model_data[model_number][1];
                            model_id_val.value = model_data[model_number][1];
                            break;
                        }
                    }
                }

                function formValidate()
                {
                    var registration_number = document.getElementById("registration_number").value;
                    var engine_number = document.getElementById("engine_number").value;
                    var vehicle_color = document.getElementById("vehicle_color").value;
                    var is_booked = document.getElementById("is_booked").value;
                    var model_id_val = document.getElementById("model_id_val").value;

                    console.log(typeof(model_id_val));
                    
                    if (registration_number == "")
                    {
                        alert("Enter registration number");
                        return false;
                    }

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
                    } else if (isNaN(is_booked) || ((is_booked != "1") && (is_booked != "0")))
                    {
                        alert("Booking status must be 0 or 1");
                        return false;
                    }
                }
            </script>
        </head>
        <body>
    ';

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
            <form action="modify-car.php" method="POST" onsubmit="return formValidate()">
                <label for="registration_number">Registration Number: <input type="text" id="registration_number" name="registration_number" value="'.$registration_number.'" />
                <br><br>

                <label for="brand_name">Brand Name: </label>
                <select id="brand_name" name="brand_name" onchange="selectModels()">
                    <option value="'.$model_res['brand_name'].'">'.$model_res['brand_name'].'</option>
        ';

        $qry = "SELECT brand_name FROM vehicle_models";
        $res_array = mysqli_query($conn, $qry);
        
        while ($res = mysqli_fetch_array($res_array))
        {    
            if ($res['brand_name'] != $model_res['brand_name'])
                echo '<option value="'.$res['brand_name'].'">'.$res['brand_name'].'</option>';
        }

        echo '
                </select>
                <br><br>

                <label for="model_name">Model Name: </label><select id="model_name" name="model_name" onfocus="getModelId()">
        ';

        $qry = "SELECT model_name FROM vehicle_models WHERE brand_name = '$model_res[0]'";
        $res_array = mysqli_query($conn, $qry);

        while ($res = mysqli_fetch_array($res_array))
            echo '<option id="'.$res['model_name'].'"value="'.$res['model_name'].'">'.$res['model_name'].'</option>';
        
        $qry = "SELECT vehicles.*, engine_numbers.engine_number FROM vehicles LEFT JOIN engine_numbers ON 
                vehicles.registration_number = engine_numbers.registration_number WHERE 
                vehicles.registration_number = '$registration_number'";

        $res_array = mysqli_query($conn, $qry);
        $res = mysqli_fetch_array($res_array);

        echo '
                </select>
                <br><br>

                <label for="engine_number">Engine Number: </label><input type="text" 
                name="engine_number" id="engine_number" value="'.$res['engine_number'].'" />
                <br><br>

                <label for="vehicle_color">Vehicle Color: </label><input type="text" 
                name="vehicle_color" id="vehicle_color" value="'.$res['vehicle_color'].'" />
                <br><br>

                <label for="is_booked">Booking Status: </label><input type="text" name="is_booked" 
                id="is_booked" value="'.$res['is_booked'].'" />
                <br><br>

                <label for="model id">Model Id: </label><div name="model_id" id="model_id">
                '.$res['model_id'].'</div>

                <input type="hidden" id="model_id_val" name="model_id_val" value="'.$res['model_id'].'" />
                <br><br>

                <input type="submit" value="Modify Vehicle" />
            </form>
        </body>
    </html>
        ';
    } else
        header("location:/car-rental-system/admin/admin-home/admin-home-page.php");
?>