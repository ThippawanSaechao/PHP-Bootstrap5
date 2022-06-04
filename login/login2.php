<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="login.css">

</head>
<body>

    <div class="viewA">
        <div class="name">
            <label>เข้าสู่ระบบ</label>
        </div>
    </div>

    <div class="img">
        <IMG SRC="../upload/login.png">
    </div>
    
    <form action="db_login2.php" method="post">
        <div class="head">
            <h1>Login</h1>
        </div>
        <div class="input-group">
            <lebel>Username</lebel>            
            <input type="text" name="user_mem" required/>
        </div>
        <div class="input-group">
            <lebel>Password</lebel>
            <input type="password" name="password" required/>
        </div>

        <div class="sign">
            <div class="newacc">
                <a href="register.php"> Create a new account </a>
            </div>
            <input type="submit" name="submit" value="Login">          
        </div>
    </form>
    
</body>
</html>

