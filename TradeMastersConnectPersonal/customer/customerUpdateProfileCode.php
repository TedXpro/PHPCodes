<?php


if (!isset($_SESSION['username']) || $_SESSION['role'] != 'customer') {
    header('Location: ../prepages/login.php');
    exit;
}

require("../configDB/configDatabase.php");

$username = $_SESSION['username'];

$sql = "SELECT * from customer where UserName = '$username';";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($result);

$photoLink = "../PrePages/" . $result['Photo Link'];

// $skilSql = "SELECT * FROM technician_skill where TechUserName = '$username';";
// $skillResult = mysqli_query($conn, $skilSql);
// $skillResult = mysqli_fetch_assoc($skillResult);
?>