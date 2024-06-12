<?php
include("config/connectToDB.php");

$errors = ['password' => "", 'dob' => ""];

if (isset($_POST['submit'])) {
    // protect from sql injection
    $fName = mysqli_real_escape_string($conn, $_POST['fName']);
    $lName = mysqli_real_escape_string($conn, $_POST['lName']);
    $phone = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);

    if ($password !== $cpass) {
        $errors['password'] = "Passwords dont match";
    } else {
        //calculate age and check
        $dobDate = new DateTime($dob);
        $today = new DateTime('today');
        $age = $dobDate->diff($today)->y;

        // Check if age is greater than or equal to 18
        if ($age < 18) {
            $errors['dob'] = "age must be greater than 18";
        } else {

            // hash password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // create sql
            $sql = "INSERT INTO studentdata(firstname, lastname, email, phonenumber, gender, accountpassword, country, dateofbirth) VALUES ('$fName', '$lName', '$email', '$phone', '$gender', '$password', '$country', '$dob')";

            // save to db and check 
            if (mysqli_query($conn, $sql)) {
                // success 

                // redirecting to another file
                header("location: index.php");
            } else {
                //error 
                echo 'query error ' . mysqli_error($conn);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

    <?php include("templates/header.php"); ?>
    <h1>Register</h1>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label class="info" for="fName">First Name</label>
        <input class="info" required type="text" name="fName" value="<?php echo isset($_POST['fName']) ? htmlspecialchars($_POST['fName']) : ""; ?>">

        <label for="lName" class="info">Last Name</label>
        <input type="text" required class="info" name="lName" value="<?php echo isset($_POST['lName']) ? htmlspecialchars($_POST['lName']) : ""; ?>">

        <label for="lName" class="info">Email</label>
        <input type="email" required class="info" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ""; ?>">

        <label class="info">Phone</label>
        <input class="info" type="tel" name="phoneNumber" value="<?php echo isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : ""; ?>">

        <label class="info">Birthdate:</label>
        <div class="errorMessage"><?php echo $errors['dob'] ?></div>
        <input type="date" id="dataInput" required name="dob" value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ""; ?>">

        <label class="info">Gender</label>
        <label for="gender">Female</label>
        <input id="female" value="female" name="gender" type="radio" <?php echo isset($_POST['gender']) && ($_POST['gender'] == 'female') ? 'checked' : '' ?>>
        <label for="gender">Male</label>
        <input id="male" value="male" type="radio" name="gender" <?php echo isset($_POST['gender']) && ($_POST['gender'] == 'male') ? 'checked' : '' ?>>
        <br>
        <br>

        <label class="info">Password</label>
        <input type="password" class="info" required name="password" id="password">
        <div class="errorMessage"><?php echo $errors['password'] ?></div>
        <label class="info">Confirm Password</label>
        <input type="password" class="info" required id="confirmPassword" name="confirmPassword">

        <br>
        <label class="info">Country</label>
        <select name="country" required>
            <option value=""></option>
            <option value="et" <?php echo isset($_POST['country']) && ($_POST['country'] == 'et') ? 'selected' : '' ?> selected>Ethiopia</option>
            <option value="us" <?php echo isset($_POST['country']) && ($_POST['country'] == 'us') ? 'selected' : '' ?>>United States of America</option>
            <option value="ken" <?php echo isset($_POST['country']) && ($_POST['country'] == 'ken') ? 'selected' : '' ?>>Kenya</option>
            <option value="rus" <?php echo isset($_POST['country']) && ($_POST['country'] == 'rus') ? 'selected' : '' ?>>Russia</option>
        </select>

        <button type="submit" name="submit" value="submit" id="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>

    <?php include("templates/footer.php"); ?>
</body>

</html>