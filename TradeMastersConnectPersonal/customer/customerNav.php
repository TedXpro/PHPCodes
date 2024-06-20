<?php
// session_start();
if (!isset($_SESSION['username']) && $_SESSION['role'] != 'customer') {
    header('Location: ../prepages/login.php');
}

require("../configDB/configDatabase.php");


$username = $_SESSION['username'];
$sql = "SELECT `Photo Link` from customer where UserName = '$username';";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($result);
$photoLink = "../PrePages/" . $result['Photo Link'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>

        <div id="profile">
            <button id="profile-photo"><img src="<?php echo $photoLink; ?>" alt="profile pic"></button>
            <span id=" profile-name">
                <?php echo $_SESSION['username'] ?>
            </span>
            <p>Customer</p>
        </div>
        <button class="accepted-more">Accepted Requests</button>
        <button class="pending-more">Pending Requests</button>
        <button>Rate Technicians</button>
    </nav>
    <script src="customerNav.js"></script>
</body>

</html>