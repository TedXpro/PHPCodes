<?php
session_start();
require("customerUpdateProfileCode.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradeMaster</title>
    <link rel="icon" href="./images/TMIcon.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="customerPP.css">
</head>

<body>
    <div class="Technician-container">
        <div class="profile">
            <div class="profile_picture">
                <img src="<?php echo $photoLink; ?>" alt="profilePIc">
            </div>
            <p id="Technician_UserName"><?php echo $result['UserName']; ?></p>
            <br>
        </div>

        <div class="technician-form">
            <div class="technician-profile">
                <div class="output-box">
                    <p>Full Name:</p>
                    <span><?php echo $result['First Name'] . " " . $result['Grand Father Name']; ?></span>
                </div>
                <div class="output-box">
                    <p>Date of Birth:</p>
                    <span><?php echo $result['DOB']; ?></span>
                </div>
                <div class="output-box">
                    <p>Email:</p>
                    <span><?php echo $result['Email']; ?></span>
                </div>
                <div class="output-box">
                    <p>Gender:</p>
                    <span><?php echo $result['Gender']; ?></span>
                </div>
                <div class="output-box">
                    <p>Phone Number:</p>
                    <span><?php echo $result['Phone Number']; ?></span>
                </div>
                <div class="button">
                    <button onclick="redirect()" type="submit" id="technician_update">Update</button>
                    <button type="submit" id="technician_logout">Log Out</button>
                </div>
            </div>
        </div>

    </div>
    <script>
        function redirect() {
            window.location.href = "customerUPP.php";
        }
    </script>
</body>

</html>