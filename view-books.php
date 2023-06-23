<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'car_rental_system';
   
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error)
        die("Connection failed".$conn->connect_error);
   
    $sql = "SELECT * FROM user_details INNER JOIN user_emails ON user_details.username = user_emails.username 
            INNER JOIN user_phone_numbers ON user_details.username = user_phone_numbers.username";
            
    $res_array = mysqli_query($conn, $sql);

    echo '<table cellspacing="2" cellpadding="3" border="3">
        <tr>
            <th>Username</th>
            <th>Password</th> 
            <th>First Name</th> 
            <th>Last Name</th> 
            <th>Is Admin</th>
            <th>Email</th>  
            <th>Phone Number</th> 
        </tr>';

    while ($row = mysqli_fetch_array($res_array))
    {
        echo '<tr>
            <td>'.$row["username"].'</td>
            <td>'.$row["passwd"].'</td>
            <td>'.$row["first_name"].'</td>
            <td>'.$row["last_name"].'</td>
            <td>'.$row["is_admin"].'</td>
            <td>'.$row["email"].'</td>
            <td>'.$row["phone_number"].'</td>
        </tr>';
    }

    echo '</table>';
    $conn->close();
?>