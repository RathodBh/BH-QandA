<?php

include("../include/conn.php");
if (!empty($_POST["table"])) {
    $tbl = $_POST["table"];
    $id = $_POST["id"];

    $del = $db->prepare("delete from $tbl WHERE id='$id'");

    $del->execute();
}
