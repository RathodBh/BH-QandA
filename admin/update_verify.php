<?php

include("../include/conn.php");
if (!empty($_POST["table"])) {
    $tbl = $_POST["table"];
    $id = $_POST["id"];
    $currentDate = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM $tbl where id='$id'";
    $row = $db->query($sql);
    $row = $row->fetch(PDO::FETCH_ASSOC);

    if ($row["verify"] == '1')
        $up = $db->prepare("update $tbl set verify='0',udate='$currentDate' WHERE id='$id'");
    else
        $up = $db->prepare("update $tbl set verify='1',udate='$currentDate' WHERE id='$id'");

    $up->execute();
}
if (!empty($_POST["aid"])) {
    $id = $_POST["aid"];
    $currentDate = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM answers where id='$id'";
    $row = $db->query($sql);
    $row = $row->fetch(PDO::FETCH_ASSOC);

    if ($row["best"] == '1')
        $up = $db->prepare("update answers set best='0',udate='$currentDate' WHERE id='$id'");
    else
        $up = $db->prepare("update answers set best='1',udate='$currentDate' WHERE id='$id'");
    $up->execute();
}

