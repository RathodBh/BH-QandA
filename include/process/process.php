<!-- <link href="package/dist/sweetalert2.min.css">
<script src="package/dist/sweetalert2.all.min.js"></script> -->
<?php

session_start();
include('../conn.php');
$p = $_REQUEST;
$fun = $p['fun'];

// User registration
if ($fun == "user_register") {
    //insert query
    $ins = $db->prepare("INSERT INTO users(name, email, password, contact, idate, points) VALUES(:name, :email, :password, :contact, :idate, '5')");

    $d['name'] = $p['name'];
    $d['email'] = $p['email'];
    $d['password'] = md5($p['password']);
    $d['contact'] = $p['contact'];

    $d['idate'] = date('Y-m-d H:i:s');

    if ($ins->execute($d)) {

        $_SESSION['Swal-title'] = "Registration successfully";
        $_SESSION['Swal-icon'] = "success";
        echo "
            <script>
                location.href = 'index';
            </script>
            ";
    }
}

//user login
if ($fun == "user_login") {
    $pass = md5($p['password']);

    $sql = "SELECT * FROM users where email='" . $p['email'] . "' and password='$pass'";
    $row = $db->query($sql);
    $row = $row->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $row['name'];
        $_SESSION['contact'] = $row['contact'];
        $_SESSION['uid'] = $row['id'];

        $_SESSION['Swal-title'] = "Login successfully";
        $_SESSION['Swal-icon'] = "success";
        echo "<script>location.href='index';</script>";
    } else {

        $_SESSION['Swal-title'] = "Your data is not match";
        $_SESSION['Swal-icon'] = "error";
        echo "<script>location.href='index';</script>";
    }
}


// Contact us
if ($fun == "contact") {
    $ins = $db->prepare("INSERT INTO contact(name, email, contactno, mes, idate) VALUES(:name, :email, :contactno, :mes, :idate)");

    $d['name'] = $p['fname'] . " " . $p["lname"];
    $d['email'] = $p['email'];
    $d['contactno'] = $p['contactno'];
    $d['mes'] = $p['message'];

    $d['idate'] = date('Y-m-d H:i:s');

    if ($ins->execute($d)) {

        $_SESSION['Swal-title'] = "Your feedback is added successfully";
        $_SESSION['Swal-icon'] = "success";
        echo "
            <script>
                location.href = 'contact';
            </script>
            ";
    }
}

// forget/reset password
if ($fun == "forget_password") {

    $sql = "SELECT * FROM users where email='" . $p['email'] . "'";
    $row = $db->query($sql);
    $row = $row->fetch(PDO::FETCH_ASSOC);

    if (($row['email'] == $p['email'])) {
        $up = $db->prepare("UPDATE users SET password = '" . md5($p['password']) . "' where email='" . $p['email'] . "' and name ='" . $p['name'] . "'");
        if ($up->execute()) {

            $_SESSION['Swal-title'] = "Your password changed successfully";
            $_SESSION['Swal-icon'] = "success";
            echo "<script>location.href='index';</script>";
        } else {

            $_SESSION['Swal-title'] = "Your data is not match";
            $_SESSION['Swal-icon'] = "error";
            echo "<script>location.href='index';</script>";
        }
    } else {

        $_SESSION['Swal-title'] = "Your data is not match";
        $_SESSION['Swal-icon'] = "error";
        echo "<script>location.href='index';</script>";
    }
}

// Add question
if ($fun == "add_question") {
    $ins = $db->prepare("INSERT INTO questions(question, uid, cid, descr, views, ispoll, idate) VALUES(:question, :uid, :cid, :descr, '0', '0', :idate)");

    $d['question'] = $p['question'];
    $d['uid'] = $_SESSION['uid'];

    $d['cid'] = $p['category'];
    $d['descr'] = $p['description'];

    $d['idate'] = date('Y-m-d H:i:s');

    if ($ins->execute($d)) {

        $_SESSION['Swal-title'] = "Your question is added successfully";
        $_SESSION['Swal-icon'] = "success";

        //update user points
        $sql = "SELECT * FROM users where email='" . $_SESSION['email'] . "'";
        $row = $db->query($sql);
        $row = $row->fetch(PDO::FETCH_ASSOC);

        $pt5 = $row['points'] + 5;
        $up = $db->prepare("UPDATE users SET points ='$pt5' where email='" . $_SESSION['email'] . "'");
        $up->execute();
        echo "
            <script>
                location.href = 'index';
            </script>
            ";
    }
}

// add Answer
if ($fun == "add_answer") {


    $ins = $db->prepare("INSERT INTO answers(qid, uid, answer, descr, best, idate) VALUES(:qid, :uid, :answer, :descr, '0', :idate)");

    $d['qid'] = $p['qid'];
    $d['uid'] = $_SESSION['uid'];
    $d['answer'] = $p['answer'];
    $d['descr'] = $p['description'];

    $d['idate'] = date('Y-m-d H:i:s');
    print_r($d);
    if ($ins->execute($d)) {

        $_SESSION['Swal-title'] = "Your answer is added successfully";
        $_SESSION['Swal-icon'] = "success";

        //update user points
        $up = $db->prepare("UPDATE users SET points = points+10 where email='" . $_SESSION['email'] . "'");
        $up->execute();

        //update views
        $up2 = $db->prepare("UPDATE questions SET views = views + 1 where id='" . $p['qid'] . "'");
        $up2->execute();
        echo "
            <script>
                location.href = 'index';
            </script>
            ";
    }
}


// Edit question
if ($fun == "edit_question") {

    $qid = $p["qid"];
    $currentDate= date('Y-m-d H:i:s');
    $up = $db->prepare("UPDATE questions SET question = '" . $p['question'] . "',descr = '" . $p['description'] . "',cid = '" . $p['category'] . "',udate='$currentDate' where id='$qid'");
    if ($up->execute()) {

        $_SESSION['Swal-title'] = "Your question is updated successfully";
        $_SESSION['Swal-icon'] = "success";
    } else {

        $_SESSION['Swal-title'] = "Something went wrong";
        $_SESSION['Swal-icon'] = "error";
    }
    echo "<script>location.href='questions';</script>";
}

?>