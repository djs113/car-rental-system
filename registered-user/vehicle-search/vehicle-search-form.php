<?php
    session_start();

    echo '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Vehicle Search</title>
                <script type="text/javascript">
                    function validateBookingPeriod()
                    {
                        var pick_up_date = new Date(document.getElementById("pick_up_date").value);
                        var pick_up_time = new Date(document.getElementById("pick_up_date").value + "T" + document.getElementById("pick_up_time").value + ":00");
        
                        var drop_off_date = new Date(document.getElementById("drop_off_date").value);
                        var drop_off_time = new Date(document.getElementById("drop_off_date").value + "T" + document.getElementById("drop_off_time").value + ":00");
        
                        var current_date_time = new Date();
        
                        if (pick_up_time.getTime() < current_date_time.getTime())
                        {    
                            if (pick_up_date.toDateString() == current_date_time.toDateString())
                            {
                                alert("Pick up time should be greater than current time");
                                return false;
                            } else
                            {
                                alert("Pick up date should be greater than or equal to today\'s date");
                                return false;
                            }
                        } 
                        
                        if (pick_up_date.getTime() > drop_off_date.getTime())
                        {
                            alert("Pick up date should be lesser than or equal to drop off date");
                            return false;
                        } else if (pick_up_date.getTime() == drop_off_date.getTime())
                        {
                            if (pick_up_time.getTime() >= drop_off_time.getTime())
                            {
                                alert("Pick up time should be lesser than drop off time");
                                return false;
                            } else 
                            {
                                var hour_diff = drop_off_time.getHours() - pick_up_time.getHours();
                                
                                if (hour_diff < 1)
                                {
                                    alert("Booking duration must be at least for an hour");
                                    return false;
                                } else if (hour_diff == 1)
                                {
                                    if ((drop_off_time.getMinutes() - pick_up_time.getMinutes()) < 0)
                                    {
                                        alert("Booking duration must be at least an hour");
                                        return false;
                                    }
                                }
                            }
                        } 
                    }
                </script>
                <link rel="stylesheet" type="text/css" href="fonts.css">
                <link rel="stylesheet" type="text/css" href="vehicle-search-form-css.css">
                <link rel="stylesheet" type="text/css" href="/car-rental-system/css/all.css">
                <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
            </head>
            <body class="active">
                <div class="main">
                    <p><u>Available Vehicle Search</u></p>
                    <form action="vehicle-search-script.php" method="POST" onsubmit="return validateBookingPeriod()">
                        <label for="pick_up_date">Pick up date: </label><input type="date" name="pick_up_date" id="pick_up_date" />
                        <br><br>
        
                        <label for="pick_up_time">Pick up time: </label><input type="time" name="pick_up_time" id="pick_up_time" />
                        <br><br>
        
                        <label for="drop_off_date">Drop off date: </label><input type="date" name="drop_off_date" id="drop_off_date" />
                        <br><br>
        
                        <label for="drop_off_time">Drop off time: </label><input type="time" name="drop_off_time" id="drop_off_time" />
                        <br><br>
        
                        <input type="submit" value="Search Vehicles" id="submit"/>
                    </form>
                    <br><br>
                </div>
    
                <div class="wrapper">
                    <div class="section">
                        <div class="top_navbar">
                            <div class="hamburger">
                                <a href="#">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        var hamburger = document.querySelector(".hamburger");
                        hamburger.addEventListener("click", function(){
                            document.querySelector("body").classList.toggle("active");
                        })
                    </script>

                    <div class="sidebar">
    ';

    if (isset($_SESSION['login_user']))
    {
        $username = $_SESSION['login_user'];

        echo '
                        <div class="profile">
                            <h3>'.$username.'</h3>
                        </div>
        ';
    }
                           
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

    echo '
        <ul> 
    ';

    if ($details_count == 2)
        echo '
                            <li>
                                <a href="/car-rental-system/admin/contact-management/contact-details-display.php">
                                    <span class="icon"><i class=""></i></span>
                                    <span class="item">Contact us</span>
                                </a>
                            </li>
        ';
    
    if (isset($_SESSION['login_user']))
    {
        echo '          
                            <li>
                                <a href="/car-rental-system/registered-user/user-login/logout.php">
                                    <span class="icon"><i class=""></i></span>
                                    <span class="item">Logout</span>
                                </a>
                            </li>

                            <li>
                                <a href="/car-rental-system/registered-user/profile-management/view-bookings.php">
                                    <span class="icon"><i class=""></i></span>
                                    <span class="item">View bookings</span>
                                </a>
                            </li>

                            <li>
                                <a href="/car-rental-system/registered-user/profile-management/view-profile.php">
                                    <span class="icon"><i class=""></i></span>
                                    <span class="item">View profile</span>
                                </a>
                            </li>
        ';
    }
    else
    {  
        echo '
                            <li>
                                <a href="/car-rental-system/registered-user/user-login/user-login-page.html">
                                    <span class="icon"><i class=""></i></span>
                                    <span class="item">Login</span>
                                </a>
                            </li>

                            <li>
                                <a href="/car-rental-system/registration/registration-form.html">
                                    <span class="icon"><i class=""></i></span>
                                    <span class="item">Register</span>
                                </a>
                            </li>

                            <li>
                                <a href="/car-rental-system/admin/admin-login/admin-login-form.php">
                                    <span class="icon"><i class=""></i></span>
                                    <span class="item">Admin Login</span>
                                </a> 
                            </li>
        ';
    }

    echo '
                        </ul>
                    </div>
                </div>
            </body>
        </html>
    ';
?>