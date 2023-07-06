<html>
    <head>
        <title>
            Modify User
        </title>
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
        <h2><u>Modify User</u></h2>
        <form action="modify-user.php" method="POST">
            <input type="hidden" name="username" value="<?php echo $username;?>" />
            <br><br>

            Username: <?php echo $res['username'];?>
            <br><br>

            <!--
            <label for="username">Username: </label><input type="text" name="username" id="username" value="<?php echo $res['username'];?>" />
            <br><br>
            -->

            <label for="first_name">First Name: </label><input type="text" name="first_name" id="first_name" value="<?php echo $res['first_name'];?>" />
            <br><br>

            <label for="last_name">Last Name: </label><input type="text" name="last_name" id="last_name" value="<?php echo $res['last_name'];?>" />
            <br><br>

            <label for="passwd">Password Hash: </label><input type="text" name="passwd" id="passwd" value="<?php echo $res['passwd'];?>" />
            <br><br>

            <input type="submit" value="Modify User" />
        </form>
    </body>
</html>