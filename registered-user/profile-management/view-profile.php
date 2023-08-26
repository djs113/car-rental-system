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

    $qry =  "SELECT user_details.first_name, user_details.last_name, user_emails.email, user_phone_numbers.phone_number FROM user_details 
            LEFT JOIN user_emails ON user_details.username = user_emails.username LEFT JOIN 
            user_phone_numbers ON user_details.username = user_phone_numbers.username WHERE 
            user_details.username = '$username'";

    $res_array = mysqli_query($conn, $qry);
    $res = mysqli_fetch_array($res_array);

    echo '
        <link rel="stylesheet" type="text/css" href="/car-rental-system/registered-user/profile-management/view-profile-css.css">

        <div class="main">
            <label for="first_name">First name: </label><p>'.$res['first_name'].'</p>
            <br><br>

            <label for="last_name">Last name: </label><p>'.$res['last_name'].'</p>
            <br><br>

            <label for="email">Email: </label><p>'.$res['email'].'</p>
            <br><br>

            <label for="phone_number">Phone number: </label><p>'.$res['phone_number'].'</p>
            <br><br>
        </div>
        
        <div class="buttons">
            <button><a href="/car-rental-system/registered-user/profile-management/edit-profile.php">Edit profile</a></button>
            <button><a href="/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php">Go back</a></button>
            <button><a href="/car-rental-system/registered-user/payment/cards/add-card.php">Add card</a></button>
            <button><a href="/car-rental-system/registered-user/profile-management/view-cards.php">View cards</a></button>
        </div>
        
    ';
?>