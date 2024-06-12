<!DOCTYPE html>
<html>

<head>
    <title>Session</title>
</head>

<body>
    <h2>Session</h2>
    <form method="post">
        <button type="submit" name="action" value="create">Create Session</button>
        <button type="submit" name="action" value="read">Read Session</button>
        <button type="submit" name="action" value="delete">Delete Session</button>
    </form>

    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = $_POST['action'];

        switch ($action) {
            case 'create':
                $_SESSION['name'] = 'Yohannes';
                echo "<p>Session 'name' created with value 'Yohannes'.</p>";
                break;
            case 'read':
                if (isset($_SESSION['name'])) {
                    echo "<p>Session 'name' value is: " . $_SESSION['name'] . "</p>";
                } else {
                    echo "<p>Session 'name' does not exist.</p>";
                }
                break;
            case 'delete':
                if (isset($_SESSION['name'])) {
                    unset($_SESSION['name']);
                    echo "<p>Session 'name' deleted.</p>";
                } else {
                    echo "<p>Session 'name' does not exist.</p>";
                }
                break;
        }
    }
    ?>
</body>

</html>