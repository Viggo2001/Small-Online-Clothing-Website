<?php

    $conn = mysqli_connect('localhost', 'ono', 'graphic4', 'viggo_pizzas');

    if (!$conn) {
        echo 'connection error ' . mysqli_connect_error();
    }

?>