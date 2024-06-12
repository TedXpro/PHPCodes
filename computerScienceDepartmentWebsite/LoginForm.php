<?php


include("config/connectToDB.php");

$errors = ['acc' => ''];

if (isset($_POST['submit'])) {
    session_start(); // Start the session

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT firstname, studentid, accountpassword FROM studentdata WHERE email = '$email' ";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch the result in array format (gets only one result as an associative array)
    $userInfo = mysqli_fetch_assoc($result);

    // free memory;
    mysqli_free_result($result);
    mysqli_close($conn);
    
    if ($userInfo) {
        $hashedPasswordFromDB = $userInfo['accountpassword'];
        if (password_verify($password, $hashedPasswordFromDB)) {
            // Successful login
            // $_SESSION["loggedin"] = true; // Set session variable for login status
            $_SESSION["name"] = $userInfo['firstname']; // Store username in session
            $_SESSION["studId"] = $userInfo['studentid']; // Store student ID for course access (assuming 'id' is the student ID)
            
            header("location: displayStudentCoursesFromDB.php"); // redirect to display paage
        } else {
            $errors['acc'] = "Incorrect email or password";
        }
    } else {
        $errors['acc'] = "Incorrect email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <?php include("templates/header.php"); ?>

    </div>
    <div class="signInForm">
        <h2>Sign In</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="errorMessage"><?php echo $errors['acc']; ?></div>
            <label>Email: </label>
            <input type="text" placeholder="Email" required name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : "" ?>">
            <label>Password: </label>
            <input type="password" placeholder="Password" required name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : "" ?>">
            <button type="submit" name="submit" value="submit" id="submit">Sign In</button>
        </form>
        <p id="dontHaveAccount">
            Don't have an account? <a href="./RegisterPage.php">Register here!</a>
        </p>
    </div>

    <?php include("templates/footer.php"); ?>

</html>