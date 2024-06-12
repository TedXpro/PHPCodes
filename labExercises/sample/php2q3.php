<!DOCTYPE html>
<html>
<head>
    <title>Student Information Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
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
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
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

        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Information Form</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br><br>
            
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required>
            <br><br>
            
            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>
            <br><br>
            
            <input type="submit" name="submit" value="Save">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Get form data
            $name = $_POST['name'];
            $id = $_POST['id'];
            $department = $_POST['department'];

            // Data to be saved
            $studentData = "Name: $name, ID: $id, Department: $department" . PHP_EOL;

            // File path
            $filePath = 'student.txt';

            // Save data to file
            if (file_put_contents($filePath, $studentData, FILE_APPEND | LOCK_EX)) {
                echo "<p>Student information saved successfully!</p>";
            } else {
                echo "<p>Error saving student information.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
