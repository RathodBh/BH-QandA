<?php
include('../conn.php');
include('../check-login.php');

?>
<div class="modal modal_type" id="addQuestionModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-success">
                <h4 class="modal-title text-light">Add Answer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" id="form" action="processing" name="add-ans">
                    <?php
                    $row = $db->query("SELECT questions.*,category.name as cname FROM questions JOIN category ON questions.cid=category.id WHERE questions.id='" . $_POST['id'] . "'");
                    $row = $row->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <input type="hidden" name="fun" value="add_answer">
                    <input type="hidden" name="qid" value="<?= $row["id"] ?>">

                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>Question:</th>
                            <td>
                                <?= $row["question"] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>
                                <?= $row["descr"] ?>
                                </th>
                        </tr>
                        <tr>
                            <th>Category:</th>
                            <td>
                                <?= $row["cname"] ?>
                            </td>
                        </tr>
                    </table>

                    <div class="form-group my-3">
                        <label for="answer" class="form-label">Answer:</label>
                        <input type="text" class="form-control" id="answer" name="answer" placeholder="Answer">
                    </div>
                    <div class="form-group my-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" id="description" cols="30" class="form-control" placeholder="Description (optional)"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-cls" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>