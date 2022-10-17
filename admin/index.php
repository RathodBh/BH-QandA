<?php
session_start();
error_reporting(0);
$title = "Admin Dashboard";
include('include/header.php');
if ($_GET['logout']) {
    $_SESSION['Swal-title'] = "Logout successfully";
    $_SESSION['Swal-icon'] = "success";
    echo "<script>
    setTimeout(()=>{
    location.href='logout';
    }, 700);
    </script>";
}

$usersQ = $db->query("SELECT count(*) FROM users");
$totUsers = $usersQ->fetchColumn();

$questionsQ = $db->query("SELECT count(*) FROM questions WHERE ispoll='0'");
$totQuestions = $questionsQ->fetchColumn();

$questionsQ = $db->query("SELECT count(*) FROM questions WHERE ispoll='0'");
$totQuestions = $questionsQ->fetchColumn();

$ansQ = $db->query("SELECT count(*) FROM answers WHERE a1 is NULL and a2 is NULL and a3 is NULL and a4 is NULL");
$totAns = $ansQ->fetchColumn();

$catQ = $db->query("SELECT count(*) FROM category");
$totCat = $catQ->fetchColumn();

$pollQ = $db->query("SELECT count(*) FROM questions WHERE ispoll='1'");
$totPoll = $pollQ->fetchColumn();

$pollAQ = $db->query(
    "SELECT count(*) FROM answers WHERE a1 is not NULL or a2 is not NULL or a3 is not NULL or a4 is not NULL"
);
$totPollAns = $pollAQ->fetchColumn();
?>

<div class="container-fluid my-3">
    <div class="row d-flex justify-content-around">
        <div class="col-lg-3 shadow d-flex justify-content-between align-items-center h3 p-4" style="aspect-ratio:16/9">
            <div class="dv d-flex flex-column">
                <span class="h1 text-center mb-3 counter-nums" data-val="<?= $totUsers ?>">0</span>
                <a href="users" class="text-decoration-none h3">Users</a>
            </div>
            <i class="fa fa-users text-danger fa-3x"></i>
        </div>
        <div class="col-lg-3 shadow d-flex justify-content-between align-items-center h3 p-4" style="aspect-ratio:16/9">
            <div class="dv d-flex flex-column">
                <span class="h1 text-center mb-3 counter-nums" data-val="<?= $totQuestions ?>">0</span>
                <a href="show_questions" class="text-decoration-none h3">Questions</a>
            </div>
            <i class="fa fa-question text-danger fa-3x"></i>
        </div>
        <div class="col-lg-3 shadow d-flex justify-content-between align-items-center h3 p-4" style="aspect-ratio:16/9">
            <div class="dv d-flex flex-column">
                <span class="h1 text-center mb-3 counter-nums" data-val="<?= $totAns ?>">0</span>
                <a href="" class="text-decoration-none h3">Answers</a>
            </div>
            <i class="fa fa-reply text-danger fa-3x"></i>
        </div>
    </div>
    <div class="row d-flex justify-content-around my-5">
        <div class="col-lg-3 shadow d-flex justify-content-between align-items-center h3 p-4" style="aspect-ratio:16/9">
            <div class="dv d-flex flex-column">
                <span class="h1 text-center mb-3 counter-nums" data-val="<?= $totCat ?>">0</span>
                <a href="show_categories" class="text-decoration-none h3">Category</a>
            </div>
            <i class="fa fa-clone text-danger fa-3x"></i>
        </div>
        <div class="col-lg-3 shadow d-flex justify-content-between align-items-center h3 p-4" style="aspect-ratio:16/9">
            <div class="dv d-flex flex-column w-50">
                <span class="h1 text-center mb-3 counter-nums" data-val="<?= $totPoll ?>">0</span>
                <a href="" class="text-decoration-none h3 text-center">Polls</a>
            </div>
            <i class="fa fa-poll-h text-danger fa-3x"></i>
        </div>
        <div class="col-lg-3 shadow d-flex justify-content-between align-items-center h3 p-4" style="aspect-ratio:16/9">
            <div class="dv d-flex flex-column w-50">
                <span class="h1 text-center mb-3 counter-nums" data-val="<?= $totPollAns ?>">0</span>
                <a href="" class="text-decoration-none h3 text-center">Polls Ans</a>
            </div>
            <i class="fa fa-vote-yea text-danger fa-3x"></i>
        </div>
    </div>
</div>
<?php
include('include/footer.php');
?>