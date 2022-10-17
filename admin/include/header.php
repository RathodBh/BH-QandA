<?php
session_start();
include('../include/conn.php');
if (!isset($_SESSION['adminemail'])) {
    $_SESSION['Swal-title'] = "Login required";
    $_SESSION['Swal-icon'] = "warning";
    echo "<script>
    setTimeout(()=>{
    location.href='logout.php';
    }, 1000);
    </script>";
}
$categoriesArray = ["All Categories", "Verified Categories", "Unverified Categories"];
$questionsArray = ["All Questions", "Verified Questions", "Unverified Questions", "Show Answer"];
$contactArray = ["All Queries", "Completed Queries", "Pending Queries"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fontawesome-free-5.9.0-web/css/all.min.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="../package/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div id="type_d">
    </div>
    <header class="header" style="z-index: 100">
        <button class="menu-icon-btn ms-2" data-menu-icon-btn>
            <i class="fa fa-bars fa-2x"></i>
        </button>
        <h3 class="text-success ms-4 my-auto"><span class="text-danger">Q</span>and<span class="text-danger">A</span>
        </h3>
        <div class="dropdown dropstart ms-auto">
            <!-- dropstart -->
            <button type="button" class="btn  ms-auto d-flex justify-content-center align-items-center border border-dark" data-bs-toggle="dropdown">
                <i class="fa fa-user-tie me-2"></i>
                ADMIN
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="edit-profile.php">My Profile</a></li>
                <li><a type="button" class="dropdown-item" onclick="changePassword()">Change password</a></li>
                <li><a class="dropdown-item" href="index.php?logout='true'">Logout</a></li>
            </ul>
        </div>
        <!-- <button class="btn btn-transparent ms-auto"><i class="fa fa-user-tie fs-23 me-2"></i> <span
        class="h5">Admin</span></button> -->
    </header>
    <div class="container m-0 mw-100 p-0">
        <aside class="sidebar shadow" data-sidebar>
            <div class="top-sidebar">
                <a href="#" class="channel-logo"><img src="../img/q_and_a.jpg" alt="Channel Logo" style="object-fit:cover"></a>
                <div class="hidden-sidebar your-channel">ADMIN</div>
                <div class="hidden-sidebar channel-name">QandA website</div>
            </div>
            <div class="middle-sidebar">
                <ul class="sidebar-list">
                    <li class="sidebar-list-item <?php if ($title == "Admin Dashboard") { ?> active <?php } ?>">
                        <a href="index" class="sidebar-link">
                            <i class="fa fa-home fs-23"></i>
                            <div class="hidden-sidebar">Dashboard</div>
                        </a>
                    </li>
                    <li class="sidebar-list-item <?php if (in_array($title, $categoriesArray)) { ?> active <?php } ?>">
                        <a href="#" class="sidebar-link" type="button" data-bs-toggle="collapse" data-bs-target="#categories" aria-expanded="false" aria-controls="categories">

                            <i class="fa fa-clone fs-23"></i>
                            <div class="hidden-sidebar">Category</div>
                        </a>

                        <div class="collapse " id="categories">
                            <a href="#" class="sidebar-link" onclick="modal('add_category')">
                                <i class="fa fa-plus fs-23"></i>
                                <div class="hidden-sidebar">Add</div>
                            </a>
                            <a href="show_categories.php?verify=true" class="sidebar-link">
                                <i class="fa fa-check fs-23"></i>
                                <div class="hidden-sidebar">Verified</div>
                            </a>
                            <a href="show_categories.php?unverify=true" class="sidebar-link">
                                <i class="fa fa-exclamation-circle fs-23"></i>
                                <div class="hidden-sidebar">Unverified</div>
                            </a>
                            <a href="show_categories" class="sidebar-link ">
                                <i class="fa fa-eye fs-23"></i>
                                <div class="hidden-sidebar">Show</div>
                            </a>
                        </div>
                    </li>

                    <li class="sidebar-list-item <?php if (in_array($title, $questionsArray)) { ?> active <?php } ?>">
                        <a href="#" class="sidebar-link" type="button" data-bs-toggle="collapse" data-bs-target="#questions" aria-expanded="false" aria-controls="questions">
                            <i class="fa fa-question fs-23"></i>
                            <div class="hidden-sidebar">Questions</div>
                        </a>
                        <div class="collapse" id="questions">
                            <a href="show_questions.php?verify=true" class="sidebar-link">
                                <i class="fa fa-check fs-23"></i>
                                <div class="hidden-sidebar">Verified</div>
                            </a>
                            <a href="show_questions.php?unverify=true" class="sidebar-link">
                                <i class="fa fa-exclamation-circle fs-23"></i>
                                <div class="hidden-sidebar">Unverified</div>
                            </a>
                            <a href="show_questions" class="sidebar-link ">
                                <i class="fa fa-eye fs-23"></i>
                                <div class="hidden-sidebar">All</div>
                            </a>
                        </div>
                    </li>
                    <!-- <li class="sidebar-list-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa fa-reply fs-23"></i>
                            <div class="hidden-sidebar">Answers</div>
                        </a>
                    </li> -->
                    <li class="sidebar-list-item <?php if ($title == "Show Users") { ?> active <?php } ?>">
                        <a href="users" class="sidebar-link">
                            <i class="fa fa-user fs-23"></i>
                            <div class="hidden-sidebar">Users</div>
                        </a>
                    </li>
                    <li class="sidebar-list-item <?php if (in_array($title, $contactArray)) { ?> active <?php } ?>">
                        <a href="#" class="sidebar-link" type="button" data-bs-toggle="collapse" data-bs-target="#contact" aria-expanded="false" aria-controls="contact">
                            <i class="fa fa-sticky-note fs-23"></i>
                            <div class="hidden-sidebar">Contact Us</div>
                        </a>
                        <div class="collapse" id="contact">
                            <a href="contact_us.php?verify=true" class="sidebar-link ">
                                <i class="fa fa-check fs-23"></i>
                                <div class="hidden-sidebar">Completed</div>
                            </a>
                            <a href="contact_us.php?unverify=true" class="sidebar-link">
                                <i class="fa fa-exclamation-circle fs-23"></i>
                                <div class="hidden-sidebar">Pending</div>
                            </a>
                            <a href="contact_us" class="sidebar-link">
                                <i class="fa fa-eye fs-23"></i>
                                <div class="hidden-sidebar">All</div>
                            </a>
                        </div>
                        <!--
                        <a href="contact_us" class="sidebar-link">
                            <i class="fa fa-sticky-note fs-23"></i>
                            <div class="hidden-sidebar">Contact Us</div>
                        </a> -->
                    </li>

                </ul>
            </div>
            <div class="bottom-sidebar">
                <ul class="sidebar-list">
                    <li class="sidebar-list-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa fa-toolbox fs-23"></i>
                            <div class="hidden-sidebar">Settings</div>
                        </a>
                    </li>
                    <li class="sidebar-list-item">
                        <a href="#" class="sidebar-link">

                            <div class="hidden-sidebar">Send Feedback</div>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="content w-100">