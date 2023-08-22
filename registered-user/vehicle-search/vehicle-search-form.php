<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Search</title>
    <script type="text/javascript">
        function validate_booking_period()
        {
            var pick_up_date = new Date(document.getElementById("pick_up_date").value);
            var pick_up_time = new Date(document.getElementById("pick_up_date").value + "T" + document.getElementById("pick_up_time").value + ":00");

            var drop_off_date = new Date(document.getElementById("drop_off_date").value);
            var drop_off_time = new Date(document.getElementById("drop_off_date").value + "T" + document.getElementById("drop_off_time").value + ":00");

            var current_date = new Date();

            if (pick_up_date.getTime() > drop_off_date.getTime())
            {
                alert("Pick up date should be lesser than or equal to drop off date");
                return false;
            }
            else if ((pick_up_date.getTime() == drop_off_date.getTime()) && (pick_up_time.getTime() > drop_off_time.getTime()))
            {
                alert("Pick up time should be lesser than drop off time");
                return false;
            }

            if (pick_up_date.getTime() < current_date.getTime())
            {
                alert("Pick up date should be greater than or equal to today's date");
                return false;
            }

            
        }
    </script>
</head>
<body>
    <h2><u>Available Vehicle Search</u></h2>
    <form action="vehicle-search-script.php" method="POST">
        <label for="pick_up_date">Pick up date: </label><input type="date" name="pick_up_date" id="pick_up_date" />
        <br><br>

        <label for="pick_up_time">Pick up time: </label><input type="time" name="pick_up_time" id="pick_up_time" />
        <br><br>

        <label for="drop_off_date">Drop off date: </label><input type="date" name="drop_off_date" id="drop_off_date" />
        <br><br>

        <label for="drop_off_time">Drop off time: </label><input type="time" name="drop_off_time" id="drop_off_time" />
        <br><br>

        <input type="submit" value="Search Vehicles" onclick="return validate_booking_period()"/>
    </form>
    
    <br><br>
    <button><a href="/car-rental-system/registered-user/profile-management/view-bookings.php">View Bookings</a></button>
    <button><a href="/car-rental-system/registered-user/profile-management/view-profile.php">View profile</a></button>
    <?php
        session_start();

        if (isset($_SESSION['login_user']))
            echo '<button><a href="/car-rental-system/registered-user/user-login/logout.php">Logout</a></button>';
        else
            echo '
                <button><a href="/car-rental-system/registered-user/user-login/user-login-page.html">Login</a></button>
                <button><a href="/car-rental-system/registration/registration-form.html">Register</a></button> 
            ';
        
        $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

        if ($conn->connect_error)
            die("Connection failed<br>Connection Error: ".$conn->connect_error);

        $qry = "SELECT * FROM contact_details_1";

        $res_array_1 = mysqli_query($conn, $qry);
        $contact_1_count = mysqli_num_rows($res_array_1);

        $qry = "SELECT * FROM contact_details_2";

        $res_array_2 = mysqli_query($conn, $qry);
        $contact_2_count = mysqli_num_rows($res_array_2);

        $details_count = $contact_1_count + $contact_2_count;

        if ($details_count == 2)
            echo '<button><a href="/car-rental-system/admin/contact-management/contact-details-display.php">Contact us</a></button>'
    ?>
</body>
</html>