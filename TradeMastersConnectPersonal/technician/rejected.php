<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../PrePages/login.php');
}

require("../configDB/configDatabase.php");

$username = $_SESSION['username'];

$sql = "select * from requests where TechUserName = '$username' and status = 'R'";
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html>

<head>
    <title>Rejected Jobs</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="requests.css" </head>

<body>
    <!-- Doing the header -->
    <?php
    require('../template/header.php');
    ?>

    <div id="central">
        <?php
        require('technicianNav.php');
        ?>
        <!-- The main contents -->
        <main>
            <ul id="accepted-requests">
                <h1>Rejected Requests</h1>
                <?php if ($result->num_rows == 0) {
                    echo "You don't have Rejected requests";
                }
                ?>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <li>
                        <?php
                        $date = $row['Date'];
                        $jobTitle = $row['Skill Title'];
                        $custUsername = $row['CustUserName'];
                        $sql = "select * from Customer where UserName = '$custUsername'";
                        $subResult = $conn->query($sql);
                        $details = $subResult->fetch_assoc();
                        // print_r($details);
                        $firstName = $details['First Name'];
                        $fatherName = $details['Father Name'];
                        $gfName = $details['Grand Father Name'];
                        // $phone = $details['Phone Number'];
                        ?>
                        <div class="left-detail">
                            <p class="name"><?php echo $firstName . " " . $fatherName . " " . $gfName ?></p>
                            <p class="job-date">
                                <span class="job-title"><?php echo $jobTitle ?></span>
                                <span>&middot;</span>
                                <span class="date">
                                    <!-- March&nbsp;4&nbsp;2016 -->
                                    <?php
                                    echo $date;
                                    ?>
                                </span>
                            </p>
                        </div>
                        <div class="right-detail">
                            <!-- <button class="new-request-btn">N</button> -->
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </main>
    </div>

    <?php
    require('../template/footer.php');
    ?>

    <script src="accepted.js"></script>
</body>

</html>