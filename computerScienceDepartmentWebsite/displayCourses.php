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
        <h1>Course list</h1>
        <table>
            <tr>
                <th>Course Name</th>
                <th>Credit Hours</th>
                <th>Course ID</th>
            </tr>
            <tr>
                <td>Web Application Development</td>
                <td>7</td>
                <td>10000</td>
            </tr>

            <tr>
                <td>Design and Analysis of Algorithm</td>
                <td>6</td>
                <td>10001</td>
            </tr>

            <tr>
                <td>Computer Graphics</td>
                <td>5</td>
                <td>10002</td>
            </tr>

            <tr>
                <td>Operating Systems</td>
                <td>5</td>
                <td>10003</td>
            </tr>

            <tr>
                <td>Network and System Adminstration</td>
                <td>5</td>
                <td>10004</td>
            </tr>
        </table>
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
<?php include("templates/footer.php"); ?>
<script>
    document.getElementById("course-list")
        .addEventListener("click", function() {
            window.location.href = "course-list.html";
        });
    document.getElementById("home").addEventListener("click", function() {
        window.location.href = "cs_department.html";
    });
    document.getElementById("register").addEventListener("click", function() {
        window.location.href = "register.html";
    });
</script>
</body>

</html>