<!DOCTYPE html>
<html>
<head>
    <title>Session Management</title>
</head>
<body>
    <h2>Session Management in PHP</h2>
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
                $_SESSION['username'] = 'JohnDoe';
                echo "<p>Session 'username' created with value 'JohnDoe'.</p>";
                break;
            case 'read':
                if (isset($_SESSION['username'])) {
                    echo "<p>Session 'username' value is: " . $_SESSION['username'] . "</p>";
                } else {
                    echo "<p>Session 'username' does not exist.</p>";
                }
                break;
            case 'delete':
                if (isset($_SESSION['username'])) {
                    unset($_SESSION['username']);
                    echo "<p>Session 'username' deleted.</p>";
                } else {
                    echo "<p>Session 'username' does not exist.</p>";
                }
                break;
        }
    }
    ?>
</body>
</html>
