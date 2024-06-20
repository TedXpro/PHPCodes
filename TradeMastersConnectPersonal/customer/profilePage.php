<?php
    require("../configDB/configDatabase.php");

    $sql = "SELECT * FROM customer where UserName = 'Abe';";
    $result = mysqli_query($conn, $sql);
    $customer = mysqli_fetch_assoc($result);

    
    echo htmlspecialchars($customer['UserName']) . " ";
    echo htmlspecialchars($customer['First Name']);

    mysqli_free_result($result);
    mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile Page</title>
    <link rel="stylesheet" href="profilePage.css">
</head>

<body>
    <?php
    // require("../template/header.php");
    ?>

    <!-- <div class="wrapper">
        <form action="login.php" method="POST">
            <h1>Welcome to TradeMaster</h1>
            <h1>Login</h1>

            <div class="input-box">
                <input name="username" type="text" placeholder="Username" value="<?php echo htmlspecialchars($username) ?>" required>
            </div>
            <div class="input-box">
                <input name="password" type="password" id="password" placeholder="Password" value="<?php echo htmlspecialchars($password) ?>" required>

                <span class="toggle-password" onclick="togglePassword()">
                    <i id="eye-icon" class='bx bx-hide'></i>
                </span>
            </div>
            <div class="show-password">
                <label>
                    <input type="checkbox" id="show-password-checkbox" onclick="togglePassword()"> Show password
                </label>
            </div>

            <div class="error-message">
                <?php //echo $error; ?>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="info-text">
                <p>Don't have an account? <a href="signUp.html">Sign up here.</a></p>
                <p>By logging in, you agree to our <a href="privacy.html">privacy statement.</a></p>
            </div>
        </form>
    </div> -->

    <?php
    // require("../template/footer.php");
    ?>
    <script src="script.js"></script>
</body>

</html>