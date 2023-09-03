<?php
    session_start();

    if (isset($_SESSION['login_user']))
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
?>

<html>
    <head>
        <title>
            Registered User Login Page
        </title>
        <script type="text/javascript">
            function formValidate() 
            {
                var username = document.getElementById("username").value;
                var passwd = document.getElementById("passwd").value;

                if (username == "") 
                {
                    alert("Enter username");
                    return false;
                }

                if (passwd == "") 
                {
                    alert("Enter password");
                    return false;
                }
            }
        </script>
        <link rel="stylesheet" type="text/css" href="user-login-page-css.css">
    </head>
    <body>
        <div class="heading">
            <h1>USER LOGIN</h1>
            <h2><strong>WELCOME TO THE LOGIN PAGE</strong></h2>
        </div>
        
        <div class="main">
            <form action="login.php" method="POST" onsubmit="return formValidate()">
                <label for="username">Username: </label><input type="text" name="username" id="username" />
                <br><br>
    
                <label for="password">Password: </label><input type="password" name="passwd" id="passwd" />
                <br><br>
    
                <input type="submit" class="submit" value="Login" />
            </form>
        </div>
    </body>
</html>