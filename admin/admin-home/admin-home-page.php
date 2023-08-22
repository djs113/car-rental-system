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

    $qry = "SELECT COUNT(*) FROM contact_details_1";
    
    $res_array_1 = mysqli_query($conn, $qry);
    $res_1 = mysqli_fetch_array($res_array_1);

    $qry = "SELECT COUNT(*) FROM contact_details_2";
    
    $res_array_2 = mysqli_query($conn, $qry);
    $res_2 = mysqli_fetch_array($res_array_2);

    $details_count = $res_1[0] + $res_2[0];

    if ($details_count == 0)
    {
        echo '
            <a href="/car-rental-system/admin/contact-management/add-contact-details/add-contact-details-form.php">
            Add contact details</a> 
            <br><br>
        ';
    } else 
    {
        echo '
            <a href="/car-rental-system/admin/contact-management/modify-contact-details/modify-contact-details-form.php">
            Modify contact details</a>
            <br><br> 
        ';
    }
    
    echo '

        <a href="/car-rental-system/admin/vehicle-return/returning-vehicles-display.php">View returning 
        vehicles</a>
        <br><br>
        
        <a href="/car-rental-system/car/add-car/add-car-form.php">Add car</a>
        <br><br>

        <a href="/car-rental-system/car/view-car/view-all-cars.php">View cars</a>
        <br><br>

        <a href="/car-rental-system/car-model/add-car-model/add-car-model-form.php">Add car model</a>
        <br><br>

        <a href="/car-rental-system/car-model/view-car-model/view-all-models.php">View car models</a>
        <br><br>

        <a href="/car-rental-system/admin/view-user/view-all-users.php">View users</a>
        <br><br>
        
        <button><a href="/car-rental-system/admin/admin-login/admin-logout.php">Logout</a></button>
    ';
?>