<?php
session_start();
error_reporting(0);

if (!isset($_SESSION["uid"])) {
    $_SESSION["Swal-title"] = "Login required";
    $_SESSION["Swal-icon"] = "warning";
    $_SESSION["Swal-footer"] = "<button class='btn btn-primary' onclick=modal('user-login.php')>Login</button>";
    echo "<script>
    location.href = 'index';
</script>";
}
