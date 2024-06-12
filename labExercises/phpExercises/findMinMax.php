<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Min and Max of a array</title>
</head>
<body>
    <form action="findMinMax.php" method="post">
        <label for="array">Enter the numbers using comma separated</label>
        <input type="text" name="array">
        <input type="submit" value="submit" name="submit">
    </form>

    <?php 
        if(isset($_POST['submit'])){
            $given = $_POST['array'];
            $array = array_map('intVal', explode(',', $given));
            $minVal = min($array);
            $maxVal = max($array);
            echo "<p>The minimum number inside the array is $minVal</p>";
            echo "<p>The maximum number inside the array is $maxVal</p>";

        }
    ?>

</body>
</html>