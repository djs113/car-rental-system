<?php
    session_start();

    if (!isset($_SESSION['login_user']))
    {
        header("location:/car-rental-system/registered-user/user-login/user-login-page.html");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $username = $_SESSION['login_user'];

    $qry = "SELECT card_id FROM user_cards WHERE username = '$username'";
    $res_array = mysqli_query($conn, $qry);

    echo '
        <table border="1"> 
            <tr>
                <th>Booking ID</th>
                <th>Brand Name</th>
                <th>Model Name</th>
            </tr>    
    ';
    
    while ($res = mysqli_fetch_array($res_array))
    {
        $card_id = $res[0];

        $qry = "SELECT card_booking_details.booking_id, vehicle_models.brand_name, 
                vehicle_models.model_name FROM card_booking_details LEFT JOIN vehicles ON 
                card_booking_details.registration_number = vehicles.registration_number LEFT JOIN 
                vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE 
                card_booking_details.card_id = $card_id
                UNION
                SELECT cash_booking_details.booking_id, vehicle_models.brand_name, vehicle_models.model_name
                FROM cash_booking_details LEFT JOIN vehicles ON cash_booking_details.registration_number = 
                vehicles.registration_number LEFT JOIN vehicle_models ON vehicles.model_id = vehicle_models.model_id WHERE 
                username = '$username'";
        
        $res_array = mysqli_query($conn, $qry);

        while ($res = mysqli_fetch_array($res_array))
        {
            echo '
                <tr>
                    <td>'.$res[0].'</td>
                    <td>'.$res[1].'</td>
                    <td>'.$res[2].'</td>
                    <td><a href="/car-rental-system/registered-user/profile-management/manage-booking.php?booking_id='.$res[0].'">View Booking</a></td>
                </tr> 
            ';
        }
    }
?>