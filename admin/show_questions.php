<?php
error_reporting(0);
if ($_GET["unverify"])
    $title = "Unverified Questions";
else if ($_GET["verify"])
    $title = "Verified Questions";
else
    $title = "All Questions";
include('include/header.php');

?>
<div class="container-lg my-5">
    <div class="row">
        <div class="col">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-danger col-lg-5">
                    <?= $title; ?>
                </h2>
                <div class="btn-group col-lg-4">
                    <?php if (!$_GET["unverify"]) { ?>
                        <a class="btn btn-success shadow" href="show_questions.php?unverify=true">Unverified Questions
                        </a><?php }  ?>
                    <?php if (!$_GET["verify"]) { ?>
                        <a class="btn <?php if ($title == "All Questions") { ?>  btn-primary <?php } else { ?> btn-success<?php } ?> shadow" href="show_questions.php?verify=true">Verified Questions</a>
                    <?php } ?>
                    <?php if ($title != "All Questions") { ?>
                        <a class="btn btn-primary shadow" href="show_questions">All</a>
                    <?php } ?>
                </div>

            </div>

            <input type="hidden" id="table_name" value="questions">

            <div class="table-responsive shadow p-3">
                <table class="table table-hover table-striped table-borderless" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Question</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Asked by</th>
                            <th>Ans</th>
                            <th>Views</th>
                            <th>Verify</th>
                            <th>Added</th>
                            <th>Updated</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT questions.*, users.name as unm,c.name as cat,users.id as uid FROM questions JOIN users ON questions.uid = users.id  JOIN category c Where questions.cid=c.id";
                        if ($_GET["verify"])
                            $query .= " and questions.verify='1'";
                        else if ($_GET["unverify"])
                            $query .= " and questions.verify='0'";
                        $row = $db->prepare($query);
                        $row->execute();
                        $cnt = 0;
                        foreach ($row as $r) {
                            $cnt++;

                            $noOfAns = $db->query("SELECT count(*) FROM answers WHERE qid = '" . $r['id'] . "'");
                            $noOfA = $noOfAns->fetchColumn();
                        ?>
                            <tr>
                                <td><?= $cnt; ?></td>
                                <td>
                                    <a href="show_answer.php?id=<?= $r['id'] ?>" class="text-decoration-none"><?= $r['question'] ?></a>
                                </td>
                                <td><?= $r['cat'] ?></td>
                                <td><?= $r['descr'] ?></td>
                                <td><?= $r['unm'] ?></td>
                                <td class="text-primary h6">
                                    <a href="" class="text-decoration-none">
                                        <?= $noOfA ?>
                                    </a>
                                </td>
                                <td><?= $r['views'] ?></td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" <?php if ($r['verify'] == '1') echo "checked"; ?> onchange="updateVerify(<?= $r['id'] ?>)">
                                    </div>
                                </td>
                                <td>
                                    <?= date("d-m-Y", strtotime($r['idate'])) ?> <span class='text-success'>
                                        <?= date("h:i A", strtotime($r['idate'])) ?></span>
                                </td>
                                <td><?php if ($r['udate']) echo date("d-m-Y", strtotime($r['udate'])); ?> <span class="text-success"><?php if ($r['udate']) echo date("h:i A", strtotime($r['udate'])); ?></span></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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