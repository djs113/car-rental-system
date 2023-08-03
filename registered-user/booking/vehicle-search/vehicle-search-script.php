<?php
    session_start();

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

    echo '
        <table border="1">
            <th>Model Name</th>
            <th>Brand Name</th>
    ';

    while ($res = mysqli_fetch_array($unbooked_vehicles_array))
    {
        echo '
            <tr>
                <td>'.$res[0].'</td>
                <td>'.$res[1].'</td>
                <td><a href="book-individual-vehicle.php">Book</a></td>
            </tr>
        ';
    }

    echo '
        </table>
    ';

    /* 
    // currently booked vehicle details (that satisfies time period given by user)
    $qry = "SELECT DISTINCT vehicles.registration_number from vehicles LEFT JOIN card_booking_details ON vehicles.registration_number = card_booking_details.registration_number WHERE (given_drop_off_date < pick_up_date OR given_pick_up_date > drop_off_date)";
    $card_booked_vehicles_array = mysqli_query($conn, $qry);

    $qry = "SELECT DISTINCT registration_number from cash_booking_details WHERE given_drop_off_date < pick_up_date OR given_pick_up_date > drop_off_date;";
    $cash_booked_vehicles_array = mysqli_query($conn, $sql);

    $booked_vehicles_array = array($card_booked_vehicles_array, $cash_booked_vehicles_array);

    foreach ($booked_vehicles_array as $vehicles_array)
    {

    }
    */
?>