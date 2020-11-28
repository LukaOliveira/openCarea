<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install Client Area</title>
    <link rel="stylesheet" href="./styleInstall.css" type="text/css"></link>
  
</head>
<body>
    <div id="loginBlock">
    <img src="./img/logo.png" alt="">
    <h1 class="pgTitle">By LukaOliveira</h1>
    <h3 class="pgTitle">github.com/LukaOliveira</h3><br><br>
    <hr>
    
    <form action="./configuredb.php" method="POST" id="dbForm">
        <label for="">Hostname: </label><br><input type="text" name="host" required class="inp"><br><br>
        <label for="">Database name: </label><br><input type="text" name="dbname" required class="inp"><br><br>
        <label for="">MySql Username: </label><br><input type="text" name="dbuser" required class="inp"><br><br>
        <label for="">MySql Password: <span class="op">(Optional)</span></label><br><input type="password" name="dbpass" class="inp"><br><br>
        <input type="submit" id="sub">
    </form>
    </div>
    

</body>
</html>