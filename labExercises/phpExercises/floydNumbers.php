<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floyd Numbers</title>
</head>
<body>
    <form action="floydNumbers.php" method="POST">
        <label for="number">Enter a Number to display the first n Floyd Numbers:</label>
        <input type="text" name="number">
        <input type="submit" value="submit" name="submit">
    </form>    

    <?php
        if(isset($_POST["submit"])){
            $number = $_POST["number"]; 
            $output = "";
            $num = 1;
            for($i = 1; $i <= $number; $i++){
                for($j = 1; $j <= $i; $j++){
                    $output .= "$num ";
                    $num++;
                }
                $output .= "<br>";
            }

            echo $output;
        }
    ?>
</body>
</html>