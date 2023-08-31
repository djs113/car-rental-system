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

    if ($_POST['payment_amount'])
    {
        $payment_amount = $_POST['payment_amount'];
        $_SESSION['payment_amount'] = $payment_amount;

        echo '
            <link rel="stylesheet" type="text/css" href="payment-form-css.css">

            <script type="text/javascript">
                function formValidate()
                {
                    var card_selected = document.getElementById("card").checked;
                    var cash_selected = document.getElementById("cash").checked;

                    console.log(card);

                    if ((!(card_selected)) && (!(cash_selected)))
                    {
                        alert("Enter payment method");
                        return false;
                    }
                }
            </script>

            <div class="main">
                <form action="payment-script.php" method="POST" onsubmit="return formValidate()">
                    <label for="payment_amount">Payable amount: </label><p>Rs.'.$payment_amount.'</p>
                    <br><br>

                    <label for="payment_method">Payment method: </label>

                    <div class="payment_methods">
                        <div class="payment_method_1">
                            <input type="radio" id="card" name="payment_method" value="card" />
                            <label for="card" id="card_label">card</label>
                            <br><br>
                        </div>
                        
                        <div class="payment_method_2">
                            <input type="radio" id="cash" name="payment_method" value="cash" />
                            <label for="cash" id="cash_label">cash</label>
                            <br><br> 
                        </div> 
                    </div>
                
                    <div class="buttons">
                        <input type="submit" class="submit" value="Next" />
                        <a href="/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php">Go home</a>
                    </div>
                </form>
            </div>
        ';
    } else
    {
        sleep(3);
        header("location:/car-rental-system/registered-user/vehicle-search/vehicle-search-form.php");
    }

?>