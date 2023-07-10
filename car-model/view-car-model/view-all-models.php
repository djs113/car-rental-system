<?php
    /*
    require '/opt/lampp/htdocs/car-rental-system/common-functions.php';

    $table = 'vehicle_models';
    $title= 'View Models';
    $headings = array('Model Id', 'Brand Name', 'Model Name', 'Vehicle Type', 'Price Per Hour', 'Price Per Day', 'Price Per Week', 'Price Per Month');

    displayData($table, $title, $headings);
    */
?>

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

    $qry = "SELECT * FROM vehicle_models";

    $res_array = mysqli_query($conn, $qry);

    echo '
            <html><head>
                    <title>
                        View Models       
                    </title>
                </head>
                <body><h2><u>View Models</u></h2> 
                
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

        echo '
                        <tr>
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

            echo '          <td><a href="/car-rental-system/car-model/modify-car-model/modify-car-model-form.php?model_id='.$model_id.'">Edit Model</a></td>    
                            <td><a href="/car-rental-system/car-model/delete-car-model/delete-car-model-form.php?model_id='.$model_id.'">Delete Model</a></td>    
                        </tr>

            ';
        }

        echo '
                    </table>
                </body>
            </html>
        ';

?>