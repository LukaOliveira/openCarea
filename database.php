<?php
        $serverName = "localhost";
        $dataBase = "userstest";
        $username = "root";
        $password = "";
 
        $conn = mysqli_connect($serverName, $username, $password, $dataBase);
 
        if(!$conn){
            die("Failed to connect to the database, check the data entered!: ".mysqli_connect_error());
        }
        ?>