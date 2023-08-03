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
</body>
</html>