<?php
    include("database.php");

    session_start();

    $error = array();

    if(isset($_POST['sub'])){
        $mail =  mysqli_escape_string($conn, $_POST['mail']);
        $pass = mysqli_escape_string($conn, md5(md5($_POST['pass'])));

        $sql_code = "SELECT email FROM users WHERE email = '$mail'";

        $search = mysqli_query($conn, $sql_code);
        
        if(mysqli_num_rows($search) > 0){
            $sql_code = "SELECT * FROM users WHERE email = '$mail' AND pass = '$pass'";

            $search = mysqli_query($conn, $sql_code);

            if(mysqli_num_rows($search) == 1){
                $data = mysqli_fetch_array($search);

                $_SESSION['logged'] = true;
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['name'] = $data['name'];


                if($data['level'] == 8){
                    $_SESSION['level'] = $data['name'];
                    header('Location: homead.php');
                    
                }else{
                    header('Location: home.php');
                }
                

                
            }else{
                $error[] = "<h2>Incorrect username and/or password</h2>";
            }

        }else{
            $error[] = "<h2>Incorrect username and/or password</h2>";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styleLogin.css" type="text/css"></link>
    <script src="https://kit.fontawesome.com/cc2e664cc9.js" crossorigin="anonymous"></script>
</head>
<body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div id="loginBlock">
        <img src="./img/logo.png" alt="">
        <hr>
        <br>
        <h1 class="pgTitle">Login</h1><br>
        <form action="" id="dbForm" method="POST">
            <label for="" class='icon'><i class="fas fa-user"></i></label><input type="email" class="inp" name='mail' placeholder="E-mail" required><br><br>
            <label for="" class='icon'><i class="fas fa-lock"></i></label><input type="password" class="inp" name='pass' placeholder="Password" required><br><br>
            <input type="submit" id="sub" name='sub'>
        </form>
    </div>
</body>
</html>

<?php

    $size = sizeof($error);
    
    if($size > 0){
        for($i = 0; $i < $size; $i++){
            echo($error[$i]);
        }
    }
  

?>