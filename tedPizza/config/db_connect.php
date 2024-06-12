<?php 
    $conn = mysqli_connect('localhost', 'yohannes', 'test1234', 'tedPizza');

    // check for connection
    if (!$conn) {
        echo "Connection error: " . mysqli_connect_error();
    }
    
?>