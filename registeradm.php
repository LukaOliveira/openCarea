<?php
    include("database.php");
    $admEmail = $_POST['admMail'];
    $name = $_POST['admName'];
    $lastname = $_POST['admLastname'];
    $pass = $_POST['admPass'];

    $pass = md5(md5($pass));

    $sql_code = "
    INSERT INTO users (name, sname, email, pass, level, caddate)
    VALUES
    ('$name',
    '$lastname',
    '$admEmail',
    '$pass',
    8,
    NOW());
    ";
    if(!mysqli_query($conn, $sql_code)){
        echo "falha";
    }else{
        unlink('clientInstall.php');
        unlink('install.php');
        unlink('registeradm.php');
        unlink('registeradmform.php');
        header("Location: login.php");
    }
 

    mysqli_close($conn);
?>