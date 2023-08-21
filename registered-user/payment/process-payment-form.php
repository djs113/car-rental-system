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

    if ($_POST['card_number'])
    {
        echo '
            <script type="text/javascript">
                function formValidate()
                {
                    var otp = document.getElementById("otp").value;

                    if (otp == "")
                    {
                        alert("Enter the otp");
                        return false;
                    } else if (isNaN(otp))
                    {
                        alert("Otp must be a number");
                        return false;
                    }
                }
            </script>
            <form action="confirm-payment.php" method="POST" onsubmit="return formValidate()">
                <label for="otp">Enter the otp: </label><input type="text" id="otp" name="otp" />
                <br><br>
                
                <input type="submit" value="Submit" />
            </form>
        '; 
    } else
    {
        sleep(3);
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    } 
?>