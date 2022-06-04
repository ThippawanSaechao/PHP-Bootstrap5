<?php 
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tb_admin WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($query);
    }

    //print_r($_POST);
    if(isset($_POST) && !empty($_POST)) {
        //print_r($_POST);
        /* echo '<pre>';
        print_r($_FILES);
        echo '</pre>'; 
        exit(); */
        $pass_admin = sha1(md5($_POST['pass_admin']));
        $confirmpass = sha1(md5($_POST['confirmpass']));

        if($pass_admin != $confirmpass) {
            $alert ='<script type="text/javascript">';
            $alert .='alert("การยืนยันรหัสผ่านไม่ตรงกัน กรุณาตรวจสอบใหม่อีกครั้ง");';
            $alert .='window.location.href = "?page=admin&function=resetpassword&id='.$id.'";';
            $alert .='</script>';
            echo $alert;
            exit();
        } else {
            $sql = "UPDATE tb_admin SET pass_admin = '$pass_admin' WHERE id = '$id'";
            if (mysqli_query($conn, $sql)) {
                $alert ='<script type="text/javascript">';
                $alert .='alert("รีเซ็ตรหัสผ่านสำเร็จ");';
                $alert .='window.location.href = "?page=admin";';
                $alert .='</script>';
                echo $alert;
                exit(); 
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        mysqli_close($conn);
        }
    }
?> 

<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title">รีเซ็ตรหัสผ่านของ: <?=$result['user_admin']?> </h1>
    </div>
    <div class="col-auto">
        <a href="?page=<?=$_GET['page']?>" class="btn app-btn-secondary">ย้อนกลับ</a>
    </div>
</div>
<hr class="mb-4">
<div class="row g-4 settings-section">  
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">
            
            <div class="app-card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รหัสผ่าน</label>
                        <input type="text" class="form-control" name="pass_admin" placeholder="Password" autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ยืนยันรหัสผ่าน</label>
                        <input type="text" class="form-control" name="confirmpass" placeholder="Confirm password" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                </form>

            </div><!--//app-card-body-->
            
        </div><!--//app-card-->
    </div>
</div><!--//row-->
  