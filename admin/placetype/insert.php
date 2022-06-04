<?php 
    //print_r($_POST);
    if(isset($_POST) && !empty($_POST)) {
        $title = $_POST['title'];

        if(!empty($title)) {
            $sql_check = "SELECT * FROM tb_type_place WHERE title = '$title' ";
            $query_check = mysqli_query($conn, $sql_check);
            $row_check = mysqli_num_rows($query_check);
            if($row_check > 0) {
                $alert ='<script type="text/javascript">';
                $alert .='alert("ประเภทสถานที่ซ้ำ กรุณากรอกรายชื่อใหม่อีกครั้ง");';
                $alert .='window.location.href = "?page='.$_GET['page'].'&function=add";';
                $alert .='</script>';
                echo $alert;                
            } else{

                $sql = "INSERT INTO tb_type_place
                        (title) VALUES ('$title')";

                if (mysqli_query($conn, $sql)) {
                    //echo "เพิ่มข้อมูลสำเร็จ";
                    $alert ='<script type="text/javascript">';
                    $alert .='alert("เพิ่มประเภทสถานที่สำเร็จ");';
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
                        <label class="form-label">ประเภทสถานที่</label>
                        <input type="text" class="form-control" name="title" placeholder="Type of place" autocomplete="off" required>
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