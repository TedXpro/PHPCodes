<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $id = $_POST['id'];
    $department = $_POST['department'];

    // Format student data
    $studentData = "Name: $name, ID: $id, Department: $department\n";

    // Open "student.txt" in append mode (a+) to create if not exists
    $file = fopen("student.txt", "a+");

    if ($file) {
        // Write student data to the file
        fwrite($file, $studentData);
        fclose($file);
        echo "Student information saved successfully!";
    } else {
        echo "Error saving student information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
</head>

<body>
    <nav>
        <p><a href="readFromFile.php">View Students</a></p>
        <p><a href="searchUpdateDelete.php">Search Update Delete</a></p>
    </nav>
    <h1>Student Information Form</h1>
    <form action="registerStudents.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="id">ID:</label>
        <input type="number" id="id" name="id" required><br><br>
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required><br><br>
        <button type="submit">Save Student</button>
    </form>
</body>

</html>