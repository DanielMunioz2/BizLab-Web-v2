<?php

    $conn = new mysqli("localhost:3306", "root", "D@n!#l!ll01188390", "bizlab");

    if($conn->connect_error){
        die("Hubo un fallo en la conexión". $conn->$connect_error);
    };
    
?>