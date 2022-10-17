<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "qanda";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_METHOD, PDO::FETCH_ASSOC);

    // echo "<script>alert('Connected successfully')</script>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>