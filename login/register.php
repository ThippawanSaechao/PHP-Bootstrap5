<?php 

    session_start();

    require_once "../connection/connection.php";


    if(isset($_POST['submit'])) {

        $user_mem = mysqli_real_escape_string($conn, $_POST['user_mem']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);


        $user_check = "SELECT * FROM tb_member WHERE user_mem = '$user_mem' LIMIT 1";
        $result = mysqli_query($conn, $user_check);
        $user = mysqli_fetch_assoc($result);

        if($user['user_mem'] === $user_mem) {
            echo "<script>alert('User already exists');</script>";
        } else {

            $passwordenc = md5($password);

            $query = "INSERT INTO tb_member (user_mem, password, firstname, lastname) 
                        VALUE ('$user_mem', '$passwordenc', '$firstname', '$lastname')";
            $result = mysqli_query($conn, $query);

            if($result) {
                $_SESSION['success'] = "Please Key Your Personal Information.";
                header("Location: login.php");
            }  else {
                $_SESSION['error'] = "Something went wrong";
                header("Location: register.php");
            }
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link rel="stylesheet" href="login.css">

</head>
<body>

    <div class="viewA">
        <div class="name">
            <label>สมัครสมาชิก</label>
        </div>
    </div>

    <div class="img">
        <IMG SRC="../upload/login.png">
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <div class="head">
            <h1>Register</h1>
        </div>

        <div class="input-group">
            <label for="email">Username</label>
            <input class="form-control" type="text" name="user_mem" required/>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="text" name="password" required/>
        </div>
        <div class="input-group">
            <label for="firstname">Fristname</label>
            <input type="text" name="firstname" required/>
        </div>
        <div class="input-group">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" required/>
        </div>
        <div class="sign">
            <div class="newacc">
                <a href="login.php"> Login </a>
            </div>
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

</body>
</html>