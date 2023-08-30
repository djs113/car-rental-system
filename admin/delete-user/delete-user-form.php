<html>
    <head>
        <title>
            Delete User
        </title>
        <link rel="stylesheet" type="text/css" href="/car-rental-system/admin/delete-user/delete-user-form-css.css">
    </head>
    <body>
        <h1>Delete User</h1>
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
                <div class="main">
                    <form action="delete-user.php" method="POST">
                        <input type="hidden" name="username" id="username" value="'.$username.'" />
                        
                        <label for="username">Username: </label><p>'.$username.'</p>
                        <br><br>

                        <label for="first_name">First Name: </label><p>'.$res['first_name'].'</p>
                        <br><br>

                        <label for="last_name">Last Name: </label><p>'.$res['last_name'].'</p>
                        <br><br>

                        <span>Do you really want to delete this user?</span>
                        <br>

                        <div class="buttons">
                            <input type="submit" class="submit" value="Delete User">
                            <a href="/car-rental-system/admin/view-user/view-all-users.php">Go back</a>
                        </div>
                    </form>
                </div>
            ';
        ?>
    </body>
</html>

