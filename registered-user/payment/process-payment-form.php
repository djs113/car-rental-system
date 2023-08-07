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

    echo '
        <form action="confirm-payment.php" method="POST">
            <label for="otp">Enter the otp: </label><input type="text" id="otp" name="otp" />
            <br><br>
            
            <input type="submit" value="Submit" />
        </form>
    '; 
?>