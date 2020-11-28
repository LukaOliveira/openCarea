<?php
    if(isset($_POST['sub'])){
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
            //Deletes files no longer needed and redirects to the login page
    
            unlink('clientInstall.php');
            unlink('install.php');
            unlink('registeradm.php');
            unlink('configuredb.php');
            unlink('styleDb.css');
            unlink('styleInstall.css');
            
            header("Location: login.php");
        }
     
    
        mysqli_close($conn);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        document.getElementsByTagName('body')[0].innerHTML = "";
    </script>
    <link rel="stylesheet" href="./styleInstall.css" type="text/css"></link>
</head>
<body>
    <div id="loginBlock">
    <img src="./img/logo.png" alt="">
    <h1 class="pgTitle">By LukaOliveira</h1>
    <h3 class="pgTitle">github.com/LukaOliveira</h3><br><br>
    <hr>
    <form action="" method="POST" id='dbForm'>
        <label for="">E-mail: </label><br>
        <input type="email" name='admMail' required class='inp'><br><br>
        <label for="">First Name: </label><br>
        <input type="text" name='admName' required class='inp'><br><br>
        <label for="">Lastname: </label><br>
        <input type="text" name='admLastname' required class='inp'><br><br>
        <label for="">Password: </label><br>
        <input type="password" name='admPass' required class='inp'><br><br>
        <input type="submit" id='sub' name='sub'>
    </form>
    </div>
</body>
</html>