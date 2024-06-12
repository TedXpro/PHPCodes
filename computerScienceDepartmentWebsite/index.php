<?php
include("config/connectToDB.php");
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
    <h1>AAU CS Department</h1>
    <p>Modern higher education in Ethiopia began with the founding of the University College of Addis Ababa on March
      20, 1950.
      When formal lectures started in the College on December 11, 1950, the Faculty of Science, one of the only two
      Faculties
      then, had only two departments or sections, known as Section A and Section B. In Section A, students were given
      basic
      training in Engineering, which would enable them to go abroad to specialize in one of the many branches of
      Engineering,
      whereas those in Section B were prepared for Medical School as well as for further studies in Biology and allied
      fields.

      In 1956-57 the Faculty took a step forward by changing the three-year Section B program into a four-year B.Sc.
      degree
      program in Biology. By 1959-60, there were three B.Sc. degree offering programs in the following combination of
      subjects: Course A -Mathematics and Physics; Course B -Biology and Chemistry; and Course C -Chemistry and
      Geology.
      Similarly, in 1959-60, the Section A program was amalgamated with the newly established Engineering College.

      When the Haile Selassie I University was established in 1961, the Faculty of Science was reorganized into five
      teaching
      Departments, all offering B.Sc. degree programs. These were the Departments of: Biology, Chemistry, Geology,
      Mathematics, and Physics. A Forestry Department, the Natural History Museum and the National Herbarium were
      established
      a little later, while a Statistical Training Centre was opened in the Department of Mathematics, center that
      developed
      into a full-fledged Department of Statistics in the early 1970s.</p>
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

</html>