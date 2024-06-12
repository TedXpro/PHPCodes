<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Max in MultiDimensional array</title>
</head>

<body>

    <?php
    $array = array(
        array(1, 2, 3, 4, 5),
        array(10, 20, 30, 40),
        array(99, -1, -3, -5, -6), 
        array(1, 0, 4, 5, 9)
    );
    echo print_r($array);
    $maxNum = -INF;
    foreach($array as $arr) {
        $currMax = max($arr);
        $maxNum = max($currMax, $maxNum);
    }
    echo "</p>The maximum number inside this array is: $maxNum</p>" 
    ?>
</body>

</html>