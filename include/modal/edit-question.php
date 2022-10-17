<?php
include('../conn.php');
include('../check-login.php');

?>
<div class="modal modal_type" id="editQuestionModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Edit Question</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" id="form" action="processing" name="edit-ans">
                    <?php
                    $row = $db->query("SELECT questions.*,category.name as cname,category.id as cid FROM questions JOIN category ON questions.cid=category.id WHERE questions.id='" . $_POST['id'] . "'");
                    $row = $row->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <input type="hidden" name="fun" value="edit_question">
                    <input type="hidden" name="qid" value="<?= $row["id"] ?>">


                    <div class="form-group my-3">
                        <label for="question" class="form-label">Question:</label>

                        <input type="text" class="form-control" id="question" name="question" placeholder="question" value="<?= $row["question"] ?>">
                    </div>
                    <div class="form-group my-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" id="description" cols="30" class="form-control" placeholder="Description (optional)"><?= $row["descr"] ?></textarea>
                    </div>
                    <div class="mb-3 mt-3">

                        <label for="category" class="form-label">Category:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="" selected hidden disabled>Select category</option>
                            <?php
                            $q = "SELECT * FROM category";
                            $cat = $db->prepare($q);
                            $cat->execute();

                            foreach ($cat as $d) {
                            ?>
                                <option value="<?= $d['id'] ?>" <?php if ($d['id'] == $row['cid']) { ?> selected <?php } ?>><?= $d['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-info text-light" id="submit">Submit</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-cls" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>