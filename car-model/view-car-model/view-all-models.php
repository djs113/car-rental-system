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

    require '/opt/lampp/htdocs/car-rental-system/common-functions.php';

    $conn = dbConnection();

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

            echo '          <td><a href="edit-model.php?model_id="'.$model_id.'">Edit Model</a></td>    
                        </tr>
            ';
        }

        echo '
                    </table>
                </body>
            </html>
        ';

?>