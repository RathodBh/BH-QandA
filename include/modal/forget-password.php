<div class="modal modal_type" id="forgetPasswordModel">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-warning">
                <h4 class="modal-title">Reset password</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="processing" method="post">
                    <input type="hidden" name="fun" value="forget_password">
                    <div class="my-3">
                        <label for="name" class="form-label">Registered Name:</label>
                        <input type="text" placeholder="name" name="name" id="name" class="form-control my-2" required>
                    </div>
                    <div class="my-3">
                        <label for="email" class="form-label"> Registered Email:</label>
                        <input type="text" placeholder="Email" name="email" id="email" class="form-control my-2" required>
                    </div>
                    <div class="my-3">
                        <label for="password" class="form-label">Password:</label>

                        <input type="password" placeholder="New password " id="password" name="password" class="form-control my-2" required>
                    </div>

                    <div class="d-flex ">
                        <button type="submit" class="btn btn-success m-2">UPDATE</button>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning m-2" onclick="modal('user-login.php')">BACK TO LOGIN</button>
            </div>

        </div>
    </div>
</div>