<?php
    require '/opt/lampp/htdocs/car-rental-system/common-functions.php';

    $conn = dbConnection();

    $brand_name = $_POST['brand_name'];

    $model_qry = "SELECT model_name FROM vehicle_models WHERE brand_name='$brand_name'";
    $res_array = mysqli_query($conn, $model_qry);

    echo $brand_name;
    
    while ($res = mysqli_fetch_array($res_array))
    {
        echo '<option value="'.$res[0].'">'.$res[0].'</option>';
    }

    echo '</select>
        <br><br>';
?>