<?php 

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_type_place WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}

if(isset($_POST) && !empty($_POST)) {
    $title = $_POST['title'];

    if(!empty($title)) {
        $sql_check = "SELECT * FROM tb_type_place WHERE title = '$title' AND id != '$id'";
        $query_check = mysqli_query($conn, $sql_check);
        $row_check = mysqli_num_rows($query_check);
        if($row_check > 0) {
            $alert ='<script type="text/javascript">';
            $alert .='alert("ประเภทสินค้าซ้ำ กรุณากรอกรายชื่อใหม่อีกครั้ง");';
            $alert .='window.location.href = "?page='.$_GET['page'].'&function=update&id='.$id.'";';
            $alert .='</script>';
            echo $alert;                
        } else{

            $sql = "UPDATE tb_type_place SET title = '$title' WHERE id = '$id'";

            if (mysqli_query($conn, $sql)) {
                $alert ='<script type="text/javascript">';
                $alert .='alert("แก้ไขประเภทสถานที่สำเร็จ");';
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
        <h1 class="app-page-title">แก้ไขประเภทสถานที่</h1>
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
                        <input type="text" class="form-control" name="title" value="<?=$result['title']?>" autocomplete="off" required>
                    </div>                                   

                    <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                </form>

            </div><!--//app-card-body-->
            
        </div><!--//app-card-->
    </div>
</div><!--//row-->
  