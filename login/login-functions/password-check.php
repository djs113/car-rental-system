<?php
    function passwordCheck($table_name, $conn) {
        $username = $_POST['username'];
        $passwd = $_POST['passwd'];
        $enc_passwd = md5($passwd);
        
        $qry = "SELECT passwd FROM $table_name WHERE username='$username'";
        $res_array = mysqli_query($conn, $qry);

        $row_count = mysqli_num_rows($res_array);

        if ($row_count == 0)
            echo "Invalid username or password";
        else
        {
            while ($res = mysqli_fetch_array($res_array))
            {
                if ($enc_passwd == $res['passwd']) 
                    echo "Successfully logged in"; 
                else 
                    echo "Invalid username or password";
            }
        }
    }
?>