<?php
    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $given_pick_up_date = $_POST['pick_up_date'];
    $given_pick_up_time = $_POST['pick_up_time'];

    $given_drop_off_date = $_POST['drop_off_date'];
    $given_drop_off_time = $_POST['drop_off_time'];

    // unbooked vehicle details

    $qry = "SELECT vehicle_models.model_name, vehicle_models.brand_name FROM vehicles LEFT JOIN vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE vehicles.is_booked = 0 GROUP BY vehicle_models.model_id";
    $unbooked_vehicles_array = mysqli_query($conn, $qry);

    
    // currently booked vehicle details (that satisfies time period given by user)
    
    $qry = "SELECT DISTINCT vehicle_models.model_name, vehicle_models.brand_name, vehicle_models.model_id FROM vehicles LEFT JOIN vehicle_models ON 
            vehicles.model_id = vehicle_models.model_id WHERE vehicles.is_booked = 0 GROUP BY vehicle_models.model_id
            UNION
            SELECT DISTINCT vehicle_models.model_name, vehicle_models.brand_name, vehicle_models.model_id FROM vehicles LEFT JOIN card_booking_details
            ON vehicles.registration_number = card_booking_details.registration_number LEFT JOIN vehicle_models ON 
            vehicles.model_id = vehicle_models.model_id WHERE ('$given_drop_off_date' < card_booking_details.pick_up_date OR 
            '$given_pick_up_date' > card_booking_details.drop_off_date) 
            UNION 
            SELECT DISTINCT vehicle_models.model_name, vehicle_models.brand_name, vehicle_models.model_id FROM vehicles LEFT JOIN 
            card_booking_details ON vehicles.registration_number = card_booking_details.registration_number LEFT JOIN 
            vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE 
            ('$given_drop_off_date' < card_booking_details.pick_up_date OR 
            '$given_pick_up_date' > card_booking_details.drop_off_date)";

    $vehicles_array = mysqli_query($conn, $qry);

    if (mysqli_num_rows($vehicles_array) == 0)
    {
        echo 'No available vehicles for this time period
              <br><br>
              <button><a href="/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php">Search again</a></button>
        ';

    } else
    {
        echo '
            <table border="1">
                <th>Model Name</th>
                <th>Brand Name</th>
        ';

        while ($res = mysqli_fetch_row($vehicles_array))
            {
                echo '
                    <tr>
                        <td>'.$res[0].'</td>
                        <td>'.$res[1].'</td>
                        <td><a href="book-individual-vehicle.php?model_id='.$res[2].'">Book</a></td>
                    </tr>
                ';
            }
    }

    echo '
        </table>
    ';

?>