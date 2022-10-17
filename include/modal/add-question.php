<?php
include('../conn.php');
session_start();
include('../check-login.php');
?>
<div class="modal modal_type" id="addQuestionModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add Question</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" id="form" action="processing" name="registration">

                    <input type="hidden" name="fun" value="add_question">

                    <div class="mb-3 mt-3">
                        <label for="question" class="form-label">Question:</label>
                        <input type="text" class="form-control" id="question" placeholder="Enter question" name="question" required>
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
                                <option value="<?= $d['id'] ?>"><?= $d['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" class="form-control" id="description" cols="30" style="resize:none"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submit">Add</button>
                </form>
            </div>

            <div class="modal-footer">
                <input type="button" value="Create Poll" class="btn btn-outline-dark mx-2" onclick="modal('create-poll.php')">
                <button type="button" class="btn btn-outline-danger btn-cls" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>