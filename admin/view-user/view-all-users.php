<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'car_rental_system';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
        die("Connection failed<br>Connection Error: ".$conn->connect_error);
  
    $qry = "SELECT * FROM user_details LEFT JOIN user_emails ON user_details.username = user_emails.username 
            LEFT JOIN user_phone_numbers ON user_details.username = user_phone_numbers.username";

    $res_array = mysqli_query($conn, $qry);

    echo '
        <html>
            <head>
                <title>
                    View Users       
                </title>
                <link rel="stylesheet" href="/car-rental-system/admin/view-user/view-all-users-css.css">
            </head>
            <body>     
    ';

    $user_count = mysqli_num_rows($res_array);

    if ($user_count != 0)
    {
        echo '
            <h1>View Users</h1>
            
            <div class="main">    
                <table cellspacing="3" cellpadding="3" border="1">
                <tr>
                    <th>Username</th>
                    <th>Password</th>  
                    <th>First Name</th>  
                    <th>Last Name</th>
                    <th>Email</th>  
                    <th>Phone Number</th>
                </tr>
        ';
        
        while ($res = mysqli_fetch_array($res_array))
        {
            $username = $res['username'];

            echo '<tr>';
            echo '<td>'.$res['username'].'</td>';
            echo '<td>'.$res['passwd'].'</td>';
            echo '<td>'.$res['first_name'].'</td>';
            echo '<td>'.$res['last_name'].'</td>';
            echo '<td>'.$res['email'].'</td>';
            echo '<td>'.$res['phone_number'].'</td>';
            echo '<td><a href="/car-rental-system/admin/modify-user/modify-user-form.php?username='.$username.'">Edit User</a></td>';    
            echo '<td><a href="/car-rental-system/admin/delete-user/delete-user-form.php?username='.$username.'">Delete User</a></td>';    
            echo '</tr>';
        }

        echo '
            </table> 
        ';
    } else {
        echo '
            <div class="no_users">
                <p>No users are added</p>
                <br>
        ';
    }

    echo '
                    <a href="/car-rental-system/admin/admin-home/admin-home-page.php">Go back</a> 
                </div>
            </body>
        </html>
    ';

    $conn->close();
?>