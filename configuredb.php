<?php
    $serverName = $_POST["host"];
    $dataBase = $_POST["dbname"];
    $username = $_POST["dbuser"];
    $password = $_POST["dbpass"];
 
    $conn = mysqli_connect($serverName, $username, $password, $dataBase);
    $isFail = "";
    
    

    if(!$conn){
        echo("Failed to connect to the database, check the data entered!: ".mysqli_connect_error());
        $isFail = "0";
        echo("<script> var isFail = $isFail </script>");
    }else{
        $dbform = '<?php
        $serverName = "'.$_POST["host"].'";
        $dataBase = "'.$_POST["dbname"].'";
        $username = "'.$_POST["dbuser"].'";
        $password = "'.$_POST["dbpass"].'";
 
        $conn = mysqli_connect($serverName, $username, $password, $dataBase);
 
        if(!$conn){
            die("Failed to connect to the database, check the data entered!: ".mysqli_connect_error());
        }
        ?>';

        $arquivo = "database.php";

        $opArquivo = fopen($arquivo, "a");

        fwrite($opArquivo, $dbform);

        fclose($opArquivo);

        mysqli_query($conn, "CREATE TABLE users(id int(11) AUTO_INCREMENT, name varchar(30), sname varchar(30), email varchar(60), pass varchar(32), level tinyint(4), caddate datetime(4), PRIMARY KEY (id))");

        mysqli_close($conn);
        $isFail = "1";
        echo("<script> var isFail = $isFail </script>");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installing...</title>
</head>
<body>
    <script>
        
        if(isFail == 1){
            document.write('<div id="loginBlock"><img src="./img/logo.png" alt=""><h1 class="pgTitle">By LukaOliveira</h1><h3 class="pgTitle">github.com/LukaOliveira</h3><br><br><hr>')
            document.write("<h1>Database successfully configured!</h1>")
            document.write("<br><br><a href='registeradm.php' id='backBtn'>Register an administrator</a></div>")
        }else{
            document.getElementsByTagName('body')[0].innerHTML = ""
            document.write('<div id="loginBlock"><img src="./img/logo.png" alt=""><h1 class="pgTitle">By LukaOliveira</h1><h3 class="pgTitle">github.com/LukaOliveira</h3><br><br><hr>')
            document.write("<h1>Failed to connect to the database, check the information!</h1>")
            document.write("<br><br><a href='install.php' id='backBtn'>Back to configuration</a></div>")
        }
        document.getElementsByTagName('head')[0].innerHTML += "<link rel='stylesheet' href='./styleDb.css' type='text/css'></link>"
    </script>
    
</body>
</html>
