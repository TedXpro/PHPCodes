<!DOCTYPE html>
<html>
<head>
    <title>Find Maximum in Multi-Dimensional Array</title>
</head>
<body>
    <?php
    function findMaxInMultiDimArray($array) {
        $max = PHP_INT_MIN; // Start with the smallest possible integer value

        array_walk_recursive($array, function($value) use (&$max) {
            if ($value > $max) {
                $max = $value;
            }
        });

        return $max;
    }

    // Example multi-dimensional array
    $multiDimArray = [
        [3, 5, 7],
        [1, 6, 9, 12],
        [8, -2],
        [10, 15, -1, 4]
    ];

    // Find the maximum value
    $maxValue = findMaxInMultiDimArray($multiDimArray);

    echo "<h1>Multi-Dimensional Array:</h1>";
    echo "<pre>" . print_r($multiDimArray, true) . "</pre>";
    echo "<p>The maximum value in the array is: " . $maxValue . "</p>";
    ?>
</body>
</html>
