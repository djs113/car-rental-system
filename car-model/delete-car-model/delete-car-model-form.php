<html>
    <head>
        <title>
            Delete Car Model
        </title>
        <link rel="stylesheet" type="text/css" href="/car-rental-system/car-model/delete-car-model/delete-car-model-form-css.css">
    </head>
    <body>
        <h1>Delete Car Model</h1>
        <?php
            $model_id = $_REQUEST['model_id'];

            session_start();

            if (!isset($_SESSION['login_admin']))
            {
                header("location:/car-rental-system/admin/admin-login/admin-login-form.php");
                exit;
            }

            $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

            if ($conn->connect_error)
                die("Connection failed<br>Connection Error: ".$conn->connect_error);

            $qry = "SELECT brand_name, model_name FROM vehicle_models WHERE model_id = '$model_id'";

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            echo '
                <div class="main">

                    <form action="delete-car-model.php" method="POST">
                        <input type="hidden" name="model_id" id="model_id" value="'.$model_id.'" />
                        <label for="model_id">Model Id: </label><p>'.$model_id.'</p>
                        <br><br>

                        <label for="brand_name">Brand Name: </label><p>'.$res["brand_name"].'</p>
                        <br><br>

                        <label for="model_name">Model Name: </label><p>'.$res["model_name"].'</p>
                        <br><br>

                        <span>Do you really want to delete this car model?</span>
                        <br><br>

                        <div class="buttons">
                            <input type="submit" class="submit" value="Delete Model" />
                            <a href="/car-rental-system/car-model/view-car-model/view-all-models.php">Go back</a>
                        </div>
                    </form> 
                </div>
            ';
        ?>
    </body>
</html>