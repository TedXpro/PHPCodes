<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read From file</title>
</head>

<body>
    <nav>
        <p><a href="registerStudents.php">Back to Register</a></p>
        <p><a href="searchUpdateDelete.php">Search Update Delete</a></p>
    </nav>
    <?php

    // Define the file path
    $filePath = "student.txt";

    // Open the file for reading (r)
    $fileHandle = fopen($filePath, "r");

    // Check if the file was opened successfully
    if ($fileHandle) {
        echo "<h2>Student Records</h2>";
        echo "<ul>";

        // Read each line of the file until the end (feof)
        while (!feof($fileHandle)) {
            // Read a single line from the file
            $line = fgets($fileHandle);

            // Check if the line is not empty (avoid blank lines)
            if (!empty(trim($line))) {
                echo "<li>" . trim($line) . "</li>"; // Display the line with leading/trailing whitespace removed
            }
        }

        echo "</ul>";

        // Close the file
        fclose($fileHandle);
    } else {
        echo "Error opening file: $filePath";
    }

    ?>

</body>

</html>