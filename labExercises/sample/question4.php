<!DOCTYPE html>
<html>
<head>
    <title>Palindrome Checker</title>
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
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            padding: 8px;
            margin: 10px;
            width: 300px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Palindrome Checker</h2>
        <form method="post">
            <label for="input">Enter a string:</label>
            <br>
            <input type="text" id="input" name="input" required>
            <br>
            <input type="submit" value="Check">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = $_POST['input'];
            $input = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $input)); // Remove non-alphanumeric characters and convert to lowercase
            $reverse = strrev($input); // Reverse the string

            if ($input == $reverse) {
                echo "<p class='result'> '$input' is a palindrome!</p>";
            } else {
                echo "<p class='result'> '$input' is not a palindrome!</p>";
            }
        }
        ?>
    </div>
</body>
</html>
