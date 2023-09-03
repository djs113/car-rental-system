<?php
    session_start();

    if (isset($_SESSION['login_admin'])) 
        header("location:/car-rental-system/admin/admin-home/admin-home-page.php");
?>

<html>
    <head>
        <title>
            Admin Login Page
        </title>
        <link rel="stylesheet" type="text/css" href="admin-login-form-css.css">
    </head>
    <body>
        <div class="heading">
            <h1>ADMIN LOGIN</h1>
            <h2><strong>WELCOME TO THE LOGIN PAGE FOR ADMIN</strong></h2>
        </div>

        <div class="main">
            <form action="/car-rental-system/admin/admin-login/admin-login.php" method="POST">
                <label for="username">Username: </label><input type="text" name="username" id="username" />
                <br><br>

                <label for="password">Password: </label><input type="password" name="passwd" id="passwd" />
                <br><br>

                <input type="submit" class="submit" value="Login" />
            </form>
        </div>
    </body>
</html>

