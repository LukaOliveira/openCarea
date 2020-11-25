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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        *{
            padding: 0;
            margin: 0;
            font-family: inherit;
        }
        body{
            background: rgb(238,174,202);
            background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
        }
        .pgTitle{
            font-family: 'Roboto', sans-serif;
            text-align: center;
            margin-top: 2%;
        }
        #dbForm{
            font-family: 'Roboto', sans-serif;
            margin: 0 auto;
            width: 300px;
            border: 1px solid black;
            text-align: center;
            font-size: 20px;
            padding: 75px;
            border-radius: 0px 25px 0px 25px;
            background-color: rgba(255, 255, 255, 0.418);
            
        }
        .inp{
            transition: 0.2s;
            width: 200px;
            padding: 5px;
            border-radius: 15px;
            border: 3px solid rgb(0, 217, 255);
            outline: none;
            text-align: center;
        }
        .inp:focus{
            transition: 0.2s;
            width: 225px;
            border: 3px solid rgb(14, 255, 122);
        }
        #sub{
            transition: 0.2s;
            padding: 5px;
            width: 100px;
            font-weight: bold;
            cursor: pointer;
            background-color: transparent;
            color: black;
            border: 2px solid black;
            outline: none;
            border-radius: 15px;
        }
        #sub:hover{
            transition: 0.2s;
            background-color: black;
            color: white;
        }
        .op{
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div>
        <h1 class="pgTitle">Login</h1><br>
        <form action="" id="dbForm" method="POST">
            <label for="">E-mail: </label><br><input type="email" class="inp" name='mail' placeholder="example@domain.com" required><br><br>
            <label for="">Password: </label><br><input type="password" class="inp" name='pass' required><br><br>
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