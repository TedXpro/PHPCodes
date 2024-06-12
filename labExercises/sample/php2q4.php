<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Records</h2>
        <?php
        // File path
        $filePath = 'student.txt';

        // Check if file exists
        if (file_exists($filePath)) {
            // Open file for reading
            $file = fopen($filePath, "r");

            // Read file line by line
            while (!feof($file)) {
                // Read the current line
                $record = fgets($file);
                // Display the record
                echo "<p>$record</p>";
            }

            // Close the file
            fclose($file);
        } else {
            echo "<p>No student records found.</p>";
        }
        ?>
    </div>
</body>
</html>
