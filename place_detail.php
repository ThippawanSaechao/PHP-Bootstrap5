<?php
include('connection/connection.php');

session_start();

//query type place
$sql = "SELECT *,tb_place.id, tb_place.title, tb_type_place.title AS type_title FROM  tb_place 
        LEFT JOIN tb_type_place ON tb_place.type_place_id = tb_type_place.id";

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET ['id'];
    $_SESSION['id'] = $id;

    //เก็บจำนวนเข้าชม
    $sql_view = "UPDATE tb_place SET view = view+1 WHERE id = '$id'";
    $query_view = mysqli_query($conn, $sql_view);

    $sql_place = $sql." WHERE tb_place.id != '$id' ORDER BY tb_place.id DESC LIMIT 8";
    $query_place = mysqli_query($conn, $sql_place);
    $sql .= " WHERE tb_place.id = '$id'";
}
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>

    <?php
        if($_SESSION['user_mem']!='') {
            include('includes/navbar2.php'); 
        } else{ 
            include('includes/navbar.php'); 		
        }
    ?>
    <h2 class="mt-5 mb-5 pt-4 pb-4 text-center bg-gradient text-black" style="background-color: #e3f2fd">รายละเอียดเพิ่มเติม</h2>
    <div class="container">

        <div class="row">
            <div class="col-9 my-4">
                <h3 class="px-2 py-2 mb-0 fw-bolder bg-gradient text-black"><?=$result['title']?></h3>
                <h5 class="mb-4 py-4 px-2 bg-gradient text-black"><?=$result['title_s']?></h5>
                <div class="text-center mt-4 mb-4">
                    <img src="admin/upload/place/<?=$result['image']?>" id="preview" height="350" class="card-img-top" width="100%">                   
                </div>

                <?php               
                    $sql = "SELECT * FROM tb_place_gallery WHERE id_place = '$id'";
                    $query = mysqli_query($conn, $sql);               
                ?>

                <div class="d-flex overflow-auto">
                    <div class="col-3 me-2 mb-2">
                        <img src="admin/upload/place/<?=$result['image']?>" class="border" style="cursor: cell;" width="100%" height="150" onclick="preview(this.src)"> 
                    </div>
                    <?php foreach($query as $key => $value):?>
                        <div class="col-3 me-2 mb-2">
                            <img src="admin/upload/place/<?=$value['image']?>" class="border" style="cursor: cell;" width="100%" height="150" onclick="preview(this.src)"> 
                        </div>
                    <?php endforeach;?>
                </div>

                <p class="mt-4"><?=nl2br($result['detail'])?></p>
                <p>Location : <?=$result['location']?></p>
            </div>
            <div class="col-3 my-4"></div>          
        </div>    

        <hr class="mb-0 mt-5"> 
        
        <div class="row">
            <h4 class="text-center mt-4 fw-bolder">เรื่องที่คุณอาจสนใจ</h4>
            <?php foreach($query_place as $data) : ?>
                <div class="col-12 col-md-6 col-lg-3 p-2 text-center">
                    <div class="p-3">
                        <img src="admin/upload/place/<?=$data['image']?>" height="150" class="card-img-top">
                        <div class="card-body">
                            <p class="card-text"><?=$data['title_s']?></p>
                            <a href="place_detail.php?id=<?=$data['id']?>" class="btn btn-dark">รายละเอียด</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>             
        </div>

    </div>

    <?php include('includes/footer.php') ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function preview(src){
            document.getElementById('preview').src = src;
        }           
    </script>
</body>
</html>