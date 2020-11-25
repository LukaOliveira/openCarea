<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install Client Area</title>
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
    <nav>
        <h1 class="pgTitle">Client Area Installer By LukaOliveira</h1>
        <h3 class="pgTitle">github.com/LukaOliveira</h3><br><br>
    </nav>
    <form action="./install.php" method="POST" id="dbForm">
        <label for="">Hostname of your database: </label><br><input type="text" name="host" required class="inp"><br><br>
        <label for="">Your database name: </label><br><input type="text" name="dbname" required class="inp"><br><br>
        <label for="">Username of your database: </label><br><input type="text" name="dbuser" required class="inp"><br><br>
        <label for="">Password of your database: <span class="op">Optional</span></label><br><input type="password" name="dbpass" class="inp"><br><br>
        <input type="submit" id="sub">
    </form>
    

</body>
</html>