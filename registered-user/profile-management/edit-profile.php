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
        <link rel="stylesheet" type="text/css" href="edit-profile-css.css">

        <script type="text/javascript">
            function formValidate()
            {
                var first_name = document.getElementById("first_name").value;
                var last_name = document.getElementById("last_name").value;
                var email = document.getElementById("email").value;
                var phone_number = document.getElementById("phone_number").value;

                var email_reg = /^\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                var phone_reg = /^\d{10}$/;

                if (first_name == "")
                {
                    alert("Enter first name");
                    return false;
                }

                if (last_name == "")
                {
                    alert("Enter last name");
                    return false;
                }

                if (email == "")
                {
                    alert("Enter email");
                    return false;
                } else if (!(email.match(email_reg)))
                {
                    alert("Enter valid email");
                    return false;
                }

                if (phone_number == "")
                {
                    alert("Enter phone number");
                    return false;
                } else if (!(phone_number.match(phone_reg)))
                {
                    alert("Enter valid phone number");
                    return false;
                }
            } 
        </script>

        <div class="main">
            <form action="edit-profile-script.php" method="POST" onsubmit="return formValidate()">
                <label for="first_name">First name: </label><input type="text" id="first_name" name="first_name" value="'.$res['first_name'].'" />
                <br><br>

                <label for="last_name">Last name: </label><input type="text" id="last_name" name="last_name" value="'.$res['last_name'].'" />
                <br><br>

                <label for="email">Email: </label><input type="email" id="email" name="email" value="'.$res['email'].'" />
                <br><br>

                <label for="phone_number">Phone number: </label><input type="text" id="phone_number" name="phone_number" value="'.$res['phone_number'].'" />
                <br><br>

                <input class="submit" type="submit" value="Save" />
            </form> 
        </div>
        

        <a href="/car-rental-system/registered-user/profile-management/view-profile.php">Go back</a>
    ';
?>