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

    $qry = "SELECT user_details.first_name, user_details.last_name, user_emails.email, 
            user_phone_numbers.phone_number FROM user_details LEFT JOIN user_emails ON 
            user_details.username = user_emails.username LEFT JOIN user_phone_numbers ON 
            user_emails.username = user_phone_numbers.username WHERE user_details.username = '$username'";

    $res_array = mysqli_query($conn, $qry);
    $res = mysqli_fetch_array($res_array);

    echo '
        <form action="edit-profile-script.php" method="POST">
            <label for="first_name">First name: </label><input type="text" id="first_name" name="first_name" value="'.$res['first_name'].'" />
            <br><br>

            <label for="last_name">Last name: </label><input type="text" id="last_name" name="last_name" value="'.$res['last_name'].'" />
            <br><br>

            <label for="email">Email: </label><input type="text" id="email" name="email" value="'.$res['email'].'" />
            <br><br>

            <label for="phone_number">Phone number: </label><input type="text" id="phone_number" name="phone_number" value="'.$res['phone_number'].'" />
            <br><br>

            <input type="submit" value="Save" />
        </form> 

        <button><a href="/car-rental-system/registered-user/profile-management/view-profile.php">Go back</a></button>
    ';
?>