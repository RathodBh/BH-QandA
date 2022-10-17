<?php

include("include/conn.php");
if (!empty($_POST["email"])) {

    $email= $_POST["email"];

    $sql = "SELECT email FROM users WHERE email='$email'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();


    if ($count>0) {
        echo "<span style='color:red'> Email already exists .</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> Email available for Registration .</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}
