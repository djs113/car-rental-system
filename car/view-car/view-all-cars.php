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

    $qry = "SELECT vehicles.registration_number, vehicles.vehicle_color, vehicles.is_booked, vehicle_models.brand_name, vehicle_models.model_name, vehicles.model_id FROM vehicles LEFT JOIN vehicle_models ON vehicles.model_id = vehicle_models.model_id";

    $res_array = mysqli_query($conn, $qry);

    echo '
            <html><head>
                    <title>
                        View Cars       
                    </title>
                <link rel="stylesheet" type="text/css" href="/car-rental-system/car/view-car/view-all-cars-css.css">
                </head>
                <h1>View Cars</h1> 
                <div class="main">
                    <body>
                    
                    <table cellspacing="3" cellpadding="3" border="1">
                        <tr> 
                            <th>Registration Number</th>
            
                            <th>Vehicle Color</th>
            
                            <th>Booking Status</th>

                            <th>Brand Name</th>

                            <th>Model Name</th>
            
                            <th>Model Id</th>
                        </tr>
        ';

        echo '
                        <tr>
        ';

        $col_length = mysqli_num_fields($res_array);
        
        while ($res = mysqli_fetch_array($res_array))
        {
            $registration_number = $res['registration_number'];

            echo '
                        <tr>
            ';
        
            for ($j = 0; $j < $col_length; $j++)
            { 
                echo '
                            <td>'.$res[$j].'</td>
                ';
            }

            echo '          <td><button><a href="/car-rental-system/car/modify-car/modify-car-form.php?registration_number='.$registration_number.'">Edit Car</a></button></td> 
                            <td><button><a href="/car-rental-system/car/delete-car/delete-car-form.php?registration_number='.$registration_number.'">Delete Car</a></button></td>   
                        </tr>
            ';
        }

        echo '
                        </table>
                        <button><a href="/car-rental-system/admin/admin-home/admin-home-page.php">Go back</a></button>
                    </div>
                </body>
            </html>
        ';

?>