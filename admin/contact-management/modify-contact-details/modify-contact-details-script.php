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

    if (isset($_POST['contact_email']) && isset($_POST['contact_number_1']) && isset($_POST['contact_number_2']) && isset($_POST['address']))
    {
        $contact_email = $_POST['contact_email'];
        $contact_number_1 = $_POST['contact_number_1'];
        $contact_number_2 = $_POST['contact_number_2'];
        $address = $_POST['address'];

        $qry = "UPDATE contact_details_1 SET contact_email = '$contact_email', 
                contact_number_1 = $contact_number_1;";

        $qry .= "UPDATE contact_details_2 SET contact_number_2 = $contact_number_2, 
                address = '$address';";
        
        if ($conn->multi_query($qry) == TRUE)
            echo 'Successfully updated contact details';
        else
        {
            echo '
                Error in updation of contact details<br>
                Error: '.$conn->error;
        }
    } else 
        header("location:/car-rental-system/admin/admin-home/admin-home-page.php");
?>