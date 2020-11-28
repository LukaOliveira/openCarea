<?php
    session_start();

    if(!isset($_SESSION['logged'])){
        header('Location: login.php');
    }else{
        if($_SESSION['logged'] != 8){
            header('Location: login.php');
        }
    }

    $id = $_SESSION['user_id'];

    require_once 'database.php';
    $data = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");

    $clients = mysqli_fetch_array(mysqli_query($conn, "SELECT name, email FROM users WHERE level = 1"));
    $clients = json_encode($clients);


    
    if(isset($_POST['env'])){
        $fname =  mysqli_escape_string($conn, $_POST['fname']);
        $lname =  mysqli_escape_string($conn, $_POST['lname']);
        $mail =  mysqli_escape_string($conn, $_POST['mail']);
        $pass = mysqli_escape_string($conn, md5(md5($_POST['pass'])));
        $type =  mysqli_escape_string($conn, $_POST['type']);

        if($type == 1){
            $type = 1;
        }else{
            $type = 8;
        }

        $sql_code = "INSERT INTO users (name, sname, email, pass, level, caddate) VALUES ('$fname', '$lname', '$mail', '$pass', '$type', NOW());";

        if(!mysqli_query($conn, $sql_code)){
            echo("<script>alert('Failed to register')</script>");
        }else{
            echo("<script>alert('Success when registering')</script>");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php echo ("<script>var clients = $clients</script>");?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        *{
            margin: 0;
            padding: 0;
        }
        body{
            font-family: 'Roboto', sans-serif;
            background: rgb(238,174,255);
            background: linear-gradient(159deg, rgba(238,174,255,1) 0%, rgba(148,187,233,1) 100%);
            
        }
        nav{
            width: 100%;
            border: 1px solid black;
            height: 60px;
            padding: 10px;
            position: fixed;
            z-index: 1;
            background-color: white;
        }
        nav ul{
            list-style: none;
        }
        nav ul li{
            float: left;
            margin-left: 25px;
            text-align: center;
        }
        .userTile{
            
        }
        #listOp{
            text-align: center;
            line-height: 45px;
        }
        .btnOp{
            padding: 10px;
            border: 1px solid black;
            color: black;
            text-decoration: none;
            border-radius: 8px;
        }
        .btnOp:hover, #env:hover{
            transition: 0.2s;
            background-color: rgb(46, 46, 46);
            color: white;
        }
        #registerCli{
            text-align: center;
            border-bottom: 1px solid black;
        }
        .vertSep{
            margin-left: 5px;
        }
        #env{
            padding: 5px;
            width: 70px;
            border-radius: 5px;
            border: 1px solid black;
            cursor: pointer;
            color: black;
            background-color: transparent;
            outline: none;
        }
        .inp{
            width: 200px;
            transition: 0.2s;
            text-align: center;
            padding: 5px;
            border-radius: 20px;
            border: 2px solid rgb(0, 217, 255);
            outline: none;
        }
        .inp:focus{
            transition: 0.2s;
            border: 2px solid black;
            width: 225px;
        }
        .title{
            padding: 5px;
            border: 2px solid white;
            width: 35%;
            margin: 0 auto;
            border-radius: 10px;
            padding-top: 7px; 
            padding-bottom: 7px; 
        }
        .t1{
            width: 26%;
        }
        .search{
            width: 400px;
            padding: 10px;
            border: 2px solid rgb(0, 217, 255);
            text-align: center;
            border-radius: 20px;
            outline: none;
        }
        #blockShow{
            width: 70%;
            height: 300px;
            border: 2px solid black;
            margin: 0 auto;
            padding: 5px;

        }
        #editCli{
            text-align: center;
            border-bottom: 1px solid black;
        }
    </style>
</head>
<body>
    <nav>
        <ul id="listOp">
            <li><h2 class="userTile">Hello, <?php  echo $_SESSION['name'];   ?>!</h2></li>
            <li><a href="#" class="btnOp">Register a new client/contributor</a></li>
            <li><a href="#env" class="btnOp">Edit a client</a></li>
            <li><a href="logout.php" class="btnOp logout">Logout</a></li>
        </ul>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div id="registerCli">
        <br>
        <h1 class='title'>Register a new client/contributor</h1><br><br>
        <form action="" method='POST'>
            <label for="">First Name</label><br><input type="text" required name="fname" class='inp'><br><br>
            <label for="">Last Name</label><br><input type="text" required name="lname" class='inp'><br><br>
            <label for="">E-mail</label><br><input type="email" required name="mail" class='inp'><br><br>
            <label for="">Password</label><br><input type="password" required name="pass" class='inp'><br><br>
            <label for="">Type</label><br>
            <label for='chos1'>Client </label><input type="radio" name='type' value='1' id='chos1' required><span class='vertSep'></span><label for="chos2"> Contributor </label><input type="radio" name='type' value='2' id='chos2' required><br><br>
            <input type="submit" name='env' id='env'>
        </form>
        <br>
    </div>
    <div id="editCli">
        <br>
        <h1 class='title t1'>Edit a client/contributor</h1><br><br>
        <form action="" method=''>
            <label>Enter customer name</label><br><input type="text" class='search' id="search" placeholder = "Type a name or email">
        </form>
        <br>
        <div id="blockShow">
            <p>The result will appear here...</p>
    </div>
    
    <script>
        $('#search').keyup(function(){
            let busca = $('#search').val()
            busca = new RegExp(busca, "i")
            $('#blockShow').html("")

            $(clients).each(function(index, item){

                if($('#search').val() != ""){
                    if(item.name.match(busca)){
                        $('#blockShow').append('<div class="client">'+item.name+" | "+item.email+"</div><br/>")
                
                    }
                }else{
                    $('#blockShow').append("<p>The result will appear here...</p>")
                }
            })

        $(".client").click(function(){
            alert($(this).text())
        })
        })
    </script>
</body>
</html>