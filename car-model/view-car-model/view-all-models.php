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

    $qry = "SELECT * FROM vehicle_models";

    $res_array = mysqli_query($conn, $qry);

    echo '
            <html>
                <head>
                    <title>
                        View Models       
                    </title>
                    <link rel="stylesheet" type="text/css" href="/car-rental-system/car-model/view-car-model/view-all-models-css.css">
                </head>
                <body>
                    
    ';

    $model_count = mysqli_num_rows($res_array);

    if ($model_count != 0){
        echo '
            <h1>View Models</h1>
            
            <div class="main">
                <table cellspacing="3" cellpadding="3" border="1">
                    <tr> 
    
                        <th>Model Id</th>
        
                        <th>Brand Name</th>
        
                        <th>Model Name</th>
        
                        <th>Vehicle Type</th>
        
                        <th>Price Per Hour</th>
        
                        <th>Price Per Day</th>
        
                        <th>Price Per Week</th>
        
                        <th>Price Per Month</th>
        
                    </tr>
        ';

        $col_length = mysqli_num_fields($res_array);
        
        while ($res = mysqli_fetch_array($res_array))
        {
            $model_id = $res['model_id'];

            echo '
                <tr>
            ';
        
            for ($j = 0; $j < $col_length; $j++)
            { 
                echo '
                    <td>'.$res[$j].'</td>
                ';
            }

            echo '          
                    <td><a href="/car-rental-system/car-model/modify-car-model/modify-car-model-form.php?model_id='.$model_id.'">Edit Model</a></td>    
                    <td><a href="/car-rental-system/car-model/delete-car-model/delete-car-model-form.php?model_id='.$model_id.'">Delete Model</a></td>    
                </tr>
            ';
        }

        echo '
            </table>
        ';
    } else {
        echo '
            <div class="main_empty">
                <p>No models available</p>
                <br> 
        ';
    }

    echo '
                    <a href="/car-rental-system/admin/admin-home/admin-home-page.php">Go back</a>
                </div>
            </body>
        </html>
    ';
?>