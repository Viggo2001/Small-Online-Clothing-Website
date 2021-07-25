<?php

    $conn = mysqli_connect('localhost', 'ono', 'graphic4', 'items(w)');

    if (!$conn) {
        echo 'connection error ' . mysqli_connect_error();
    }

?>