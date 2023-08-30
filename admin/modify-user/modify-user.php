<?php
    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
  
    $qry = "UPDATE user_details SET first_name = '$first_name', last_name = '$last_name' WHERE username = '$username';";
    $qry .= "UPDATE user_emails SET email = '$email' WHERE username = '$username';";
    $qry .= "UPDATE user_phone_numbers SET phone_number = $phone_number WHERE username = '$username';";

    echo '
        <link rel="stylesheet" type="text/css" href="/car-rental-system/admin/modify-user/modify-user-css.css">
        <div class="main">
            <p>
    ';

    if ($conn->multi_query($qry) == TRUE)
        echo "User profile successfully modified.<br>";
    else
        echo "Error in modification of user profile.<br>Error: ".$conn->error."<br>";
    
    echo '
            </p>
            <a href="/car-rental-system/admin/view-user/view-all-users.php">Go back</a>
        </div>
    ';
?>