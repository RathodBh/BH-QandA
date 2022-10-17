<?php
$title = "My Questions";
include('include/header.php');
include('include/check-login.php');
$uid =  $_SESSION["uid"];

?>

<div class="container-lg my-3">
    <div class="row">
        <div class="col-6">
            <h2 class="text-primary mb-2">My Questions</h2>
        </div>
        <div class="col-6">
            <div class="input-group">

                <input type="text" class="form-control" placeholder="Search" oninput="a=this.value">
                <button onclick="location.href='my-questions.php?search='+a" class="input-group-text btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>

    <?php

    if (isset($_GET['search'])) {
        $s = $_GET["search"];
        $recentQue = $db->query("SELECT DISTINCT questions.*, users.name,users.id as uid,c.name as cat FROM questions INNER JOIN users  ON questions.uid = '$uid' and users.id='$uid' and users.id=questions.uid  INNER JOIN category c ON c.id = questions.cid and (questions.question LIKE CONCAT('%','$s','%') or questions.descr LIKE CONCAT('%','$s','%')) WHERE uid = '$uid' and questions.uid = '$uid'");
        $recentQue->execute();
        $count = $recentQue->rowCount();
    ?>
        <div class="row">
            <hr>
        </div>
        <div class='row'>
            <h6 class='text-success text-center'> <?= $count ?> Result found(s)<a href="my-questions" class="btn-close ms-2"></a></h6>

        </div>
    <?php

    } else {

        $recentQue = $db->prepare("SELECT DISTINCT questions.*, users.name,c.name as cat FROM questions JOIN users ON questions.uid = '$uid' and users.id='$uid' and users.id=questions.uid  JOIN category c ON c.id = questions.cid WHERE users.id = '$uid' and questions.uid = '$uid'");
        $recentQue->execute();
    }

    foreach ($recentQue as $b) {
        $noOfAns = $db->query("SELECT count(*) FROM answers WHERE qid = '" . $b['id'] . "'");
        $noOfA = $noOfAns->fetchColumn();
    ?>
        <div class="row d-flex justify-content-evenly shadow my-3">
            <div class="col">
                <div class="d-flex align-items-lg-end align-items-sm-end flex-lg-row flex-sm-row flex-column mt-2">
                    <h6 class="text-dark px-2 border mx-2" style="background-color: rgba(0,0,0,0.1)">
                        <?= $b["cat"] ?>
                    </h6>
                    <h6 class="text-secondary px-2">Asked: <span class="text-primary"><?= $b['idate'] ?></span></h6>
                    <?php
                    if ($b["udate"] != NULL) {
                    ?>
                        <h6 class="text-secondary px-2">updated: <span class="text-primary">
                                <?= $b['udate'] ?></span></h6>
                    <?php } ?>

                </div>
                <div class="d-flex flex-column px-2">
                    <h3><?= $b["question"] ?></h3>
                    <p class="text-secondary"><?= $b["descr"] ?></p>
                </div>

                <div class="d-flex justify-content-between flex-lg-row flex-sm-column flex-column p-2">
                    <div class="d-flex flex-lg-row flex-sm-column flex-column">
                        <a href="answers.php?id=<?= $b["id"]; ?>&que='my'" class="btn btn-outline-dark px-3 m-1">
                            <i class="fa fa-comment-alt"></i>
                            <span class="px-1">
                                <?php
                                if ($noOfA == '0') {
                                ?>
                                    No
                                <?php
                                } else {
                                ?>
                                <?php
                                    echo $noOfA;
                                } ?>

                                Answers</span>
                        </a>
                        <button class="btn btn-outline-dark px-3 m-1">
                            <i class="fa fa-eye"></i>
                            <span class="px-1">
                                <?php
                                if ($b["views"] == '0') {
                                ?>
                                    No
                                <?php
                                } else {
                                ?>
                                <?php
                                    echo $b["views"];
                                } ?>
                                Views</span>
                        </button>
                    </div>
                    <button class="btn btn-dark px-3 ms-1 my-1" onclick="modal('edit-question.php',<?= $b['id'] ?>)"> EDIT</button>
                </div>

            </div>
        </div>
    <?php }
    ?>

</div>
<?php
include('include/footer.php');
?>