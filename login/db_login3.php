<?php 

    session_start();

    $id = $_SESSION['id'];

    if(isset($_POST['user_mem'])) {

        include('../connection/connection.php');

        $user_mem = $_POST['user_mem'];
        $password = $_POST['password'];
        $passwordenc = md5($password);

        $query = "SELECT * FROM tb_member WHERE user_mem = '$user_mem' And password = '$passwordenc' ";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_array($result);

            $_SESSION['userid'] = $row['id'];
            $_SESSION['user_mem'] = $row['user_mem'];
 
            header("Location: ../place.php");
            
        } else {
            echo "<script>alert('Please check username and password agin.');</script>";
        }
    } else {
        header("Location: login.php");
    }

?>