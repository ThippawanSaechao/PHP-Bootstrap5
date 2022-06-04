<?php 

$id = 1;
$sql = "SELECT * FROM tb_about WHERE id = '$id'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($query);


if(isset($_POST) && !empty($_POST)) {
    /* echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    exit(); */

    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; 

    $sql = "UPDATE tb_about SET
            name = '$name', 
            detail = '$detail', 
            email = '$email', 
            phone = '$phone'
            WHERE id = '$id'";
            

    if (mysqli_query($conn, $sql)) {
        $alert ='<script type="text/javascript">';
        $alert .='alert("อัพเดทข้อมูลสำเร็จ");';
        $alert .='window.location.href = "?page=about";';
        $alert .='</script>';
        echo $alert;
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?> 

<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title">จัดการข้อมูลเกี่ยวกับฉัน</h1>
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
                        <label class="form-label">ชื่อเว็บไซต์</label>
                        <input type="text" class="form-control" name="name" placeholder="" value="<?=$result['name']?>" autocomplete="off" required>
                    </div>
                    <hr class="mb-3 mt-4">
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รายละเอียด</label>
                        <textarea name="detail" class="form-control" style="height: 300px" placeholder=""><?=$result['detail']?></textarea>
                    </div>
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">อีเมล</label>
                        <textarea name="email" class="form-control" style="height: 50px" placeholder=""><?=$result['email']?></textarea>
                    </div>   
                    <div class="mb-3 col-lg-6">
                        <label class="form-label">เบอร์โทร</label>
                        <textarea name="phone" class="form-control" style="height: 50px" placeholder=""><?=$result['phone']?></textarea>
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