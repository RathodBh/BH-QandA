<?php

session_start();
include('../../../include/conn.php');
$p = $_REQUEST;
$fun = $p['fun'];

//user login
if ($fun == "admin_login") {
    $pass = $p['password'];
    // $pass = md5($p['password']);

    $sql = "SELECT * FROM admin where email='" . $p['email'] . "' and password='$pass'";
    $row = $db->query($sql);
    $row = $row->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $_SESSION['adminemail'] = $row['email'];
        $_SESSION['adminname'] = $row['name'];
        $_SESSION['admincontact'] = $row['contact'];
        $_SESSION['adminid'] = $row['id'];

        $_SESSION['Swal-title'] = "Login successfully";
        $_SESSION['Swal-icon'] = "success";
        echo "<script>location.href='index';</script>";
    } else {

        $_SESSION['Swal-title'] = "Your data is not match";
        $_SESSION['Swal-icon'] = "error";
        echo "<script>location.href='admin-login';</script>";
    }
}


// Add category
if ($fun == "add_category") {
    //insert query
    $ins = $db->prepare("INSERT INTO category(name, idate) VALUES(:name, :idate)");

    $d['name'] = $p['category'];
    $d['idate'] = date('Y-m-d H:i:s');

    if ($ins->execute($d)) {

        $_SESSION['Swal-title'] = "Category added successfully";
        $_SESSION['Swal-icon'] = "success";
        echo "
            <script>
                location.href = '../../show_categories';
            </script>
            ";
    }
}

// Edit category
if ($fun == "edit_category") {

    $id = $p["cid"];
    $currentDate = date('Y-m-d H:i:s');
    $up = $db->prepare("UPDATE category SET name = '" . $p['category'] . "',udate='$currentDate' where id='$id'");
    if ($up->execute()) {
        $_SESSION['Swal-title'] = "Your question is updated successfully";
        $_SESSION['Swal-icon'] = "success";
    } else {

        $_SESSION['Swal-title'] = "Something went wrong";
        $_SESSION['Swal-icon'] = "error";
    }
    echo "<script>location.href='../../show_categories';</script>";
}

if ($fun == "change_pwd") {
    $val = $_POST["val"];
    $adminid = $_SESSION['adminid'];

    $up = $db->prepare("update admin set password='$val' WHERE id='$adminid'");
    $up->execute();
}

if($fun == "contact_reply"){
    if (!empty($_POST["id"])) {
        $val = $_POST["val"];
        $id = $_POST["id"];

        $up = $db->prepare("update contact set solution='$val' WHERE id='$id'");
        $up->execute();
    }
}
