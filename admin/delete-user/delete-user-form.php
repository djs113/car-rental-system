<html>
    <head>
        <title>
            Delete User
        </title>
    </head>
    <body>
        <h2><u>Delete User</u></h2>
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
                
            $username = $_REQUEST['username'];

            $qry = "SELECT first_name, last_name FROM user_details WHERE username = '$username'";

            $res_array = mysqli_query($conn, $qry);
            $res = mysqli_fetch_array($res_array);

            echo '
                Do you really want to delete this user?
                <br><br>
                
                <form action="delete-user.php" method="POST">
                    <input type="hidden" name="username" id="username" value="'.$username.'" />
                    
                    <label for="username">Username: </label>'.$username.'
                    <br><br>

                    <label for="first_name">First Name: </label>'.$res['first_name'].'
                    <br><br>

                    <label for="last_name">Last Name: </label>'.$res['last_name'].'
                    <br><br>

                    <input type="submit" value="Delete User">
                </form>
            ';
        ?>
    </body>
</html>

