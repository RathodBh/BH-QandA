<?php

include("../include/conn.php");
if (!empty($_POST["category"])) {

    $category = $_POST["category"];

    $sql = "SELECT name FROM category WHERE name='$category'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "<span style='color:red'>category already exists .</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {
        // echo "<span style='color:green'>category available .</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}
