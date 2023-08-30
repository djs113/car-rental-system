<html>
    <head>
        <title>
            Modify User
        </title>
        <script type="text/javascript">
            function form_validate()
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
        <link rel="stylesheet" type="text/css" href="/car-rental-system/admin/modify-user/modify-user-form-css.css">
    </head>
    <body>
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

            if ($conn->connect_error)
                die("Connection failed<br>Connection Error: ".$conn->connect_error);

            $username = $_REQUEST['username'];
            
            $qry = "SELECT * FROM user_details LEFT JOIN user_emails ON user_details.username = user_emails.username 
                    LEFT JOIN user_phone_numbers ON user_details.username = user_phone_numbers.username WHERE user_details.username='$username'";
            
            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);
        ?>

        <h1>Modify User</h1>
        <div class="main">
            <form action="modify-user.php" method="POST" onsubmit="return form_validate()">
                <input type="hidden" name="username" value="<?php echo $username;?>" />
                <br><br>

                <label for="username">Username: </label><p><?php echo $res['username'];?></p>
                <br><br>

                <label for="first_name">First Name: </label><input type="text" name="first_name" id="first_name" value="<?php echo $res['first_name'];?>" />
                <br><br>

                <label for="last_name">Last Name: </label><input type="text" name="last_name" id="last_name" value="<?php echo $res['last_name'];?>" />
                <br><br>

                <label for="email">Email: </label><input type="email" name="email" id="email" value="<?php echo $res['email'];?>" />
                <br><br>

                <label for="phone_number">Phone Number: </label><input type="text" name="phone_number" id="phone_number" value="<?php echo $res['phone_number'];?>" />
                <br><br>

                <div class="buttons">
                    <input type="submit" class="submit" value="Modify User" />
                    <a href="/car-rental-system/admin/admin-home/admin-home-page.php">Go back</a>
                </div>
            </form>
        </div>
    </body>
</html>