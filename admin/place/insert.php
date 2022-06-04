<?php 
    //print_r($_POST);
    if(isset($_POST) && !empty($_POST)) {
        /* echo '<pre>';
        print_r($_POST);
        print_r($_FILES);
        echo '</pre>'; 
        exit();  */
        $type_place_id = $_POST['type_place_id'];
        $title = $_POST['title'];
        $title_s = $_POST['title_s'];
        $detail = $_POST['detail'];
        $district = $_POST['district'];
        $location = $_POST['location']; 

        if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            $extension = array("jpeg", "jpg", "png"); //เช็คไฟล์รูปภาพ
            $target = 'upload/place/';
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
                        $alert .='alert("เพิ่มไฟล์ไม่สำเร็จ");';
                        $alert .='window.location.href = "?page='.$_GET['page'].'&function=add";';
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
                        $alert .='window.location.href = "?page='.$_GET['page'].'&function=add";';
                        $alert .='</script>';
                        echo $alert;
                        exit(); 
                    }
                }
            } else {
                //echo 'โปรดตรวจสอบชนิดของไฟล์ที่นำเข้าว่าเป็น jpeg, jpg, png หรือไม่'; 
                $alert ='<script type="text/javascript">';
                $alert .='alert("โปรดตรวจสอบชนิดของไฟล์ที่นำเข้าว่าเป็น jpeg, jpg, png หรือไม่");';
                $alert .='window.location.href = "?page='.$_GET['page'].'&function=add";';
                $alert .='</script>';
                echo $alert;  
                exit();                                           
            }
        } else {
            $filename = '';
        }
        //echo $filename;
        //exit();

        $sql = "INSERT INTO tb_place
                (type_place_id, title, title_s, detail, district, location, image) 
                VALUES ('$type_place_id', '$title', '$title_s', '$detail', '$district', '$location', '$filename')";

        if (mysqli_query($conn, $sql)) {
            //echo "เพิ่มข้อมูลสำเร็จ";
            $alert ='<script type="text/javascript">';
            $alert .='alert("เพิ่มข้อมูลสำเร็จ");';
            $alert .='window.location.href = "?page='.$_GET['page'].'";';
            $alert .='</script>';
            echo $alert;
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    $sql = "SELECT * FROM tb_type_place";
    $query = mysqli_query($conn, $sql);
?> 

<script type="text/javascript">

</script>

<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title">เพิ่มข้อมูลสถานที่</h1>
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
                            <img id="preview" class="rounded" width="250" heigth="200">   
                        </div>  
                        <button onclick="return triggerFile();" class="btn btn-info text-white">เลือกรูปภาพ</button>                        
                        <input type="file" name="image" id="image" style="display:none;"> 
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ประเภทสถานที่</label>
                        <select name="type_place_id" class="form-control" style="height: unset !important" required>
                            <option value="" selected disabled="">Type of place</option>
                            <?php foreach($query as $data): ?>
                                <option value="<?=$data['id']?>"><?=$data['title']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ชื่อสถานที่</label>
                        <input type="text" class="form-control" name="title" placeholder="Name" autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รายละเอียดชวนอ่าน</label>
                        <input type="text" class="form-control" name="title_s" placeholder="About this place" autocomplete="off" required>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รายละเอียดสถานที่</label>
                        <textarea name="detail" class="form-control" style="height:100px"></textarea>
                    </div>
                    <hr class="mb-3 mt-4">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">อำเภอ</label>
                        <select name="district" class="form-control" style="height: unset !important" required>
                            <option value="" selected disabled="">District</option>
                            <option value ="อำเภอเมืองประจวบคีรีขันธ์">อำเภอเมืองประจวบคีรีขันธ์</option>
                            <option value ="อำเภอกุยบุรี">อำเภอกุยบุรี</option>
                            <option value ="อำเภอทับสะแก">อำเภอทับสะแก</option>
                            <option value ="อำเภอบางสะพาน">อำเภอบางสะพาน</option>
                            <option value ="อำเภอบางสะพานน้อย">อำเภอบางสะพานน้อย</option>
                            <option value ="อำเภอปราณบุรี">อำเภอปราณบุรี</option>
                            <option value ="อำเภอหัวหิน">อำเภอหัวหิน</option>
                            <option value ="อำเภอสามร้อยยอด">อำเภอสามร้อยยอด</option>
                        </select>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">ตำแหน่ง</label>
                        <input type="text" class="form-control" name="location" placeholder="Location" autocomplete="off" required>
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