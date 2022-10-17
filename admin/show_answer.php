<?php
error_reporting(0);
if ($_GET["unverify"])
    $title = "Unverified Answer";
else if ($_GET["verify"])
    $title = "Verified Asnwer";
else
    $title = "All Answer";

if ($_GET['id'])
    $qid = $_GET['id'];
include('include/header.php');

$ans = $db->query("SELECT questions.*,users.name as uname, category.name as cname,users.id as uid FROM questions JOIN users ON questions.uid=users.id JOIN category ON questions.id='$qid' ");
$ansVal = $ans->fetch(PDO::FETCH_ASSOC);


?>
<div class="container-lg my-5">
    <div class="row">
        <div class="col">
            <table class="table table-striped mb-5">
                <tr>
                    <th colspan="2" class="text-center text-light bg-primary">Question Info</th>
                </tr>
                <tr>
                    <th class="">Question</th>
                    <td class=""><?= $ansVal["question"]; ?></td>
                </tr>
                <tr>
                    <th class="">Asked By</th>
                    <td class=""><?= $ansVal["uname"]; ?></td>
                </tr>
                <tr>
                    <th class="">Category</th>
                    <td class=""><?= $ansVal["cname"]; ?></td>
                </tr>
                <tr>
                    <th>Asked</th>
                    <td><?= $ansVal["idate"]; ?></td>
                </tr>
                <tr>
                    <th>Updated</th>
                    <td><?= $ansVal["udate"]; ?></td>
                </tr>
            </table>

            <div class="row d-flex justify-content-between align-items-center my-4">
                <h2 class="text-danger col-lg-5">
                    <?= $title; ?>
                </h2>
                <div class="btn-group col-lg-4">
                    <?php if (!$_GET["unverify"]) { ?>
                        <a class="btn btn-success shadow" href="show_answer.php?id=<?= $qid ?>&unverify=true">Unverified answer
                        </a><?php }  ?>
                    <?php if (!$_GET["verify"]) { ?>
                        <a class="btn <?php if ($title == "All Answer") { ?>  btn-primary <?php } else { ?> btn-success<?php } ?> shadow" href="show_answer.php?id=<?= $qid ?>&verify=true">Verified answer</a>
                    <?php } ?>
                    <?php if ($title != "All Answer") { ?>
                        <a class="btn btn-primary shadow" href="show_answer?id=<?= $qid ?>">All</a>
                    <?php } ?>
                </div>

            </div>

            <input type="hidden" id="table_name" value="answers">
            <div class="table-responsive shadow p-3">
                <table class="table table-hover table-striped table-borderless" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Answer</th>
                            <th>Description</th>
                            <th>Ans by</th>
                            <th>Verify</th>
                            <th>Best?</th>
                            <th>Added</th>
                            <th>Updated</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $row = $db->prepare("SELECT answers.*, users.name as uname FROM answers JOIN users ON answers.uid = users.id  WHERE qid = '$qid' ORDER BY answers.best DESC ");

                        $query = "SELECT answers.*, users.name as uname FROM answers JOIN users ON answers.uid = users.id  WHERE qid = '$qid' ";
                        if ($_GET["verify"])
                            $query .= " and answers.verify='1'";
                        else if ($_GET["unverify"])
                            $query .= " and answers.verify='0'";
                        $query .= " ORDER BY answers.best DESC";
                        $row = $db->prepare($query);
                        $row->execute();
                        $cnt = 1;
                        foreach ($row as $r) {
                        ?>
                            <tr>
                                <td><?= $cnt++; ?></td>
                                <td>
                                    <?= $r['answer'] ?>
                                </td>
                                <td><?= $r['descr'] ?></td>
                                <td><?= $r['uname'] ?></td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" <?php if ($r['verify'] == '1') echo "checked"; ?> onchange="updateVerify(<?= $r['id'] ?>)">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" <?php if ($r['best'] == '1') echo "checked"; ?> onchange="updateBest(<?= $r['id'] ?>)">
                                    </div>
                                </td>
                                <td>
                                    <?= date("d-m-Y", strtotime($r['idate'])) ?> <span class='text-success'>
                                        <?= date("h:i A", strtotime($r['idate'])) ?></span>
                                </td>
                                <td>
                                    <?php if ($r['udate']) echo date("d-m-Y", strtotime($r['udate']));
                                    ?>
                                    <span class="text-success">
                                        <?php if ($r['udate']) echo date("h:i A", strtotime($r['udate'])); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <h1 id="best_label"></h1>
            </div>
        </div>
    </div>
</div>
<?php
include('include/footer.php');
?>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>