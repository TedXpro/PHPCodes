<?php
// session_start();
if (!isset($_SESSION['username']) && $_SESSION['role'] != 'customer') {
    header('Location: ../prepages/login.php');
}

require("../configDB/configDatabase.php");
require("UpdateProfileCode.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <nav>
        <div id="profile">
            <div class="profile">
                <div class="profile_picture">
                    <button id="profile-photo"><img src="<?php echo $photoLink; ?>" alt="profile pic"></button>
                </div>
            </div>
            <span id="profile-name">
                <?php echo $_SESSION['username'] ?>
            </span>
            <p><?php echo $skillResult['SkillTitle']; ?></p>
        </div>
        <button class="requests" onclick="viewRequests()">Requests</button>
        <button class="accepted-jobs" onclick="viewAcceptedJobs()">Accepted Jobs</button>
        <button class="Rejected-requests" onclick="viewRejectedRequests()">Rejected Requests</button>
        <button class="my-skills">My skills</button>
    </nav>
    <script src="technicianNav.js"></script>
</body>

</html>