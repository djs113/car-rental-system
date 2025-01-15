<html>
    <head>
        <title>
            Logged In Page
        </title>
    </head>
    <body>
        You have successfully logged in.
        <?php
            session_start();

            $username = $_SESSION['login_user'];
            echo '<a type="submit"><a href="/car-rental-system/registered-user/user-login/logout.php?username='.$username.'">Logout</a>';
        ?>
    </body>
</html>