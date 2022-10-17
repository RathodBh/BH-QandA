<?php
$title = "Polls";
include('include/header.php');
?>

<div class="container-lg my-3">
    <div class="row">
        <div class="col-6">
            <h2 class="text-primary mb-2">Polls</h2>
        </div>
        <div class="col-6">
            <div class="input-group">

                <input type="text" class="form-control" placeholder="Search" oninput="a=this.value">
                <button onclick="location.href='questions.php?search='+a" class="input-group-text btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['search'])) {
        $s = $_GET["search"];
        $questions = $db->query("SELECT DISTINCT questions.*, users.name,c.name as cat,users.id as uid FROM questions INNER JOIN users ON questions.uid = users.id INNER JOIN category c ON questions.question LIKE CONCAT('%','$s','%') or questions.descr LIKE CONCAT('%','$s','%')  Where questions.cid=c.id and questions.ispoll='1'");
        $questions->execute();
        $count = $questions->rowCount();
        ?>
        <div class="row">
            <hr>
        </div>
        <div class='row'>
            <h6 class='text-success text-center'> <?= $count ?> Result found(s)
                <a href="questions" class="btn-close ms-2"></a>
            </h6>
        </div>
    <?php

    } else {
        $questions = $db->prepare("SELECT questions.*, users.name,c.name as cat,users.id as uid FROM questions JOIN users ON questions.uid = users.id  JOIN category c Where questions.cid=c.id and questions.ispoll='1'");
        $questions->execute();
    }

    foreach ($questions as $b) {
        $noOfAns = $db->query("SELECT count(*) FROM answers WHERE qid = '" . $b['id'] . "' and verify='1'");
        $noOfA = $noOfAns->fetchColumn();
        ?>

        <div class="row d-flex justify-content-evenly shadow my-3 border <?php if (isset($_SESSION["uid"])) {
            if (($_SESSION["uid"] == $b["uid"])) { ?> border-primary border-1 <?php }
            } else { ?> border-secondary <?php } ?>">
            <div class="col">
                <div class="d-flex align-i  tems-lg-end align-items-sm-end flex-lg-row flex-sm-row flex-column mt-2">
                    <h5 class="text-primary px-2"><?php if (isset($_SESSION["uid"])) {
                        if ($_SESSION["uid"] == $b["uid"]) { ?>
                                Your Question <?php } else {
                                    echo  $b['name'];
                                }
                    } else {
                        echo  $b['name'];
                    }
        ?></h5>
                    <h6 class="text-secondary px-2">Asked: <span class="text-primary"><?= $b['idate'] ?></span></h6>
                    <h6 class="text-dark px-2 border ms-2" style="background-color: rgba(0,0,0,0.1)">
                        <?= $b["cat"] ?>
                    </h6>
                </div>
                <div class="d-flex flex-column px-2">
                    <h3><?= $b["question"] ?></h3>
                </div>

                <div class="w-50 px-2">

                    <!-- <input type="hidden" name="qid" id="<?= $b["id"] ?>" value="<?= $b["id"] ?>"> -->
                    <input type="radio" name="options" id="op1<?= $b["id"] ?>" value="<?= $b['op1'] ?>" class="d-none optionRadio"  onclick="setPoll(<?= $b['id'] ?>,this.value,this.id)">
                    <input type="radio" name="options" id="op2<?= $b["id"] ?>" value="<?= $b['op2'] ?>" class="d-none optionRadio" onclick="setPoll(<?= $b['id'] ?>,this.value,this.id)">
                    <input type="radio" name="options" id="op3<?= $b["id"] ?>" value="<?= $b['op3'] ?>" class="d-none optionRadio" onclick="setPoll(<?= $b['id'] ?>,this.value,this.id)">
                    <input type="radio" name="options" id="op4<?= $b["id"] ?>" value="<?= $b['op4'] ?>" class="d-none optionRadio" onclick="setPoll(<?= $b['id'] ?>,this.value,this.id)">

                    <label class="progress my-2" style="height:25px;cursor:pointer" for="op1<?= $b["id"] ?>">
                        <div class="pregress-bar bg-warning text-dark ps-4 d-flex align-items-center" style="width: 25%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" >
                            <?= $b["op1"] ?>
                        </div>
                    </label>
                    <label class="progress my-2" style="height:25px;cursor:pointer" for="op2<?= $b["id"] ?>">
                        <div class="pregress-bar bg-warning text-dark ps-4 d-flex align-items-center" style="width: 25%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" >
                            <?= $b["op2"] ?>
                        </div>
                    </label>
                    <label class="progress my-2" style="height:25px;cursor:pointer" for="op3<?= $b["id"] ?>">
                        <div class="pregress-bar bg-warning text-dark ps-4 d-flex align-items-center" style="width: 25%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" >
                            <?= $b["op3"] ?>
                        </div>
                    </label>
                    <label class="progress my-2" style="height:25px;cursor:pointer" for="op4<?= $b["id"] ?>">
                        <div class="pregress-bar bg-warning text-dark ps-4 d-flex align-items-center" style="width: 25%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" >
                            <?= $b["op4"] ?>
                        </div>
                    </lab>
                </div>
                
                <!-- <div class="d-flex justify-content-between flex-lg-row flex-sm-column flex-column p-2">
                    <div class="d-flex flex-lg-row flex-sm-column flex-column">
                        <a href="answers.php?id=<?= $b["id"] ?>" class="btn btn-outline-dark px-3 m-1">
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
                    <?php if (isset($_SESSION["uid"])) {
                        if ($_SESSION["uid"] == $b["uid"]) { ?>
                            <button class="btn btn-dark px-3 ms-1 my-1" onclick="modal('edit-question.php',<?= $b['id'] ?>)">Edit</button>
                        <?php } else {
                            ?>
                            <button class="btn btn-dark px-3 ms-1 my-1" onclick="modal('add-answer.php',<?= $b['id'] ?>)"> Add Answer</button>
                        <?php
                        }
                    } else { ?>
                        <button class="btn btn-dark px-3 ms-1 my-1" onclick="modal('add-answer.php',<?= $b['id'] ?>)"> Add Answer</button>
                    <?php
                    } ?>
                </div> -->

            </div>
        </div>
    <?php }
    ?>

</div>
<?php
include('include/footer.php');
?>
