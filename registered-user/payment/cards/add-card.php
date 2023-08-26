<?php
    session_start();

    if (!isset($_SESSION['login_user']))
    {
        header("location:/car-rental-system/registered-user/user-login/user-login-page.html");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');
        
    if ($conn->connect_error)
        die("Connection error".$conn->connect_error);

    echo '
        <link rel="stylesheet" type="text/css" href="add-card-css.css">
        
        <script type="text/javascript">
            function formValidate()
            {
                var card_number = document.getElementById("card_number").value;
                var name_on_card = document.getElementById("name_on_card").value;
                var expiry_date = document.getElementById("expiry_date").value;
                var card_name = document.getElementById("card_name").value;

                if (card_number == "")
                {
                    alert("Enter card number");
                    return false;
                } else if (isNaN(card_number))
                {
                    alert("Card number should be a number");
                    return false;
                }

                if (name_on_card == "")
                {
                    alert("Enter name on card");
                    return false;
                } 

                if (expiry_date == "")
                {
                    alert("Enter expiry date");
                    return false;
                } else 
                {
                    var entered_date = new Date(expiry_date);
                    var current_date = new Date();
                    
                    if (entered_date <= current_date.getTime())
                    {
                        alert("Enter valid expiry date");
                        return false;
                    } 
                }

                if (card_name == "")
                {
                    alert("Enter card name");
                    return false;
                }
            } 
        </script>

        <div class="main">
            <form action="card-addition-script.php" method="POST" onsubmit="return formValidate()">
                <label for="card_number">Card Number: </label><input type="text" id="card_number" name="card_number" />
                <br><br>

                <label for="name_on_card">Name on Card: </label><input type="text" id="name_on_card" name="name_on_card" />
                <br><br>

                <label for="expiry_date">Expiry date: </label><input type="date" id="expiry_date" name="expiry_date" />
                <br><br>

                <label for="card_name">Card Name: </label><input type="text" id="card_name" name="card_name" />
                <br><br>

                <input type="submit" class="submit" value="Add card" />
            </form>
        </div>
         
        <button><a href="/car-rental-system/registered-user/profile-management/view-profile.php">Go back</a></button>
    ';
?>