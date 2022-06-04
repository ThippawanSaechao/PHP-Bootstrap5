<?php
include('connection/connection.php');

session_start();

//query type place
$sql = "SELECT * FROM tb_type_place";
$query_type_place = mysqli_query($conn, $sql);

//query place
$sql = "SELECT * FROM tb_place";
$query_place = mysqli_query($conn, $sql);

$sql .= " ORDER BY view DESC LIMIT 4";
$query_recommend = mysqli_query($conn, $sql);
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

    <?php include('includes/slide.php') ?>

        <div class="container my-4 text-center">
            <h2 class="fw-bolder my-4">แนะนำสถานที่</h2>
            <div class="row">
                <?php foreach($query_recommend as $data) : ?>
                    <div class="col-12 col-md-4 col-lg-3 px-2 pb-4">
                        <div class="p-3">
                            <img src="admin/upload/place/<?=$data['image']?>" height="200" class="card-img-top">
                            <div class="card-body">
                                <p class="card-text"><?=$data['title_s']?></p>
                                <a href="place_detail.php?id=<?=$data['id']?>" class="btn btn-dark">รายละเอียด</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?> 
            </div>
        </div>
        <hr class="mb-3 mt-1 py-2">


    <div class="container my-5 text-center">
        <h2 class="fw-bolder">สถานที่</h2>
        <ul class="nav justify-content-center my-3">
            <?php foreach($query_type_place as $data) : ?>
                <li class="nav-item mx-2">
                    <a class="text-muted active" href="place.php?type_place_id=<?=$data['id']?>"><?=$data['title']?></a>
                </li>   
            <?php endforeach; ?>      
        </ul>
        
        <div class="row">
            <?php foreach($query_place as $data) : ?>
                <div class="col-12 col-md-4 col-lg-3 p-2">
                    <div class="p-3">
                        <img src="admin/upload/place/<?=$data['image']?>" height="200" class="card-img-top">
                        <div class="card-body">
                            <p class="card-text"><?=$data['title_s']?></p>
                            <a href="place_detail.php?id=<?=$data['id']?>" class="btn btn-dark">รายละเอียด</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?> 

            <div class="col-12 text-center">
                <a href="place.php" class="text-muted">ดูข้อมูลเพิ่มเติม</a>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php') ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

</body>
</html>