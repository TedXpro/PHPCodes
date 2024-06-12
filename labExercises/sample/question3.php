<!DOCTYPE html>
<html>
<head>
    <title>Find Greatest and Smallest in Array</title>
</head>
<body>
    <?php
    function findMinMax($arr) {
        if (empty($arr)) {
            return ["min" => null, "max" => null];
        }

        $min = $arr[0];
        $max = $arr[0];

        foreach ($arr as $value) {
            if ($value < $min) {
                $min = $value;
            }
            if ($value > $max) {
                $max = $value;
            }
        }

        return ["min" => $min, "max" => $max];
    }

    // Example array
    $numbers = [3, 5, 1, 9, -2, 8, 7];

    // Find min and max
    $result = findMinMax($numbers);
    $min = $result["min"];
    $max = $result["max"];

    echo "<h1>Array: " . implode(", ", $numbers) . "</h1>";
    echo "<p>The smallest number is: " . $min . "</p>";
    echo "<p>The greatest number is: " . $max . "</p>";
    ?>
</body>
</html>
