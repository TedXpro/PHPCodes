<?php
    $conn = mysqli_connect('localhost', 'yohannes', 'test1234', 'computer science department');
    if (!$conn) {
        echo "Connection error: " . mysqli_connect_error();
    }
?>