<?php
error_reporting(0);
if ($_GET["unverify"])
    $title = "Unverified Categories";
else if ($_GET["verify"])
    $title = "Verified Categories";
else
    $title = "All Categories";
include('include/header.php');
?>
<div class="container-lg my-5">
    <div class="row">
        <div class="col">
            <div class="row d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-danger col-lg-4">
                    <?= $title; ?>
                </h2>
                <div class="btn-group col-lg-5">
                    <?php if (!$_GET["unverify"]) { ?>
                        <a class="btn btn-success shadow" href="show_categories.php?unverify=true">Show Unverified categories
                        </a><?php }  ?>
                    <?php if (!$_GET["verify"]) { ?>
                        <a class="btn <?php if ($title == "All Categories") { ?>  btn-primary <?php } else { ?> btn-success <?php } ?> shadow" href="show_categories.php?verify=true">Show verified categories</a>
                    <?php } ?>
                    <?php if ($title != "All Categories") { ?>
                        <a class="btn btn-primary shadow" href="show_categories">All</a>
                    <?php } ?>
                </div>

            </div>
            <input type="hidden" id="table_name" value="category">

            <div class="table-responsive shadow p-3">
                <table class="table table-hover table-striped table-borderless" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Verify</th>
                            <th>Added</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM category";
                        if ($_GET['verify'])
                            $query .= " WHERE verify='1'";
                        else if ($_GET['unverify'])
                            $query .= " WHERE verify='0'";
                        $row = $db->prepare($query);
                        $row->execute();
                        $cnt = 0;
                        foreach ($row as $r) {
                            $cnt++;
                        ?>
                            <tr>
                                <td><?= $cnt; ?></td>
                                <td><?= $r['name'] ?></td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" <?php if ($r['verify'] == '1') echo "checked"; ?> onchange="updateVerify(<?= $r['id'] ?>)">
                                    </div>
                                </td>
                                <!-- <td><?= $r['status'] ?></td> -->
                                <td><?= date("d-m-Y | h:i A", strtotime($r['idate'])); ?></td>
                                <td><?php if ($r['udate']) echo date("d-m-Y | h:i A", strtotime($r['udate'])); ?></td>
                                <td>
                                    <a href="#" onclick="modal('edit_category',<?= $r['id']; ?>)"><i class="fa fa-pen"></i></a>
                                    <a type='submit' class="ms-3 text-danger" onclick="deleteItem(<?= $r['id']; ?>)"><i class="fa fa-trash"></i></a>
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
<!-- <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>