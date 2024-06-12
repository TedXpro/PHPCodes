<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Palindrome</title>
</head>

<body>
    <h2>Check Palindrome</h2>
    <form action="checkPalindrome.php" method="post">
        <label for="string">Enter a String</label>
        <input type="text" name="string">
        <input type="submit" value="submit" name="submit">
    </form>
    <?php 
        if(isset($_POST['submit'])){
            $given = $_POST["string"];
            $revGiven = strrev($given);

            if($given === $revGiven)
                echo "the given string is a palindrome";
            else 
                echo "the given string is not a palindrome";
        }
        
    ?>
</body>

</html>