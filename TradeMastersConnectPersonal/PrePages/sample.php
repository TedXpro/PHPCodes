<?php
    require("../configDB/configDatabase.php");
    $sql = "SELECT `Photo Link` from customer where UserName = 'mko';";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    $result = $result['Photo Link'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php echo "hi"; ?>
    <img src="<?php echo $result; ?>" alt="photoLink">
    <script src="script.js"></script>
</body>

</html>