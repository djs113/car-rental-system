<html>
    <head>
        <title>
            Admin Logged In Page
        </title>
    </head>
    <body>
        You have successfully logged in.
        <?php
            session_start();

            $username = $_SESSION['login_admin'];
            echo '<button type="submit"><a href="/car-rental-system/admin/admin-login/admin-logout.php?username='.$username.'">Logout</a></button>';
        ?>
    </body>
</html>