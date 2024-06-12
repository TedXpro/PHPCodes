<?php

if (isset($_POST["search"])) {
    $searchId = $_POST['search_id'];

    // Define the file path
    $filePath = "student.txt";

    // Open the file for reading (r)
    $fileHandle = fopen($filePath, "r");

    if ($fileHandle) {
        $found = false;

        // Read each line of the file
        while (!feof($fileHandle)) {
            $line = fgets($fileHandle);

            // Search for line containing the ID
            if (strpos($line, "ID: $searchId,") !== false) {
                $found = true;
                echo "<h2>Search Result</h2>";

                // Prepare formatted student information (modify as needed based on your record format)
                $studentInfo = "";
                $lines = explode(",", trim($line)); // Split lines for easier handling
                foreach ($lines as $linePart) {
                    $infoParts = explode(":", $linePart); // Separate label and value
                    $studentInfo .= $infoParts[0] . ": " . (isset($infoParts[1]) ? trim($infoParts[1]) : "") . "<br>\n";
                }

                echo "<pre>" . $studentInfo . "</pre>"; // Display formatted student information

                break; // Stop searching after finding the record
            }
        }

        if (!$found) {
            echo "<h2>Search Result</h2>";
            echo "<p>Student with ID: $searchId not found.</p>";
        }

        fclose($fileHandle);
    } else {
        echo "Error opening file: $filePath";
    }
}

?>

<?php

if (isset($_POST["update"])) {
    $updateId = $_POST['update_id'];
    $updateName = isset($_POST['update_name']) ? $_POST['update_name'] : null; // Optional update
    $updateDepartment = isset($_POST['update_department']) ? $_POST['update_department'] : null; // Optional update

    $updatedData = [];

    // Define the file path
    $filePath = "student.txt";
    $tempFilePath = "studentTemp.txt";

    // Open the file for reading (r) and writing (w)
    $fileHandle = fopen($filePath, "r+");
    $tempFileHandle = fopen($tempFilePath, "w");

    if ($fileHandle) {
        $found = false;
    }
    // Read each line of the file
    while (!feof($fileHandle)) {
        $line = fgets($fileHandle);

        // Check if the line contains the ID to update
        if (strpos($line, "ID: $updateId") === false) {
            fwrite($tempFileHandle, $line);
        } else {
            $newLine ="Name: $updateName, ID: $updateId, Department: $updateDepartment\n";
            fwrite($tempFileHandle, $newLine);
        }
    }

    fclose($tempFileHandle);
    fclose($fileHandle);

    $fileHandle = fopen($filePath, "w");
    $tempFileHandle = fopen($tempFilePath, "r");

    while(!feof($tempFileHandle)){
        $line = fgets($tempFileHandle);
        fwrite($fileHandle, $line);
    }

    fclose($tempFileHandle);
    fclose($fileHandle);
}   
?>

<?php

if (isset($_POST["delete"])) {
    $deleteId = $_POST['delete_id'];

    // Define the file path
    $filePath = "student.txt";
    $tempFilePath = "studentTemp.txt";

    // Create a temporary file for the updated content
    // $tempFilePath = tempnam(sys_get_temp_dir(), 'student_records');

    // Open the original file for reading (r)
    $originalFileHandle = fopen($filePath, "r");

    // Open the temporary file for writing (w)
    $tempFileHandle = fopen($tempFilePath, "w");

    if ($originalFileHandle && $tempFileHandle) {
        $found = false;

        // Read each line of the original file
        while (!feof($originalFileHandle)) {
            $line = fgets($originalFileHandle);

            // Skip line containing the ID to delete
            if (strpos($line, "ID: $deleteId") === false) {
                fwrite($tempFileHandle, $line); // Write line to temporary file
            } else {
                $found = true;
            }
        }

        if ($found) {
            echo "<h2>Delete Result</h2>";
            echo "<p>Student with ID: $deleteId deleted successfully.</p>";
        } else {
            echo "<h2>Delete Result</h2>";
            echo "<p>Student with ID: $deleteId not found.</p>";
        }

        fclose($originalFileHandle);
        fclose($tempFileHandle);

        $originalFileHandle = fopen($filePath, "w");
        $tempFileHandle = fopen($tempFilePath, "r");


        while(!feof($tempFileHandle)){
            $line = fgets($tempFileHandle);
            fwrite($originalFileHandle, $line);

        }
        fclose($originalFileHandle);
        fclose($tempFileHandle);

    } else {
        echo "Error opening files.";
    }
}

?>

<?php setcookie('jo', "whats up", time() - (86400), '/'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records Management</title>
</head>

<body>
    <?php 
        if(isset($_COOKIE['jo'])){
            echo $_COOKIE['jo'];
        }
    ?>

    <h1>Student Records Management</h1>

    <h2>Search Student</h2>
    <form action="searchUpdateDelete.php" method="post">
        <label for="search_id">Search by ID:</label>
        <input type="number" id="search_id" name="search_id" required><br><br>
        <button type="submit" name="search">Search</button>
    </form>

    <h2>Update Student</h2>
    <form action="searchUpdateDelete.php" method="post">
        <label for="update_id">ID to Update:</label>
        <input type="number" id="update_id" name="update_id" required><br><br>
        <label for="update_name">New Name (Optional):</label>
        <input type="text" id="update_name" name="update_name"><br><br>
        <label for="update_department">New Department (Optional):</label>
        <input type="text" id="update_department" name="update_department"><br><br>
        <button type="submit" name="update">Update</button>
    </form>

    <h2>Delete Student</h2>
    <form action="searchUpdateDelete.php" method="post">
        <label for="delete_id">ID to Delete:</label>
        <input type="number" id="delete_id" name="delete_id" required><br><br>
        <button type="submit" name="delete">Delete</button>
    </form>

</body>

</html>