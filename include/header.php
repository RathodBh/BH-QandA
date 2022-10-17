<?php
include("conn.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fontawesome-free-5.9.0-web/css/all.min.css">

    <link rel="stylesheet" href="package/dist/sweetalert2.all.min.css">
    <link rel="stylesheet" href="./css/style.css">

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />


</head>

<body>
    <!-- go to top -->
    <a class="btn btn-primary mt-5" id="gotoTop" href="#extra"><i class="fa fa-arrow-up"></i></a>


    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="header">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">ASK ME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($title == 'Homepage') { ?> active <?php } ?>" href="index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($title == 'Questions') { ?> active <?php } ?>" href="questions.php">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($title == 'Polls') { ?> active <?php } ?>" href="polls.php">Polls</a>
                    </li>
                    <?php
                    if (isset($_SESSION["uid"])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($title == 'My Questions') { ?> active <?php } ?>" href="my-questions">My Questions</a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($title == 'Contact us') { ?> active <?php } ?>" href="contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($title == 'About us ') { ?> active <?php } ?>" href="javascript:void(0)">About</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <!-- <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" oninput="b=this.value">   `
                        <button class="input-group-text btn btn-primary " onclick="location.href='questions.php?search='+b"><i class="fa fa-search"></i></button>
                    </div> -->
                    <?php
                    if (isset($_SESSION["username"])) {
                    ?>
                        <div class="dropdown dropstart">
                            <!-- dropstart -->
                            <button type="button" class="btn btn-light ms-2 d-flex justify-content-center align-items-center" data-bs-toggle="dropdown">
                                <i class="fa fa-user me-2"></i>
                                <?= $_SESSION["username"] ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="edit-profile.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="change-password.php">Change password</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php
                    } else {
                    ?>
                        <input type="button" value="Login" class="btn btn-primary ms-2" onclick="modal('user-login')">
                    <?php } ?>
                </form>
            </div>
        </div>
    </nav>

    <div class="extra" id="extra">

    </div>
    <div id="type_d"></div>