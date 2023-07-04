<?php
    function passwordCheck($table_name) {
        $username = $_POST['username'];
        $passwd = $_POST['passwd'];
        $enc_passwd = md5($passwd);
        
        $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');
        
        $qry = "SELECT passwd FROM ".$table_name." WHERE username='$username'";
        $res_array = mysqli_query($conn, $qry);
           
        while ($res = mysqli_fetch_array($res_array))
        {
            if ($enc_passwd == $res['passwd']) 
                echo "Successfully logged in"; 
            else 
                echo "Invalid username or password";
        }
    }
?>