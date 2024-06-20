<?php
require("../configDB/configDatabase.php"); // connect to db

$errors = array('password' => '', 'username' => '');

if (isset($_POST['customerSubmitButton'])) {

  $fname = htmlspecialchars($_POST['custFirstName']);
  $lname = htmlspecialchars($_POST['custLastName']);
  $mname = htmlspecialchars($_POST['custMName']);
  $username = htmlspecialchars($_POST['custUsername']);
  $dob = htmlspecialchars($_POST['age']);
  $gender = htmlspecialchars($_POST['custGender']);
  $email = htmlspecialchars($_POST['custEmail']);
  $password = htmlspecialchars($_POST['custPassword']);
  $confirmPassword = htmlspecialchars($_POST['custConfirmPassword']);
  $phone = htmlspecialchars($_POST['custPhone']);

  $gender = $gender === "male" ? "Male" : "Female";

  // check username
  $sql = "SELECT UserName from customer WHERE UserName = '$username'";
  $result = mysqli_query($conn, $sql);
  $resultArray = mysqli_fetch_assoc($result);
  if ($resultArray) {
    $errors['username'] = "Username already exists!";
  } else if ($password !== $confirmPassword) {  // check password
    $errors['password'] = "Passwords don't match!";
    // display error
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Check if file uploaded successfully
    if (isset($_FILES['custProfilePicture']) && $_FILES['custProfilePicture']['error'] === UPLOAD_ERR_OK) {

      // Get file details
      $fileName = $_FILES['custProfilePicture']['name'];  // Original filename
      $fileTmpName = $_FILES['custProfilePicture']['tmp_name'];
      $fileSize = $_FILES['custProfilePicture']['size'];
      $fileType = $_FILES['custProfilePicture']['type'];


      // Generate a unique filename with extension
      $uniqueFileName = $username . "_ProfilePic" . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

      // Define upload directory with subfolder
      $uploadDir = "UploadedImages/" . $uniqueFileName;


      // Move uploaded file


      $sql = "INSERT INTO customer (UserName, `First Name`, `Father Name`, `Grand Father Name`, Gender, `Phone Number`, DOB, `Photo Link`, Email) 
            VALUES ('$username', '$fname', '$mname', '$lname', '$gender', '$phone', '$dob', '$uploadDir', '$email');";

      $credentialsSql = "INSERT INTO customer_credentials (UserName, PassHash) VALUES ('$username', '$password');";

      if (mysqli_query($conn, $sql) && mysqli_query($conn, $credentialsSql)) {
        echo "SUCCESS";
        if (move_uploaded_file($fileTmpName, $uploadDir)) {
          echo "File uploaded successfully!";
        }
        // header("location: index.php");
      } else {
        echo 'query error ' . mysqli_error($conn);
      }
    }
  }
} else if (isset($_POST['technicianSubmitButton'])) {
  // Register to Technician Table


  $fname = htmlspecialchars($_POST['techFirstName']);
  $lname = htmlspecialchars($_POST['techLName']);
  $mname = htmlspecialchars($_POST['techMName']);
  $username = htmlspecialchars($_POST['techUsername']);
  $dob = htmlspecialchars($_POST['techAge']);
  $gender = htmlspecialchars($_POST['techGender']);
  $email = htmlspecialchars($_POST['techEmail']);
  $password = htmlspecialchars($_POST['techPassword']);
  $confirmPassword = htmlspecialchars($_POST['techConfirmPassword']);
  $phone = htmlspecialchars($_POST['techPhone']);
  $eduLevel = htmlspecialchars($_POST['techEducationLevel']);
  $skills = htmlspecialchars($_POST['techSkills']);
  $xp = htmlspecialchars($_POST['techExperience']);
  $location = htmlspecialchars($_POST['techAvailableLocation']);
  $bio = htmlspecialchars($_POST['techAdditionalBio']);

  $gender = $gender === "male" ? "Male" : "Female";


  // check username
  $sql = "SELECT UserName from technician WHERE UserName = '$username'";
  $result = mysqli_query($conn, $sql);
  $resultArray = mysqli_fetch_assoc($result);
  if ($resultArray) {
    $errors['username'] = "Username already exists!";
  } else if ($password !== $confirmPassword) {  // check password
    $errors['password'] = "Passwords don't match!";
    // display error
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);

    // upload files
    if (
      isset($_FILES['techCertificate']) && $_FILES['techCertificate']['error'] === UPLOAD_ERR_OK
      && isset($_FILES['techProfilePicture']) && $_FILES['techProfilePicture']['error'] === UPLOAD_ERR_OK
      && isset($_FILES['techPassport']) && $_FILES['techPassport']['error'] === UPLOAD_ERR_OK
    ) {

      // READY Certificate
      $certiFileName = $_FILES['techCertificate']['name'];  // Original filename
      $certiFileTmpName = $_FILES['techCertificate']['tmp_name'];
      $certiFileSize = $_FILES['techCertificate']['size'];
      $certiFileType = $_FILES['techCertificate']['type'];

      // Generate a unique filename with extension
      $certiUniqueFileName = $username . "_Certificate" . '.' . pathinfo($certiFileName, PATHINFO_EXTENSION);

      // Define upload directory with subfolder
      $certiUploadDir = "TechnicianCertificates/" . $certiUniqueFileName;

      // READY profile pic
      $profileFileName = $_FILES['techProfilePicture']['name'];  // Original filename
      $profileFileTmpName = $_FILES['techProfilePicture']['tmp_name'];
      $profileFileSize = $_FILES['techProfilePicture']['size'];
      $profileFileType = $_FILES['techProfilePicture']['type'];

      // Generate a unique filename with extension
      $uniqueFileName = $username . "_ProfilePic" . '.' . pathinfo($profileFileName, PATHINFO_EXTENSION);

      // Define upload directory with subfolder
      $profileUploadDir = "TechnicianProfilePics/" . $uniqueFileName;

      // READY Passport
      $passportFileName = $_FILES['techPassport']['name'];  // Original filename
      $passportFileTmpName = $_FILES['techPassport']['tmp_name'];
      $passportFileSize = $_FILES['techPassport']['size'];
      $passportFileType = $_FILES['techPassport']['type'];

      // Generate a unique filename with extension
      $uniqueFileName = $username . "_Passport" . '.' . pathinfo($passportFileName, PATHINFO_EXTENSION);

      // Define upload directory with subfolder
      $passportUploadDir = "TechnicianResidentialID/" . $uniqueFileName;



      $sql = "INSERT INTO technician (UserName, `First Name`, `Father Name`, `Grand Father Name`, Gender, DOB, `Phone Number`, Email, `Work Address`, Photo, `Identifier Link`,  Bio) 
            VALUES ('$username', '$fname', '$mname', '$lname', '$gender', '$dob', '$phone', '$email', '$location', '$profileUploadDir', '$passportUploadDir', '$bio' );";

      $credentialsSql = "INSERT INTO technician_credentials (UserName, PassHash) VALUES ('$username', '$password');";

      echo $skills;
      $techSkillSql = "INSERT INTO technician_skill (TechUserName, SkillTitle, Experience, Rating, CertificateLink) VALUES ('$username', '$skills', '$xp', '1', '$certiUploadDir');";

      if (mysqli_query($conn, $sql) && mysqli_query($conn, $credentialsSql) && mysqli_query($conn, $techSkillSql)) {
        echo "SUCCESS";
        if (move_uploaded_file($certiFileTmpName, $certiUploadDir)) { // upload certificate
          echo "Certificate uploaded successfully!";
        }
        if (move_uploaded_file($passportFileTmpName, $passportUploadDir)) { // upload passport
          echo "Passport uploaded successfully!";
        }
        if (move_uploaded_file($profileFileTmpName, $profileUploadDir)) { // upload Profile pic
          echo "Profile Pic uploaded successfully!";
        }

        // header("location: index.php");
      } else {
        echo 'query error ' . mysqli_error($conn);
      }
    }
  }
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
  <div class="signup-container">
    <h1>Welcome to TradeMaster</h1>
    <h1>Sign Up</h1>

    <div class="signup-options">
      <div class="option">
        <input type="radio" id="customer" name="user-type" value="customer" class="radio-btn" checked />
        <label for="customer">
          <h4>As Customer</h4>
          <i class='bx bx-user'></i>
        </label>
      </div>
      <div class="option">
        <input type="radio" id="technician" name="user-type" value="technician" class="radio-btn" />
        <label for="technician">
          <h4>As Technician</h4>
          <i class='bx bxs-wrench'></i>
        </label>
      </div>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

      <div class="customer-form">
        <div class="signup-form">
          <h3>Customer Sign Up</h3>
          <div class="input-box">
            <input type="text" id="customer-fName" name="custFirstName" placeholder="First Name" required value="<?php echo isset($_POST['custFirstName']) ? htmlspecialchars($_POST['custFirstName']) : ""; ?>" />
            <i class='bx bxs-user'></i>
          </div>
          <div class="input-box">
            <input type="text" id="customer-lName" name="custMName" placeholder="Middle Name" required value="<?php echo isset($_POST['custMName']) ? htmlspecialchars($_POST['custMName']) : ""; ?>" />
            <i class='bx bxs-user'></i>
          </div>
          <div class="input-box">
            <input type="text" id="customer-gName" name="custLastName" placeholder="Last Name" required value="<?php echo isset($_POST['custLastName']) ? htmlspecialchars($_POST['custLastName']) : ""; ?>" />
            <i class='bx bxs-user'></i>
          </div>

          <div class="input-box">
            <label class="errors">
              <?php echo $errors['username']; ?>
            </label>
            <input type="text" id="technician-fullName" name="custUsername" placeholder="User Name" required value="<?php echo isset($_POST['custUsername']) ? htmlspecialchars($_POST['custUsername']) : ""; ?>" />
            <i class='bx bxs-user'></i>
          </div>

          <div class="input-box">
            <input type="date" id="technician-age" name="age" placeholder="Age" required value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ""; ?>" />
            <i class='bx bxs-calendar'></i>
          </div>

          <div class="gender-options">
            <p>Gender:</p>
            <label for="">
              <input type="radio" id="technician-male" name="custGender" value="male" <?php echo isset($_POST['custGender']) && ($_POST['custGender'] == 'male') ? 'checked' : '' ?> />Male
            </label>
            <label for="">
              <input type="radio" id="technician-female" name="custGender" value="female" <?php echo isset($_POST['custGender']) && ($_POST['custGender'] == 'female') ? 'checked' : '' ?> />Female
            </label>
          </div>
          <div class="input-box">
            <input type="email" id="customer-email" name="custEmail" placeholder="Email" required value="<?php echo isset($_POST['custEmail']) ? htmlspecialchars($_POST['custEmail']) : ""; ?>" />
            <i class='bx bxs-envelope'></i>
          </div>
          <div class="input-box">
            <label class="errors">
              <?php echo $errors['password']; ?>
            </label>
            <input type="password" id="customer-password" name="custPassword" placeholder="Password" required />
            <i class='bx bxs-lock-alt'></i>
          </div>
          <div class="input-box">
            <input type="password" id="customer-confirm-password" name="custConfirmPassword" placeholder="Confirm Password" required />
            <i class='bx bxs-lock-alt'></i>
          </div>

          <div class="input-box">
            <input type="tel" id="customer-phone" name="custPhone" placeholder="Phone" required value="<?php echo isset($_POST['custPhone']) ? htmlspecialchars($_POST['custPhone']) : ""; ?>" />
            <i class='bx bxs-phone'></i>
          </div>
          <div class="file-box">
            <label for="customer-profilePicture">Upload Profile Picture (4x3)</label>
            <input type="file" id="customer-profilePicture" name="custProfilePicture" accept="image/png, image/jpeg" required />
          </div>
        </div>
        <button type="submit" id="signup" name="customerSubmitButton">Sign Up</button>

      </div>

    </form>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <div class="technician-form hidden">
        <div class="signup-form">
          <h3>Technician Sign Up</h3>
          <div class="input-box">
            <input type="text" id="technician-fullName" name="techFirstName" placeholder="First Name" required value="<?php echo isset($_POST['techFirstName']) ? htmlspecialchars($_POST['techFirstName']) : ""; ?>" />
            <i class='bx bxs-user'></i>
          </div>
          <div class="input-box">
            <input type="text" id="technician-lName" name="techMName" placeholder="Middle Name" required value="<?php echo isset($_POST['techMName']) ? htmlspecialchars($_POST['techMName']) : ""; ?>" />
            <i class='bx bxs-user'></i>
          </div>
          <div class="input-box">
            <input type="text" id="technician-gName" name="techLName" placeholder="Last Name" required value="<?php echo isset($_POST['techLName']) ? htmlspecialchars($_POST['techLName']) : ""; ?>" />
            <i class='bx bxs-user'></i>
          </div>
          <div class="input-box">
            <label class="errors">
              <?php echo $errors['username']; ?>
            </label>
            <input type="text" id="technician-fullName" name="techUsername" placeholder="Username" required value="<?php echo isset($_POST['techUsername']) ? htmlspecialchars($_POST['techUsername']) : ""; ?>" />
            <i class='bx bxs-user'></i>
          </div>
          <div class="gender-options">
            <p>Gender:</p>
            <label for="">
              <input type="radio" id="technician-male" name="techGender" value="male" <?php echo isset($_POST['techGender']) && ($_POST['techGender'] == 'male') ? 'checked' : '' ?> />Male
            </label>
            <label for="">
              <input type="radio" id="technician-female" name="techGender" value="female" <?php echo isset($_POST['techGender']) && ($_POST['techGender'] == 'female') ? 'checked' : '' ?> />Female
            </label>
          </div>
          <div class="input-box">
            <input type="date" id="technician-age" name="techAge" placeholder="Age" required value="<?php echo isset($_POST['techAge']) ? htmlspecialchars($_POST['techAge']) : ""; ?>" />
            <i class='bx bxs-calendar'></i>
          </div>
          <div class="input-box">
            <input type="email" id="technician-email" name="techEmail" placeholder="Email" required value="<?php echo isset($_POST['techEmail']) ? htmlspecialchars($_POST['techEmail']) : ""; ?>" />
            <i class='bx bxs-envelope'></i>
          </div>
          <div class="input-box">
            <label class="errors">
              <?php echo $errors['password']; ?>
            </label>
            <input type="password" id="technician-password" name="techPassword" placeholder="Password" required />
            <i class='bx bxs-lock-alt'></i>
          </div>
          <div class="input-box">
            <input type="password" id="technician-confirm-password" name="techConfirmPassword" placeholder="Confirm Password" required />
            <i class='bx bxs-lock-alt'></i>
          </div>
          <div class="input-box">
            <input type="tel" id="technician-phone" name="techPhone" placeholder="Phone" required value="<?php echo isset($_POST['techPhone']) ? htmlspecialchars($_POST['techPhone']) : ""; ?>" />
            <i class='bx bxs-phone'></i>
          </div>


          <div class="check-box">
            <p>Education Level:</p>

            <label for="technician-highSchool">
              <input type="checkbox" id="technician-highSchool" name="techEducationLevel" value="highSchool" <?php echo isset($_POST['techEducationLevel']) && ($_POST['techEducationLevel'] == 'highSchool') ? 'selected' : '' ?> />HighSchool
            </label>

            <label for="technician-bachelors">
              <input type="checkbox" id="technician-bachelors" name="techEducationLevel" value="bachelors" <?php echo isset($_POST['techEducationLevel']) && ($_POST['techEducationLevel'] == 'bachelors') ? 'selected' : '' ?> />Bachelor's
            </label>

            <label for="technician-masters">
              <input type="checkbox" id="technician-masters" name="techEducationLevel" value="masters" <?php echo isset($_POST['techEducationLevel']) && ($_POST['techEducationLevel'] == 'masters') ? 'selected' : '' ?> />Master's
            </label>
          </div>
          <div class="input-box">
            <div class="Skill">

              <select type="text" id="technician-skills" name="techSkills" placeholder="Skills" value="<?php echo isset($_POST['custFirstName']) ? htmlspecialchars($_POST['custFirstName']) : ""; ?>">
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == '') ? 'selected' : '' ?> value="" disabled selected>Select Skills</option>
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Carpentry') ? 'selected' : '' ?> value="Carpentry">Carpentry</option>
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Plumbing') ? 'selected' : '' ?> value="Plumbing">Plumbing</option>
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Electrical') ? 'selected' : '' ?> value="Electrical">Electrical</option>
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'HVAC') ? 'selected' : '' ?> value="HVAC">HVAC</option>
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Painting') ? 'selected' : '' ?> value="Painting">Painting</option>
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Dish Network') ? 'selected' : '' ?> value="Dish Network">Dish Network</option>
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Masonry') ? 'selected' : '' ?> value="Masonry">Masonry</option>
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Cementing') ? 'selected' : '' ?> value="Cementing">Cementing</option>
                <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Pest Control') ? 'selected' : '' ?> value="Pest Control">Pest Control</option>
              </select>
            </div>
          </div>
          <div class="input-box">
            <input type="number" id="technician-experience" name="techExperience" placeholder="Experience" required value="<?php echo isset($_POST['techExperience']) ? htmlspecialchars($_POST['techExperience']) : ""; ?>" />
            <i class='bx bx-briefcase'></i>
          </div>
          <div class="input-box">
            <input type="text" id="technician-availableLocation" name="techAvailableLocation" placeholder="Available Location" required value="<?php echo isset($_POST['techAvailableLocation']) ? htmlspecialchars($_POST['techAvailableLocation']) : ""; ?>" />
            <i class='bx bx-map'></i>
          </div>
          <div class="file-box">
            <div class="certificate">
              <label for="technician-certificate">Upload Education Certificate (PDF)</label>
              <input type="file" id="technician-certificate" name="techCertificate" accept="application/pdf" required />
            </div>
          </div>

          <div class="file-box">
            <div class="profile">
              <label for="customer-profilePicture">Upload Profile Picture (4x3)</label>
              <input type="file" id="customer-profilePicture" name="techProfilePicture" accept="image/png, image/jpeg" required />
            </div>
            <div class="ID">
              <label for="technician-id">Upload ID/Passport (PDF)</label>
              <input type="file" id="technician-certificate" name="techPassport" accept="application/pdf" required />
            </div>
          </div>
          <textarea id="technician-additionalBio" name="techAdditionalBio" placeholder="Additional Bio" required value="<?php echo isset($_POST['techAdditionalBio']) ? htmlspecialchars($_POST['techAdditionalBio']) : ""; ?>"></textarea>

        </div>
        <button type="submit" id="signup" name="technicianSubmitButton">Sign Up</button>

      </div>
    </form>

    <div class="info-text">
      <p>Do you have an account? <a href="./login.php">Login here</a>.</p>
      <p>
        By logging in, you agree to our
        <a href="#">Privacy Statement</a>.
      </p>
    </div>
  </div>


  <script src="script/fetch/UserFetch.js"></script>
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