<html>
    <head>
        <title>
            Search Car Model
        </title>
        <script type="text/javascript">
                localStorage.setItem("brand_name", "null");
                function setBrandValue()
                {
                    var brand_name = document.getElementById("brand_name").value;
                    localStorage.setItem("brand_name", brand_name);
                }
                
            </script>
    </head>
    <body>
        <form action="search-car-model.php" method="POST">
            <?php
                require '/opt/lampp/htdocs/car-rental-system/common-functions.php';

                $conn = dbConnection();

                $brand_qry = "SELECT brand_name FROM vehicle_models";
                $res_array = mysqli_query($conn, $brand_qry);

                echo '<label for="brand_name">Brand Name: </label>
                <select onchange="setBrandValue()" name="brand_name" id="brand_name">';

                while ($res = mysqli_fetch_array($res_array))
                {
                    echo '<option value="'.$res[0].'">'.$res[0].'</option>';
                }

                echo '</select>
                    <br><br>';

                $brand_name = '<script>document.write(localStorage.getItem("brand_name"));</script>';

                echo $brand_name;

                if ($model_name == "null")
                    $model_qry = "SELECT model_name FROM vehicle_models"; 
                else
                    $model_qry = "SELECT model_name FROM vehicle_models WHERE brand_name='$brand_name'";

                $res_array = mysqli_query($conn, $model_qry);

                echo '<label for="model_name">Model Name: </label>
                <select name="model_name" id="model_name">';

                while ($res = mysqli_fetch_array($res_array))
                {
                    echo '<option value="'.$res[0].'">'.$res[0].'</option>';
                }

                echo '</select>
                    <br><br>';
                
            ?>
            <input type="submit" value="Search Model" />
    </form>
    </body>
</html>