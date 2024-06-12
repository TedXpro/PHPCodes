<?php
include("config/db_connect.php");

$errors = array('email' => '', 'title' => '', 'ingredients' => '');

if (isset($_POST["submit"])) {
    // check Email
    if (empty($_POST["email"])) {
        $errors['email'] = "An email is required <br/>";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "email must be a valid email address";
        }
    }

    // check title
    if (empty($_POST["title"])) {
        $errors['title'] = "A title is required <br/>";
    } else {
        $title = $_POST["title"];
        $regex = '/^[a-zA-Z\s]+$/';
        if (!preg_match($regex, $title)) {
            $errors['title'] = "title must be letters and spaces only";
        }
    }

    // check ingredients
    if (empty($_POST["ingredients"])) {
        $errors['ingredients'] = "At least one ingredient is required <br/>";
    } else {
        $ingredients = $_POST["ingredients"];
        $regex = '/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/';
        if (!preg_match($regex, $ingredients)) {
            $errors['ingredients'] = "Ingredients must be a comma separated list";
        }
    }

    if (array_filter($errors)) {
        echo "errors in the form";
    } else {
        // protect from sql injection
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        // create sql
        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES ('$title', '$email', '$ingredients')";

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
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="white">
        <label for="email">Your Email</label>
        <input type="text" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ""; ?>">
        <div class="red-text"><?php echo $errors["email"] ?></div>
        <label for="title">Pizza Title</label>
        <input type="text" name="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ""; ?>">
        <div class="red-text"><?php echo $errors["title"] ?></div>
        <label for="ingredients">Ingredients (comma separated):</label>
        <input type="text" name="ingredients" value="<?php echo isset($_POST['ingredients']) ? htmlspecialchars($_POST['ingredients']) : ""; ?>">
        <div class="red-text"><?php echo $errors["ingredients"] ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php') ?>

</html>