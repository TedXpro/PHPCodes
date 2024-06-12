<?php
include("config/connectToDB.php");

// session_start(); // Start the session (optional, for potential future use)

// Define variables and initialize with empty values
$email = $course_id = "";
$register_err = ""; // Variable to store registration error message

// Processing form data when form is submitted
if (isset($_POST['submit'])) {

    // Get email and course ID from the form
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $course_id = mysqli_real_escape_string($conn, $_POST["course_id"]);

    // Validate input (replace with more robust validation)
    if (empty($email) || empty($course_id)) {
        $register_err = "Please enter your email and course ID.";
    } else {

        $courseSql = "SELECT courseId FROM courses WHERE courseId = $course_id";
        $courseResult = mysqli_query($conn, $courseSql);
        $courseInfo = mysqli_fetch_assoc($courseResult);

        $studentSql = "SELECT studentid FROM studentdata WHERE email = '$email'";
        $studentResult = mysqli_query($conn, $studentSql);
        $studentInfo = mysqli_fetch_assoc($studentResult);

        $studId = $studentInfo['studentid'];
        $coId = $courseInfo['courseId'];
        // $studentCourseSql = "SELECT courseid, studentid FROM studentcourse WHERE courseid = $coID AND studentid = $studID";
        // $studentCourseResult = mysqli_query($conn, $studentCourseSql);
        // $studentCourseInfo = mysqli_fetch_assoc($studentCourseResult);

        // if()

        if($courseInfo['courseId'] != "" && $studentInfo['studentid'] != ""){
            
            $sql = "INSERT INTO studentcourse (studentid, courseid) VALUES ($studId, $coId)";
            if(mysqli_query($conn, $sql)){
                $register_err = "Course registration successfull!";
            } else {
                $register_err = "Error registering course: " . mysqli_error($conn);
            }
        } else {
            $register_err = "Invalid email or course ID.";
        }

        // free memory;
        mysqli_free_result($courseResult);
        mysqli_free_result($studentResult);
        mysqli_close($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include("templates/header.php"); ?>

<h1>Register for Course</h1>

<?php echo $register_err; // Display registration error message 
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
    <br>
    <label for="course_id">Course ID:</label>
    <input type="text" id="course_id" name="course_id" value="<?php echo $course_id; ?>">
    <br>
    <button type="submit" name="submit">Register</button>
</form>


<?php include("templates/footer.php"); ?>

</html>