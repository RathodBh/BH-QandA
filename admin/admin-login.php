<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid my-4">
        <div class="row d-flex justify-content-around">
            <div class="col-lg-7">
                <h2 class="text-success">Admin Login</h2>
                <form action="adminprocess" method="POST">
                    <input type="hidden" name="fun" value="admin_login">
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>