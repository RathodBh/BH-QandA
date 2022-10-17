<?php
$title = "Answers";
include('include/header.php');
include('include/conn.php');
error_reporting(0);
session_start();

$qid = $_GET["id"];
$uid = $_SESSION['uid'];
//update views of this question
$up = $db->prepare("UPDATE questions SET views = views + 1 WHERE id='$qid' and uid != '$uid'");
$up->execute();

if (isset($_GET["best"])) {
    $best = $_GET["best"];

    if ($best == '0') {
        $best = '1';

        $_SESSION["Swal-title"] = "Answer added to best answer";
        $_SESSION['Swal-icon'] = "success";
    } else {
        $best = '0';

        $_SESSION["Swal-title"] = "Answer removed from best answer";
        $_SESSION['Swal-icon'] = "success";
    }
    $up = $db->prepare("UPDATE answers SET best ='$best' where id='" . $_GET['aid'] . "' ");
    if ($up->execute()) {
        echo "<script>window.history.back();</script>";
    }
}
// if (isset($_GET["like"])) {
//     $vote = $_GET["like"];

//     $_SESSION["Swal-title"] = "Your like is added";
//     $_SESSION['Swal-icon'] = "success";

//     $ins = $db->prepare("INSERT INTO likes(aid,likes,uid) VALUES(:aid,'1','$uid')");
//     $d['aid'] = $vote;
//     if ($ins->execute($d)) {
//         echo "<script>window.history.back();</script>";
//     }
// }
?>
<div class="container-lg my-3">
    <div class="row">
        <?php
        $qid = $_GET["id"];
        $ans = $db->query("SELECT questions.*,users.name as uname, category.name as cname,users.id as uid FROM questions JOIN users ON questions.uid=users.id JOIN category ON questions.id='$qid' ");
        $ansVal = $ans->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="col-12">

            <div class="row d-flex justify-content-evenly shadow my-3">
                <div class="col">
                    <div class="d-flex align-items-lg-end align-items-sm-end flex-lg-row flex-sm-row flex-column mt-2">
                        <?php
                        if ($uid == $ansVal["uid"]) {
                        ?>
                            <h5 class="text-primary px-2 ">
                                Your Question
                            </h5>
                        <?php } else { ?>
                            <h6 class="text-secondary px-2 ">Asked by:
                                <span class="text-primary h5"><?= $ansVal["uname"] ?></span>
                            </h6>
                        <?php } ?>
                        <h6 class="text-secondary px-2">asked date: <span class="text-primary"><?= $ansVal['idate'] ?></span></h6>
                        <?php
                        if ($ansVal['udate'] != NULL) { ?>
                            <h6 class="text-secondary px-2">updated on: <span class="text-primary"><?= $ansVal['udate'] ?></span></h6>
                        <?php } ?>
                        <h6 class="text-dark px-2 border ms-2" style="background-color: rgba(0,0,0,0.1)">
                            <?= $ansVal["cname"] ?>
                        </h6>
                    </div>
                    <div class="d-flex flex-column px-2">
                        <h3><?= $ansVal["question"] ?></h3>

                        <p class="text-secondary"><?= $ansVal["descr"] ?></p>
                    </div>

                    <hr class="my-2">

                    <div class="d-flex justify-content-between">
                        <h3 class="text-success ms-3">Answers</h3>
                        <?php
                        if ($uid != $ansVal["uid"]) {
                        ?>
                            <button class="btn btn-primary" onclick="modal('add-answer',<?= $qid ?>)">Add answer</button>
                        <?php } ?>
                    </div>

                    <div class="answers w-100 p-2">
                        <?php
                        $row = $db->prepare("SELECT answers.*, users.name as uname FROM answers JOIN users ON answers.uid = users.id  WHERE qid = '$qid' ORDER BY answers.best DESC");
                        $row->execute();
                        $ansCount = $row->rowCount();
                        if ($ansCount == '0') {
                        ?>
                            <h6 class="text-danger text-center">No answers found</h6>
                        <?php
                        }
                        foreach ($row as $r) {

                        ?>
                            <div class="shadow p-3 my-2 border <?php if ($r["best"] == "1") { ?> border-primary border-2 <?php } else { ?> border-secondary <?php } ?>">
                                <h5 class="text-primary"><?= $r["answer"]; ?></h5>
                                <h6 class="text-secondary"><?= $r["descr"] ?></h6>
                                <h6 class="border d-inline px-3" style="background:rgba(0,0,0,0.1)"><?= $r["uname"] ?> </h6><span class="ms-3"><?= $r["idate"] ?></span>

                                <?php
                                // $noOfLikes = $db->query("SELECT count(*) FROM likes");
                                // $noOfL = $noOfLikes->fetchColumn();
                                if (isset($_SESSION['uid'])) {
                                    if ($_SESSION["uid"] == $ansVal["uid"]) {
                                        print_r($_SESSION["uid"]);
                                        print_r($ansVal["uid"]);
                                ?>
                                        <!--<a href="" class="ms-3 float-end px-2 border">
                                             <span class="text-primary"><?= $noOfL ?></span>
                                             <span class="text-dark">like</span>
                                             <i class="fa fa-thumbs-up"></i></a> -->
                                        <?php
                                        if ($r["best"] == '1') {
                                        ?>

                                            <a class="mx-3 float-end text-danger border px-2 " href="answers.php?id=<?= $qid ?>&aid=<?= $r["id"] ?>&best=<?= $r["best"] ?>&que='my'">Remove</a>
                                            <button class="ms-3 float-end text-primary border px-2 bg-primary text-light" style="background:rgba(0,0,0,0.1)"> Best answer</button>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="ms-3 float-end" href="answers.php?id=<?= $qid ?>&aid=<?= $r["id"] ?>&best=<?= $r["best"] ?>&que='my'">Select to Best answer</a>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <!--  -->
                                        <a href="answers.php?like=<?= $r['id'] ?>" class="ms-3 float-end px-2 border">
                                            <!-- <span class="text-primary"><?= $noOfL ?></span>
                                            Votes <i class="fa fa-thumbs-up"></i></a> -->
                                        <?php
                                    }
                                } else {
                                        ?>
                                        <button class="ms-3 float-end px-2 border">
                                            <!-- <span class="text-primary"><?= $noOfL ?></span>
                                        like <i class="fa fa-thumbs-up"></i></button> -->
                                            <?php
                                            if ($r["best"] == '1') {
                                            ?>
                                                <button class="ms-3 float-end text-primary border px-2 bg-primary text-light" style="background:rgba(0,0,0,0.1)"> Best answer</button>
                                        <?php
                                            }
                                        }
                                        ?>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col p-0">
                    <a class="btn btn-primary" href="questions"><i class="fa fa-arrow-left"></i> Go back</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('include/footer.php');
?>
<script>
    // function updateBestAns(val) {
    //     $.ajax({
    //         type: "POST",
    //         url: "update_best_answer.php",
    //         data: 'aid=' + val,
    //         success: function(data) {
    //             alert(data)

    //             // $("#doctor").html(data);
    //         }
    //     });
    // }
</script>