<?php

error_reporting(0);
$qid = 0;
include("include/conn.php");
if (!empty($_POST["option"])) {
    $qid = $_POST["qid"];
    $option = $_POST["option"];
    $id = $_POST["id"];

    $a1 = 0;
    $a2 = 0;
    $a3 = 0;
    $a4 = 0;

    if($id == ("op1" + $qid))
        $a1 = 1;
    else if($id == ("op2" + $qid))
        $a2 = 1;
    else if($id == ("op3" + $qid))
        $a3 = 1;
    else  if($id == ("op4" + $qid))
        $a4 = 1;


echo $a1;
//      $ins = $db->prepare("INSERT INTO answers(qid, uid, answer, a1, a2, a3, a4, idate) VALUES(:qid, :uid, :answer, :a1, :a2, :a3, :a4, :idate)");

//     $d["qid"] = $qid;
//     $d["uid"] = $_SESSION["uid"];
//     $d["answer"] = $option;
//     $d["a1"] = $a1;
//     $d["a2"] = $a2;
//     $d["a3"] = $a3;
//     $d["a4"] = $a4;
//     // $d["qid"] = $p["qid"];
//     // $d["qid"] = $p["qid"];
//     // $d["qid"] = $p["qid"];

//     $d['idate'] = date('Y-m-d H:i:s');

//     $ins->execute($d);
// echo $ins;
    // echo $id;
    // $sql = "SELECT * FROM questions WHERE op1='$option'";
    // $stmt = $db->prepare($sql);
    // $stmt->execute();
    // $count = $stmt->fetchColumn();


    // if ($count>0) {
    //     echo "<span style='color:red'> option already exists .</span>";
    //     echo "<script>$('#submit').prop('disabled',true);</script>";
    // } else {
    //     echo "<span style='color:green'> option available for Registration .</span>";
    //     echo "<script>$('#submit').prop('disabled',false);</script>";
    // }
}
