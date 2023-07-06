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

    echo '<table cellspacing="3" cellpadding="3" border="1">
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
        echo '<td><a href="/car-rental-system/registered-user/modify-user/modify-user-form.php?username='.$username.'">Edit User</a></td>';    
        echo '</tr>';
    }

    echo '</table>';

    $conn->close();
?>