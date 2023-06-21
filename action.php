<?php
    // date_default_timezone_set('Asia/Kolkata'); 
    
    $stdid = $_POST['stdid'];
    $stdname = $_POST['stdname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $sem = $_POST['sem'];
    $course = $_POST['course'];
    $batch = $_POST['batch'];

    // current_time = date("Y-m-d H:i:s");

    $conn = mysqli_connect("localhost", "root", "", "car_rental_system");

    if (($stdid != "") && ($stdname != ""))
    {
        $qry = "INSERT INTO user_table (stdid, stdname, phone, email, sem, course, batch) VALUES ('$stdid', '$stdname', '$phone', '$email', '$sem', '$course', '$batch')";
    }

    $res = mysqli_query($conn, $qry);
    
    if ($res)
    
?>