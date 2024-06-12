<!DOCTYPE html>
<html>
<head>
    <title>Floyd's Triangle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="number"] {
            padding: 8px;
            margin: 10px;
            width: 60px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .result {
            text-align: center;
            margin-top: 20px;
        }
        .triangle {
            text-align: left;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Floyd's Triangle</h2>
        <form method="post">
            <label for="lines">Enter number of lines:</label>
            <input type="number" id="lines" name="lines" min="1" required>
            <input type="submit" value="Generate">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $n = intval($_POST['lines']);
            $number = 1;
            echo "<div class='triangle'>";
            for ($i = 1; $i <= $n; $i++) {
                for ($j = 1; $j <= $i; $j++) {
                    echo $number . " ";
                    $number++;
                }
                echo "<br>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
