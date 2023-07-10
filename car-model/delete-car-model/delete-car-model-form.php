<html>
    <head>
        <title>
            Delete Car Model
        </title>
    </head>
    <body>
        <h2><u>Delete Car Model</u></h2>
        <?php
            $model_id = $_REQUEST['model_id'];

            session_start();

            if (!isset($_SESSION['login_admin']))
            {
                header("location:/car-rental-system/admin/admin-login/admin-login.php");
                exit;
            }

            $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

            if ($conn->connect_error)
                die("Connection failed<br>Connection Error: ".$conn->connect_error);

            $qry = "SELECT brand_name, model_name FROM vehicle_models WHERE model_id = '$model_id'";

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            $_POST['model_id'] = $model_id;

            echo '
                Do you really want to delete this car model?

                <form action="delete-car-model.php" method="POST">
                    <label for="model_id">Model Id: </label>'.$model_id.'
                    <br><br>

                    <label for="brand_name">Brand Name: </label>'.$res["brand_name"].'
                    <br><br>

                    <label for="model_name">Model Name: </label>'.$res["model_name"].'
                    <br><br>

                    <input type="submit" value="Delete Model" />
                </form>
            ';
        ?>
        
    </body>
</html>