<?php

    session_start();

    if(!isset($_SESSION['logged']) && $_SESSION['level'] == 1){
        header('Location: login.php');
    }

    include("database.php");

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Olá, <?php
    
        echo $_SESSION['name'];
    
    ?>!</h1>
</body>
</html>