<?php

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // User is not logged in, redirect to login page
    header("location: LoginForm.php");
    exit;
}

include("config/connectToDB.php");

// User is logged in, retrieve student ID from session
$studentId = $_SESSION["studId"];

$sql = "SELECT firstname, coursename, credithour FROM studentCourse 
           INNER JOIN studentdata ON studentCourse.studentid = studentdata.studentid
           INNER JOIN courses ON studentCourse.courseid = courses.courseId
           WHERE studentCourse.studentid = $studentId";

$stmt = mysqli_prepare($conn, $sql); // Prepare statement for security

// Execute the prepared statement
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt); // Get the result set

mysqli_stmt_close($stmt); // Close the prepared statement
mysqli_close($conn); // Close the connection
?>
<!DOCTYPE html>
<html lang="en">
<?php include("templates/header.php"); ?>

<main class="mainClass">
    <aside class="sidebar1">
        <div>
            <a href="http://www.aau.edu.et/cns/department-of-computer-science/" target="_blank">
                Computer Science Page
            </a>
        </div>
        <div>
            <a href="./RegisterPage.php" target="_self">
                Register
            </a>
        </div>
        <div>
            <a href="./LoginForm.php" target="_self">
                Portal
            </a>
        </div>
        <div>
            <a href="./displayCourses.php" target="_self">
                Courses
            </a>
        </div>

        <div>
            <a href="./registerCourses.php">Register Courses</a>
        </div>
    </aside>
    <div class="main-content">

        <?php

        if (mysqli_num_rows($result) > 0) {
            echo "<h3>Courses Taken by Student ID: $studentId</h3>";
            // $firstName = mysqli_fetch_assoc($result);
            echo "<h3>Name: " . $_SESSION['name'] . "</h3>";

            echo "<table>";
            echo "<tr><th>Course Name</th><th>Credit Hours</th></tr>";

            // Loop through all results using fetch_assoc
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<td>" . $row['coursename'] . "</td><td>" . $row['credithour'] . "</td></tr>";
            }

            echo "</table>";
        } else {
            echo "No courses found for student ID: $studentId";
        }
        mysqli_free_result($result); // Free memory from the result set
        ?>

    </div>
    <aside class="sidebar2">
        <h3>Share</h3>
        <div>
            <ul>
                <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
                <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
                <li><a href="https://email.com" target="_blank">Email</a></li>
            </ul>
        </div>

        <h3>Recommended</h3>
        <div class="related-article-section">
            <p class="title">Related article</p>
            <p class="description">Article description</p>
        </div>
        <div class="related-article-section">
            <p class="title">Related article</p>
            <p class="description">Article description</p>
        </div>
    </aside>
</main>


<<?php include("templates/footer.php"); ?> </body>

</html>