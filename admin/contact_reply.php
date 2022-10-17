<?php

include("../include/conn.php");
if (!empty($_POST["id"])) {
    $val = $_POST["val"];
    $id = $_POST["id"];

    $up = $db->prepare("update contact set solution='$val' WHERE id='$id'");
    $up->execute();
    
}
