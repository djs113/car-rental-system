<?php
    session_start();

    if (!isset($_SESSION['login_admin']))
    {
        header("location:/car-rental-system/admin/admin-login/admin-login.php");
        exit;
    }

    echo '
        <a href="/car-rental-system/car/add-car/add-car-form.php">Add car</a>
        <br><br>

        <a href="/car-rental-system/car/view-car/view-all-cars.php">View cars</a>
        <br><br>

        <a href="/car-rental-system/car-model/add-car-model/add-car-model-form.php">Add car model</a>
        <br><br>

        <a href="/car-rental-system/car-model/view-car-model/view-all-models.php">View car models</a>
        <br><br>

        <a href="/car-rental-system/registered-user/view-user/view-all-users.php">View users</a>
        <br><br>

        <button><a href="/car-rental-system/admin/admin-login/admin-logout.php">Logout</a></button>
    ';
?>