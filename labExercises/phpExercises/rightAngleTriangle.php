<?php
$answer = '';
if (isset($_POST["submit"])) {
    $sum = $_POST["side1"] ** 2 + $_POST["side2"] ** 2;
    $answer = sqrt($sum);
    $answer = "the hypotenuse is $answer";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find the Hypotenuse</title>
</head>

<body>
    <form action="rightAngleTriangle.php" method="POST">
        <label for="side1">Enter Side 1</label>
        <input type="number" name="side1">
        <label for="side2">Enter Side 2</label>
        <input type="number" name="side2">
        <input type="submit" name="submit" value="submit">

        <div name=answer>
            <?php
            echo $answer;
            $answer = '';
            echo $answer; ?></div>
    </form>

</body>

</html>