<?php
error_reporting(0);
if ($_GET["unverify"])
    $title = "Pending Queries";
else if ($_GET["verify"])
    $title = "Completed Queries";
else
    $title = "All Queries";

include('include/header.php');

?><div class="container-lg my-5">
    <div class="row">
        <div class="col">

            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-danger col-lg-4">
                    <?= $title; ?>
                </h2>
                <div class="btn-group col-lg-5">
                    <?php if (!$_GET["unverify"]) { ?>
                        <a class="btn btn-success shadow" href="contact_us.php?unverify=true">Pending queries
                        </a><?php }  ?>
                    <?php if (!$_GET["verify"]) { ?>
                        <a class="btn <?php if ($title == "All Queries") { ?>  btn-primary <?php } else { ?> btn-success<?php } ?> shadow" href="contact_us.php?verify=true">Completed queries</a>
                    <?php } ?>
                    <?php if ($title != "All Queries") { ?>
                        <a class="btn btn-primary shadow" href="contact_us">All</a>
                    <?php } ?>
                </div>

            </div>

            <input type="hidden" id="table_name" value="contact">

            <div class="table-responsive shadow p-3">
                <table class="table table-hover table-striped table-borderless" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Message</th>
                            <?php
                            if (!$_GET['unverify']) {
                            ?>
                                <th>Response</th>
                            <?php } ?>
                            <th>Added</th>
                            <th>Updated</th>
                            <th>Action</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM contact ";
                        if ($_GET['verify'])
                            $query .= " WHERE solution is not NULL";
                        else if ($_GET['unverify'])
                            $query .= " WHERE solution is NULL";

                        $row = $db->prepare($query);
                        $row->execute();
                        $cnt = 0;
                        foreach ($row as $r) {
                            $cnt++;
                        ?>
                            <tr>
                                <td><?= $cnt; ?></td>
                                <td><?= $r['name'] ?></td>
                                <td><?= $r['email'] ?></td>
                                <td><?= $r['contactno'] ?></td>
                                <td><?= $r['mes'] ?></td>
                                <?php
                                if (!$_GET['unverify']) {
                                ?>
                                    <td><?= $r['solution'] ?></td>
                                <?php
                                }
                                ?>
                                <td>
                                    <?= date("d-m-Y", strtotime($r['idate'])) ?> <span class='text-success'>
                                        <?= date("h:i A", strtotime($r['idate'])) ?></span>
                                </td>
                                <td><?php if ($r['udate']) echo date("d-m-Y", strtotime($r['udate'])); ?> <span class="text-success"><?php if ($r['udate']) echo date("h:i A", strtotime($r['udate'])); ?></span></td>
                                <td>
                                    <?php
                                    if ($r['solution']) {
                                    ?>
                                        <a class="ms-3 text-danger" onclick="editContactReply(<?= $r['id']; ?>,`<?= $r['solution'] ?>`)">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                    <?php
                                    } else {
                                    ?>
                                        <a class="ms-3 text-success" onclick="contactReply(<?= $r['id'] ?>)">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    <?php } ?>
                                </td>
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