<?php 
    //print_r($_POST);
    if(isset($_POST) && !empty($_POST)) {
        //print_r($_POST);
        /* echo '<pre>';
        print_r($_FILES);
        echo '</pre>'; 
        exit(); */
        $user_admin = $_POST['user_admin'];
        $pass_admin = sha1(md5($_POST['pass_admin']));
        $fristname = $_POST['fristname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone']; 

        if(!empty($user_admin)) {
            $sql_check = "SELECT * FROM tb_admin WHERE user_admin = '$user_admin' ";
            $query_check = mysqli_query($conn, $sql_check);
            $row_check = mysqli_num_rows($query_check);
            if($row_check > 0) {
                //echo 'ชื่อผู้ใช้นี้ถูกใช้งานไปแล้ว กรุณากรอกรายชื่อใหม่อีกครั้ง';
                $alert ='<script type="text/javascript">';
                $alert .='alert("ชื่อผู้ใช้นี้ถูกใช้งานไปแล้ว กรุณากรอกรายชื่อใหม่อีกครั้ง");';
                $alert .='</script>';
                echo $alert;                
            } else{
                if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $extension = array("jpeg", "jpg", "png"); //เช็คไฟล์รูปภาพ
                    $target = 'upload/admin/';
                    $filename = $_FILES['image']['name']; //ชื่อไฟล์
                    $filetmp = $_FILES['image']['tmp_name']; //array tmp
                    $ext = pathinfo($filename,PATHINFO_EXTENSION); //ประเภทไฟล์ที่นำเข้า jpeg, jpg, png

                    /* เช็ค $ext = $extension หรือไม่ */
                    if(in_array($ext,$extension)) {
                        /* เช็คค่าไฟล์ว่ามีอยู่ใน folder หรือไม่ */
                        if(!file_exists($target.$filename)) {
                            if(move_uploaded_file($filetmp,$target.$filename)) {
                                $filename = $filename;
                            } else {
                                //echo 'เพิ่มไฟล์เข้า folder ไม่สำเร็จ';
                                $alert ='<script type="text/javascript">';
                                $alert .='alert("เพิ่มไฟล์เข้า folder ไม่สำเร็จ");';
                                $alert .='</script>';
                                echo $alert;
                                exit(); 
                            }
                        } else {
                            /* แปลงชื่อไฟล์ใหม่ */
                            $newfilename = time().$filename;
                            if(move_uploaded_file($filetmp,$target.$newfilename)) {
                                $filename = $newfilename;
                            } else {
                                //echo 'เพิ่มไฟล์เข้า folder ไม่สำเร็จ';
                                $alert ='<script type="text/javascript">';
                                $alert .='alert("เพิ่มไฟล์เข้า folder ไม่สำเร็จ");';
                                $alert .='</script>';
                                echo $alert;
                                exit(); 
                            }
                        }
                    } else {
                        //echo 'โปรดตรวจสอบชนิดของไฟล์ที่นำเข้าว่าเป็น jpeg, jpg, png หรือไม่'; 
                        $alert ='<script type="text/javascript">';
                        $alert .='alert("โปรดตรวจสอบชนิดของไฟล์ที่นำเข้าว่าเป็น jpeg, jpg, png หรือไม่");';
                        $alert .='window.location.href = "?page=admin&function=add";';
                        $alert .='</script>';
                        echo $alert;  
                        exit();                                           
                    }
                } else {
                    $filename = '';
                }
                //echo $filename;
                //exit();

                $sql = "INSERT INTO tb_admin
                        (fristname, lastname, email, phone, user_admin, pass_admin, image) 
                        VALUES ('$fristname', '$lastname', '$email', '$phone', '$user_admin', '$pass_admin', '$filename')";

                if (mysqli_query($conn, $sql)) {
                    //echo "เพิ่มข้อมูลสำเร็จ";
                    $alert ='<script type="text/javascript">';
                    $alert .='alert("เพิ่มข้อมูลสำเร็จ");';
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
    }
?> 

<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title">เพิ่มข้อมูลผู้ดูแลระบบ</h1>
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
                    <div class="mb-3">
                        <label class="form-label">รูปภาพ</label>
                        <div class="mb-3">
                            <img id="preview" class="rounded" width="150" heigth="150">   
                        </div>  
                        <button onclick="return triggerFile();" class="btn btn-info text-white">เลือกรูปภาพ</button>                        
                        <input type="file" name="image" id="image" style="display:none;"> 
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" name="user_admin" placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รหัสผ่าน</label>
                        <input type="text" class="form-control" name="pass_admin" placeholder="Password" autocomplete="off" required>
                    </div>
                    <hr class="mb-3 mt-4">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ขื่อ</label>
                        <input type="text" class="form-control" name="fristname" placeholder="Fristname" 
                        value="<?=(isset($_POST['fristname']) && !empty($_POST['fristname']) ? $_POST['fristname'] : '')?>"
                        autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Lastname" 
                        value="<?=(isset($_POST['lastname']) && !empty($_POST['lastname']) ? $_POST['lastname'] : '')?>"
                        autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">อีเมล</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" 
                        value="<?=(isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : '')?>" 
                        autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">เบอร์ติดต่อ</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone number" 
                        value="<?=(isset($_POST['phone']) && !empty($_POST['phone']) ? $_POST['phone'] : '')?>" 
                        autocomplete="off" required>
                    </div>                                   

                    <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                </form>

            </div><!--//app-card-body-->
            
        </div><!--//app-card-->
    </div>
</div><!--//row-->
  
<!-- Javascript -->
<script type="text/javascript">
    function triggerFile() {
        //console.log('test')
        $("#image").trigger("click");  //ใช้ trigger ทำคลิ๊กแทน id="image"
        return false;
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function() {
        readURL(this);
    });
</script>