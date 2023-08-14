<?php
    session_start();

    if (!isset($_SESSION['login_admin']))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login-form.php");
        exit;
    }

    $conn = mysqli_connect('localhost', 'root', '', 'car_rental_system');

    if ($conn->connect_error)
        die("Connection failed<br>Connection Error: ".$conn->connect_error);

    $qry = "SELECT * FROM contact_details_1";

    $res_array_1 = mysqli_query($conn, $qry);
    $res_1 = mysqli_fetch_array($res_array_1);

    $contact_1_count = mysqli_num_rows($res_array_1);

    $qry = "SELECT * FROM contact_details_2";

    $res_array_2 = mysqli_query($conn, $qry);
    $res_2 = mysqli_fetch_array($res_array_2);

    $contact_2_count = mysqli_num_rows($res_array_2);

    $details_count = $contact_1_count + $contact_2_count;

    if ($details_count == 2)
    {
        $contact_email = $res_1['contact_email'];
        $contact_number_1 = $res_1['contact_number_1'];
        $contact_number_2 = $res_2['contact_number_2'];
        $address = $res_2['address'];

        echo '
            <html>
                <head>
                    <title>
                        Modify Contact Details
                    </title>
                    <script type="text/javascript">
                        function form_validate()
                        {
                            var contact_email = document.getElementById("contact_email").value;
                            var contact_number_1 = document.getElementById("contact_number_1").value;
                            var contact_number_2 = document.getElementById("contact_number_2").value;
                            var address = document.getElementById("address").value;

                            var email_reg = /^\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                            var phone_reg = /^\d{10}$/;

                            if (contact_email == "")
                            {
                                alert("Enter email");
                                return false;
                            } else if (!(contact_email.match(email_reg)))
                            {
                                alert("Enter valid email");
                                return false;
                            }

                            if (contact_number_1 == "")
                            {
                                alert("Enter contact number 1");
                                return false;
                            } else if (!(contact_number_1.match(phone_reg)))
                            {
                                alert("Enter valid contact number 1");
                                return false;
                            }

                            if (contact_number_2 == "")
                            {
                                alert("Enter contact number 2");
                                return false;
                            } else if (!(contact_number_2.match(phone_reg)))
                            {
                                alert("Enter valid contact number 2");
                                return false;
                            }

                            if (contact_number_1 == contact_number_2)
                            {
                                alert("Contact number 1 and contact number 2 must be different");
                                return false;
                            }

                            if (address == "")
                            {
                                alert("Enter address");
                                return false;
                            }
                        }
                    </script>
                </head>
                <body>
                    <form action="modify-contact-details-script.php" method="POST" onsubmit="return form_validate()">
                        <label for="contact_email">Contact email: </label><input type="email" id="contact_email" name="contact_email" value="'.$contact_email.'"/>
                        <br><br>

                        <label for="contact_number_1">Contact number 1: </label><input type="text" id="contact_number_1" name="contact_number_1" value="'.$contact_number_1.'"/>
                        <br><br>

                        <label for="contact_number_2">Contact number 2: </label><input type="text" id="contact_number_2" name="contact_number_2" value="'.$contact_number_2.'"/>
                        <br><br>

                        <label for="address">Address: </label>
                        <br>

                        <textarea id="address" name="address" rows="10" cols="30">'.$address.'</textarea>
                        <br><br>

                        <input type="submit" value="Modify" />
                    </form>
                </body>
            </html> 
        ';
    } else 
        header("location:/car-rental-system/admin/admin-home/admin-home-page.php");
?>