<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echo name</title>
</head>

<body>
    <form action="echoName.php" method="POST">
        <label for="name">Enter Your Name</label>
        <input type="text" name="name">

        <input type="submit" name="submit" value="submit">

    </form>
    <?php
    $display = '';
    if (isset($_POST['submit'])) {
        $display = "Hello {$_POST['name']}!";
    }

    echo "<p>$display</p>";
    ?>

</body>

</html>