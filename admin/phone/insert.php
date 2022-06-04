<?php 
    //print_r($_POST);
    if(isset($_POST) && !empty($_POST)) {
        $district = $_POST['district'];
        $agency = $_POST['agency'];
        $phone = $_POST['phone'];
        $detail = $_POST['detail'];

        if(!empty($phone)) {
            $sql_check = "SELECT * FROM tb_phone WHERE phone = '$phone' ";
            $query_check = mysqli_query($conn, $sql_check);
            $row_check = mysqli_num_rows($query_check);
            if($row_check > 0) {
                $alert ='<script type="text/javascript">';
                $alert .='alert("เบอร์โทรซ้ำ กรุณาใหม่อีกครั้ง");';
                $alert .='window.location.href = "?page='.$_GET['page'].'&function=add";';
                $alert .='</script>';
                echo $alert;                
            } else{

                $sql = "INSERT INTO tb_phone
                        (district, agency, phone, detail) VALUES ('$district', '$agency', '$phone', '$detail')";

                if (mysqli_query($conn, $sql)) {
                    //echo "เพิ่มข้อมูลสำเร็จ";
                    $alert ='<script type="text/javascript">';
                    $alert .='alert("เพิ่มเบอร์โทรสำเร็จ");';
                    $alert .='window.location.href = "?page='.$_GET['page'].'";';
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
        <h1 class="app-page-title">เพิ่มประเภทสถานที่</h1>
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
                        <label class="form-label">หน่วยงาน</label>
                        <input type="text" class="form-control" name="agency" autocomplete="off" required>
                    </div> 

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" name="phone" autocomplete="off" required>
                    </div> 

                    <div class="mb-3 col-lg-6">
                        <label class="form-label">รายละเอียดเพิ่มเติม</label>
                        <textarea name="detail" class="form-control" style="height:100px"></textarea>
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