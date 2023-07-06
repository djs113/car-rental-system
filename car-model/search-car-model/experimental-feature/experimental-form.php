<html>
    <head>
        <title>
            Search Car Model
        </title>
        <script type="text/javascript">
            function setBrandValue()
            {
                var brand_name = document.getElementById("brand_name").value;
                const xmlhttp = new XMLHttpRequest();

                xmlhttp.onload = function() {
                    console.log(this.responseText);
                }

                xmlhttp.open("POST", "/car-rental-system/car-model/search-car-model/get-model-data.php?q=" + brand_name);
                xmlhttp.send();
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

                $model_qry = "SELECT model_name FROM vehicle_models"; 
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