<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right-Angle Triangle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input[type="number"] {
            width: 100px;
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Find the Length of the Third Side of a Right-Angle Triangle</h2>
        <form method="post">
            <label for="side1">Length of Side 1:</label>
            <input type="number" id="side1" name="side1" required>
            <label for="side2">Length of Side 2:</label>
            <input type="number" id="side2" name="side2" required>
            <input type="submit" value="Calculate">
        </form>
        <?php
        function calculate_third_side($side1, $side2) {
            if ($side1 < 0 || $side2 < 0) {
                return "Invalid input: Side lengths must be non-negative numbers.";
            }
            $third_side = sqrt(pow($side1, 2) + pow($side2, 2));
            return $third_side;
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $side1 = $_POST["side1"];
            $side2 = $_POST["side2"];
            $third_side = calculate_third_side($side1, $side2);
            echo "<p>For sides $side1 and $side2, the length of the third side is: $third_side</p>";
        }
        ?>
    </div>
</body>
</html>
