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

    $qry = "SELECT * FROM contact_details_1";

    $res_array_1 = mysqli_query($conn, $qry);
    $res_1 = mysqli_fetch_array($res_array_1);

    $qry = "SELECT * FROM contact_details_2";

    $res_array_2 = mysqli_query($conn, $qry);
    $res_2 = mysqli_fetch_array($res_array_2);

    $contact_1_count = mysqli_num_rows($res_array_1);
    $contact_2_count = mysqli_num_rows($res_array_2);

    $details_count = $contact_1_count + $contact_2_count;

    if ($details_count == 2)
    {
        $contact_email = $res_1['contact_email'];
        $contact_number_1 = $res_1['contact_number_1'];
        $contact_number_2 = $res_2['contact_number_2'];
        $address = $res_2['address'];
        
        echo '
            <label for="contact_email">Contact email: </label>'.$contact_email.'
            <br><br>

            <label for="contact_number_1">Contact number 1: </label>'.$contact_number_1.'
            <br><br>

            <label for="contact_number_2">Contact number 2: </label>'.$contact_number_2.'
            <br><br>

            <label for="address">Address: </label>'.$address.'
            <br><br>

            <button><a href="/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php">Go back</a></button>
        ';
    } else
        header("location:/car-rental-system/admin/admin-home/admin-home-page.php");    
?>