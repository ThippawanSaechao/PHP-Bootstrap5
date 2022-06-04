<?php 

    if(isset($_POST) && !empty($_POST)) {
        $id_place = $_POST['id_place'];

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

        $sql = "INSERT INTO tb_place_gallery
                (id_place, image) 
                VALUES ('$id_place', '$filename')";

        if (mysqli_query($conn, $sql)) {
            //echo "เพิ่มข้อมูลสำเร็จ";
            $alert ='<script type="text/javascript">';
            $alert .='alert("เพิ่มข้อมูลสำเร็จ");';
            $alert .='window.location.href = "?page='.$_GET['page'].'&function='.$_GET['function'].'&id='.$id_place.'";';
            $alert .='</script>';
            echo $alert;
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

    $id = $_GET['id'];
    $sql = "SELECT *,p.id, p.title, tp.title AS title_type FROM tb_place p 
            LEFT JOIN tb_type_place tp ON p.type_place_id = tp.id WHERE p.id = '$id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);

    $sql = "SELECT * FROM tb_place_gallery WHERE id_place = '$id'";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">จัดการข้อมูลแกลลอรี่ / สถานที่ : <?=$result['title']?></h1>
    </div>
    <div class="col-auto">
        <a href="?page=<?=$_GET['page']?>" class="btn app-btn-secondary">ย้อนกลับ</a>
    </div>
</div>

<hr class="mb-4">
<div class="row g-4 settings-section">  
    <div class="col-12 col-md-4">
        <div class="app-card app-card-settings shadow-sm p-4">      
            <div class="app-card-body text-center">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">รูปภาพ</label>
                        <div class="mb-3">
                            <img id="preview" class="rounded" width="250" heigth="250">   
                        </div>  
                        <button onclick="return triggerFile();" class="btn btn-info text-white">เลือกรูปภาพ</button>                        
                        <input type="file" name="image" id="image" style="display:none;"> 
                    </div>
                    <input type="hidden" name="id_place" value="<?=$id?>">

                    <button type="submit" class="btn app-btn-primary" >บันทึก</button>
                </form>

            </div><!--//app-card-body-->
            
        </div><!--//app-card-->
    </div>

    <div class="col-12 col-md-8">
        <div class="app-card app-card-settings shadow-sm p-4">
            
            <div class="app-card-body">
            <a href="?page=<?=$_GET['page']?>&function=add" class="btn btn-primary text-white mb-3">เพิ่มสถานที่</a>
             
                <table class="table" id="tableall">
                    <thead class="text-center">
                        <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">เมนู</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php 
                            $i = 1;
                            foreach($query as $data): 
                        ?>
                            <tr>
                                <td class="align-middle"><?=$i?></td>
                                <td class="align-middle"><img src="upload/place/<?=$data['image']?>" class="rounded" width="50" height="50"></td>
                                <td class="align-middle">
                                    <a href="?page=<?=$_GET['page']?>&function=gallery_delete&id=<?=$data['id']?>&id_place=<?=$id?>" onclick="return confirm('ยืนยันการลบข้อมูล')" class="btn-sm btn-danger">ลบ</a>
                                </td>
                            </tr>
                        <?php $i++;endforeach; ?>
                    </tbody>
                </table>
            </div><!--//app-card-body-->
            
        </div><!--//app-card-->
    </div>
</div><!--//row-->

<script type="text/javascript">
    $(document).ready( function () {
        // # = id
        $('#tableall').DataTable({

            /* เปลี่ยนภาษา DataTable */
            language : {
                "decimal":        "",
                "emptyTable":     "ไม่มีข้อมูล",
                "info":           "แสดง _START_ - _END_ จาก _TOTAL_ รายการ",
                "infoEmpty":      "แสดง 0 - 0 จาก 0 รายการ",
                "infoFiltered":   "(filtered from _MAX_ total entries)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "แสดง _MENU_ รายการ",
                "loadingRecords": "Loading...",
                "processing":     "Processing...",
                "search":         "ค้นหา:",
                "zeroRecords":    "No matching records found",
                "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       "ถัดไป",
                    "previous":   "ก่อนหน้า"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
        });       
    } );
</script>

<?php
    mysqli_close($conn);
?>

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