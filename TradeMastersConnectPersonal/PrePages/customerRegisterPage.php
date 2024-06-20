<?php


if (isset($_POST['submit'])) {

    require("../configDB/configDatabase.php"); // connect to db

    // if ($_POST['user-type'] == 'customer') { // selected customer
        $fname = htmlspecialchars($_POST['custFirstName']);
        $lname = htmlspecialchars($_POST['custLastName']);
        $mname = htmlspecialchars($_POST['custMName']);
        $username = htmlspecialchars($_POST['custUsername']);
        $dob = htmlspecialchars($_POST['age']);
        $gender = htmlspecialchars($_POST['custGender']);
        $email = htmlspecialchars($_POST['custEmail']);
        $password = htmlspecialchars($_POST['custPassword']);
        $confirmPassword = htmlspecialchars($_POST['custConfirmPassword']);
        // $pic = htmlspecialchars($_POST['']); 
        $phone = htmlspecialchars($_POST['custPhone']);

        $gender = $gender === "male" ? "Male" : "Female";

        if ($password !== $confirmPassword) {
            echo "HEELI";
            // display error
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO customer (UserName, `First Name`, `Father Name`, `Grand Father Name`, Gender, `Phone Number`, Email) 
            VALUES ('$username', '$fname', '$mname', '$lname', '$gender', '$phone', '$email');";

            if (mysqli_query($conn, $sql)) {
                echo "SUCCESS";
                // header("location: index.php");
            } else {
                echo 'query error ' . mysqli_error($conn);
            }
        }
    // } else { // selected technician

    // }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradeMaster</title>
    <link rel="icon" href="./images/TMIcon.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="signup-container">
            <h1>Welcome to TradeMaster</h1>
            <h1>Sign Up</h1>


            <div class="customer-form">
                <div class="signup-form">
                    <h3>Customer Sign Up</h3>
                    <div class="input-box">
                        <input type="text" id="customer-fName" name="custFirstName" placeholder="First Name" required />
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" id="customer-lName" name="custMName" placeholder="Middle Name" required />
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" id="customer-gName" name="custLastName" placeholder="Last Name" required />
                        <i class='bx bxs-user'></i>
                    </div>

                    <div class="input-box">
                        <input type="text" id="technician-fullName" name="custUsername" placeholder="User Name" required />
                        <i class='bx bxs-user'></i>
                    </div>

                    <div class="input-box">
                        <input type="number" id="technician-age" name="age" placeholder="Age" required />
                        <i class='bx bxs-calendar'></i>
                    </div>

                    <div class="gender-options">
                        <p>Gender:</p>
                        <label for="">
                            <input type="radio" id="technician-male" name="custGender" value="male" required />Male
                        </label>
                        <label for="">
                            <input type="radio" id="technician-female" name="custGender" value="female" required />Female
                        </label>
                    </div>
                    <div class="input-box">
                        <input type="email" id="customer-email" name="custEmail" placeholder="Email" required />
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" id="customer-password" name="custPassword" placeholder="Password" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" id="customer-confirm-password" name="custConfirmPassword" placeholder="Confirm Password" required />
                        <i class='bx bxs-lock-alt'></i>
                    </div>

                    <div class="input-box">
                        <input type="tel" id="customer-phone" name="custPhone" placeholder="Phone" required />
                        <i class='bx bxs-phone'></i>
                    </div>
                    <div class="file-box">
                        <label for="customer-profilePicture">Upload Profile Picture (4x3)</label>
                        <input type="file" id="customer-profilePicture" name="custProfilePicture" accept="image/png, image/jpeg" required />

                    </div>
                </div>
            </div>


            <button type="submit" id="signup" name="submit">Sign Up</button>

    </form>

    <div class="info-text">
        <p>Do you have an account? <a href="./login.php">Login here</a>.</p>
        <p>
            By logging in, you agree to our
            <a href="#">Privacy Statement</a>.
        </p>
    </div>
    </div>


    <!-- <script src="script/fetch/UserFetch.js"></script> -->
    <script>
        let customerRadio = document.getElementById("customer");
        let technicianRadio = document.getElementById("technician");
        let customerForm = document.getElementsByClassName("customer-form")[0];
        let technicianForm =
            document.getElementsByClassName("technician-form")[0];
        customerRadio.addEventListener("change", () => {
            if (customerRadio.checked) {
                customerForm.classList.toggle("hidden");
                technicianForm.classList.toggle("hidden");
            }
        });
        technicianRadio.addEventListener("change", () => {
            if (technicianRadio.checked) {
                customerForm.classList.toggle("hidden");
                technicianForm.classList.toggle("hidden");
            }
        });
    </script>
</body>

</html>