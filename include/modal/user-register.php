<div class="modal modal_type" id="signUpModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-primary">
                <h4 class="modal-title text-light">Sign Up</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" id="form" action="processing" name="registration" onSubmit="return isValid()">

                    <input type="hidden" name="fun" value="user_register">

                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required onBlur="userAvailability()">
                        <span class="d-block" id="user-availability-status1" style="font-size:12px;"></span>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="contact" class="form-label">Contact:</label>
                        <input type="text" class="form-control" id="contact" placeholder="Enter contact number" name="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpass" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="cpass" placeholder="Confirm password" name="cpass" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit">Register</button>
                </form>
            </div>

            <div class="modal-footer">
                <input type="button" value="Back to Login" class="btn btn-outline-dark mx-2" onclick="modal('user-login')">
                <button type="button" class="btn btn-outline-danger btn-cls" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>

</script>