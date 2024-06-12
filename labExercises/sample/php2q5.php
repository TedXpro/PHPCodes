<!DOCTYPE html>
<html>
<head>
    <title>File Operations</title>
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
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], textarea {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        input[type="submit"], button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #45a049;
        }
        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>File Operations</h2>

        <!-- Search Form -->
        <form method="post">
            <label for="searchText">Search Text:</label>
            <input type="text" id="searchText" name="searchText" required>
            <input type="submit" name="search" value="Search">
        </form>

        <!-- Update Form -->
        <form method="post">
            <label for="updateText">Update Text:</label>
            <input type="text" id="updateText" name="updateText" required>
            <textarea id="updateContent" name="updateContent" rows="4" required></textarea>
            <input type="submit" name="update" value="Update">
        </form>

        <!-- Delete Form -->
        <form method="post">
            <label for="deleteText">Delete Text:</label>
            <input type="text" id="deleteText" name="deleteText" required>
            <input type="submit" name="delete" value="Delete">
        </form>

        <?php
        // File path
        $filePath = 'file.txt';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Search operation
            if (isset($_POST['search'])) {
                $searchText = $_POST['searchText'];
                searchContent($filePath, $searchText);
            }
            
            // Update operation
            if (isset($_POST['update'])) {
                $updateText = $_POST['updateText'];
                $updateContent = $_POST['updateContent'];
                updateContent($filePath, $updateText, $updateContent);
            }
            
            // Delete operation
            if (isset($_POST['delete'])) {
                $deleteText = $_POST['deleteText'];
                deleteContent($filePath, $deleteText);
            }
        }

        // Function to search content in file
        function searchContent($filePath, $searchText) {
            $file = fopen($filePath, "r");
            $found = false;
            while (!feof($file)) {
                $line = fgets($file);
                if (strpos($line, $searchText) !== false) {
                    echo "<p>Found: $line</p>";
                    $found = true;
                }
            }
            fclose($file);
            if (!$found) {
                echo "<p>No matching content found.</p>";
            }
        }

        // Function to update content in file
        function updateContent($filePath, $updateText, $updateContent) {
            $fileData = file_get_contents($filePath);
            $updatedData = str_replace($updateText, $updateContent, $fileData);
            file_put_contents($filePath, $updatedData);
            echo "<p>Content updated successfully!</p>";
        }

        // Function to delete content from file
        function deleteContent($filePath, $deleteText) {
            $fileData = file_get_contents($filePath);
            $updatedData = str_replace($deleteText, '', $fileData);
            file_put_contents($filePath, $updatedData);
            echo "<p>Content deleted successfully!</p>";
        }
        ?>
    </div>
</body>
</html>
