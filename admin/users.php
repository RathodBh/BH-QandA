<?php
$title = "Show Users";
include('include/header.php');

?><div class="container-lg my-5">
    <div class="row">
        <div class="col">
            <h2 class="text-danger mb-4">Show Users</h2>

            <input type="hidden" id="table_name" value="users">

            <div class="table-responsive shadow p-3">
                <table class="table table-hover table-striped table-borderless" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Points</th>
                            <th>Que(s)</th>
                            <th>Ans</th>
                            <th>Added</th>
                            <th>Updated</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $usersQ = $db->prepare("SELECT DISTINCT questions.*, users.*, c.name as cat,users.id as uid,users.idate as uidate,users.udate as uudate FROM questions JOIN users ON questions.uid = users.id JOIN category c Where questions.cid=c.id GROUP BY users.name");
                        $usersQ->execute();
                        $cnt = 0;
                        foreach ($usersQ as $b) {
                            $cnt++;
                            $noOfAns = $db->query("SELECT count(*) FROM answers WHERE qid = '" . $b['id'] . "'");
                            $noOfA = $noOfAns->fetchColumn();

                            $noOfQ = $db->query("SELECT count(*) FROM questions WHERE uid = '" . $b['uid'] . "'");
                            $noOfQ = $noOfQ->fetchColumn();
                            // $row = $db->prepare("SELECT * FROM users");
                            // $row->execute();
                            // $cnt = 0;
                            // foreach ($row as $r) {
                        ?>
                            <tr>
                                <td><?= $cnt; ?></td>
                                <td><a href="users_info.php" class="text-decoration-none"><?= $b['name'] ?></a></td>
                                <td><?= $b['email'] ?></td>
                                <td><?= $b['contact'] ?></td>
                                <td><?= $b['points'] ?></td>
                                <td><?= $noOfQ; ?></td>
                                <td><?= $noOfA ?></td>
                                <!-- <td><?= $r['views'] ?></td> -->
                                <!-- <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" <?php if ($r['verify'] == '1') echo "checked"; ?> onchange="updateVerify(<?= $r['id'] ?>)">
                                    </div>
                                </td> -->
                                <td>
                                    <?= date("d-m-Y", strtotime($b['uidate'])) ?> <span class='text-success'>
                                        <?= date("h:i A", strtotime($b['uidate'])) ?></span>
                                </td>
                                <td><?php if ($b['uudate']) echo date("d-m-Y", strtotime($b['uudate'])); ?> <span class="text-success"><?php if ($b['uudate']) echo date("h:i A", strtotime($b['uudate'])); ?></span></td>
                                <!-- <td>
                                    <a href="edit_.php?<?= $r['id']; ?>">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a href="delete_category.php?<?= $r['id']; ?>" class="ms-3 text-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td> -->
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

?><script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>