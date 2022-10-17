<?php
session_start();
error_reporting(0);
$title = "Homepage";
include("include/header.php");
?>


<!-- home  -->
<div class="div setHeight" id="home">
    <div class="w-100 h-100 container-fluid p-4 ">
        <div class="row d-flex justify-content-around">
            <div class="col-lg-5 col-md-5">
                <h1 class="home-title mb-4 pt-lg-3 pt-0 mt-0">Every Question Has An Answer</h1>
                <button class="btn btn-outline-primary px-3 rounded-pill myhover" onclick="modal('add-question')">Ask a Question</button>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="bg w-100 d-flex align-items-end ">
                    <!-- <img src="./img/Seminar-amico.png" alt="" class="img-fluid"> -->
                    <div class="my-home-img"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid questions-tab my-1">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-12 questions-side p-2 order-lg-1 order-md-1 order-sm-1 order-2">
            <div class="container-fluid py-3 shadow">
                <!-- 4 square -->
                <div class="row d-flex justify-content-evenly my-2">
                    <div class="col-lg-5 col-md-5 col-sm-2 col-5 square bg-light rounded border shadow d-flex justify-content-center align-items-center flex-column border-bottom-primary my-2">
                        <a href="questions">

                            <?php
                            $rowQ = $db->query("SELECT count(*) FROM questions WHERE ispoll='0'");
                            $total_no_of_que = $rowQ->fetchColumn();
                            ?>
                            <h5 class="text-primary"> Questions
                            </h5>
                            <h1 class="text-dark text-center"><?= $total_no_of_que; ?></h1>
                        </a>

                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-2 col-5 square bg-light rounded border shadow d-flex justify-content-center align-items-center flex-column border-bottom-success my-2">
                        <?php
                        $rowQ = $db->query("SELECT count(*) FROM answers");
                        $total_no_of_ans = $rowQ->fetchColumn();
                        ?>
                        <h5 class="text-success">Answers</h5>
                        <h1 class="text-dark"><?= $total_no_of_ans; ?></h1>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-2 col-5 square bg-light rounded border shadow d-flex justify-content-center align-items-center flex-column border-bottom-info my-2">
                        <?php
                        $rowQ = $db->query("SELECT count(*) FROM users");
                        $total_no_of_users = $rowQ->fetchColumn();
                        ?>
                        <h5 class="text-info">Users</h5>
                        <h1 class="text-dark"><?= $total_no_of_users; ?></h1>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-2 col-5 square bg-light rounded border shadow d-flex justify-content-center align-items-center flex-column border-bottom-danger my-2">
                        <?php
                        $rowQ = $db->query("SELECT count(*) FROM questions WHERE ispoll='1'");
                        $total_no_of_polls = $rowQ->fetchColumn();
                        ?>
                        <h5 class="text-danger">Polls</h5>
                        <h1 class="text-dark"><?= $total_no_of_polls; ?></h1>
                    </div>
                </div>

                <!-- Top member  -->
                <div class="row my-4 mx-lg-0 mx-md-0 mx-sm-4">
                    <div class="col-12 p-0">
                        <div>
                            <i class="fa fa-users pe-3"></i>
                            Top Members
                        </div>
                        <?php
                        $topMember = "SELECT * FROM users ORDER BY points DESC LIMIT 5";
                        $topMemberRes = $db->prepare($topMember);
                        $topMemberRes->execute();

                        foreach ($topMemberRes as $d) {

                            $sql = "SELECT count(*) FROM questions where uid='" . $d['id'] . "'";
                            $row = $db->query($sql);
                            $no_of_que = $row->fetchColumn();
                        ?>
                            <div class="d-flex flex-column my-2 shadow p-2">
                                <div class="container-fluid gx-0">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 pe-0">
                                            <h5 class="text-primary h6"><?= $d["name"] ?></h5>
                                            <p class="text-secondary text-sm mb-0">
                                                <span class="text-dark h6">
                                                    <?= $no_of_que; ?>
                                                </span> Questions <span class="px-2">
                                                    <span class="text-dark h6">
                                                        <?= $d["points"] ?>
                                                    </span>

                                                    points</span>
                                            </p>
                                            <span class="bg-warning px-1">Englightened</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-12 questions-main p-2 order-lg-2 order-md-2 order-sm-2 order-1">
            <div class="container-fluid py-3 shadow">
                <ul class="nav nav-tabs">
                    <li class="nav-item dropdown d-block d-sm-block d-md-none d-lg-none d-xl-none">
                        <button id="btnChange" class="nav-link dropdown-toggle btn btn-outline-primary" data-bs-toggle="dropdown">Recent Questions</button>
                        <ul class="dropdown-menu nav-item">
                            <li><a class="dropdown-item nav-link myDropDown" href="#home2" data-bs-toggle="tab">Recent Questions</a></li>
                            <li><a class="dropdown-item nav-link myDropDown" href="#menu1" data-bs-toggle="tab">Most Answered</a></li>
                            <li><a class="dropdown-item nav-link myDropDown" href="#menu2" data-bs-toggle="tab">Most visited</a></li>
                        </ul>
                    </li>
                    <li class="nav-item d-none d-sm-none d-md-block d-lg-block d-xl-block">
                        <a href="#home2" class="nav-link active" data-bs-toggle="tab">
                            Recent Questions
                        </a>
                    </li>
                    <li class="nav-item  d-none d-sm-none d-md-block d-lg-block d-xl-block">
                        <a href="#menu1" class="nav-link " data-bs-toggle="tab">
                            Most Answered
                        </a>
                    </li>
                    <li class="nav-item d-none d-sm-none d-md-block d-lg-block d-xl-block">
                        <a href="#menu2" class="nav-link " data-bs-toggle="tab">
                            Most visited
                        </a>
                    </li>
                </ul>

                <!-- tab panes -->
                <div class="tab-content gx-1">
                    <div class="tab-pane container-fluid active" id="home2">
                        <div class="container-fluid">
                            <?php
                            $recentQue = $db->prepare("SELECT questions.*, users.name,c.name as cat,users.id as uid FROM questions JOIN users ON questions.uid = users.id JOIN category c Where questions.cid=c.id ORDER BY idate DESC LIMIT 5");
                            $recentQue->execute();
                            foreach ($recentQue as $b) {
                                $noOfAns = $db->query("SELECT count(*) FROM answers WHERE qid = '" . $b['id'] . "'");
                                $noOfA = $noOfAns->fetchColumn();
                            ?>
                                <div class="row d-flex justify-content-evenly shadow my-3">
                                    <div class="col">
                                        <div class="d-flex align-items-lg-end align-items-sm-end flex-lg-row flex-sm-row flex-column mt-2">
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
                                            <h3><a href="answers.php?id=<?= $b['id'] ?>" class="text-dark"><?= $b["question"] ?></a></h3>
                                            <p class="text-secondary"><?= $b["descr"] ?></p>
                                        </div>

                                        <div class="d-flex justify-content-between flex-lg-row flex-sm-column flex-column p-2">
                                            <div class="d-flex flex-lg-row flex-sm-column flex-column">
                                                <a href="answers.php?id=<?= $b['id'] ?>" class="btn btn-outline-dark px-3 m-1">
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
                                            <button class="btn btn-dark px-3 ms-1 my-1" onclick="modal('add-answer.php',<?= $b['id'] ?>)"> Add Answer</button>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="tab-pane container fade" id="menu1">
                        Hello
                    </div>
                    <div class="tab-pane container fade" id="menu2">
                        Hello2
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //    alert('Data inserted successfully...');
    // Swal.fire('Good','clicked','success')

    // function blank() {
    //     Swal.fire({
    //         title: "Oops!",
    //         text: "Please enter Email ID and password!",
    //         icon: "warning",
    //     });
    // }

    // let btnChange = document.querySelector('#btnChange');
    // let myDropDown = document.querySelectorAll('.myDropDown');
    // myDropDown.forEach(element => {
    //     element.addEventListener("click", (curr) => {
    //         btnChange.innerText = curr.target.innerText;
    //     })
    // })
</script>

<?php

include("include/footer.php");
?>