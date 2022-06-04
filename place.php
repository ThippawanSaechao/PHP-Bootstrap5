<?php
include('connection/connection.php');

session_start();
$user = $_SESSION['user_mem'];

//query type place
$sql = "SELECT * FROM tb_type_place";
$query_type_place = mysqli_query($conn, $sql);

if(isset($_GET['page'])) {

    $page = $_GET['page'];

} else {
    $page = 1; //เลขหน้า
}

$record_show = 1; //จำนวนที่แสดง
$offset = ($page - 1) * $record_show; //เลขเริ่มต้น

//จำนวนรวมของสินค้าที่มีในฐานข้อมูล
$sql_total = "SELECT * FROM tb_place";
$query_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_num_rows($query_total);
/* ceil ปัดเศษ */
$page_total = ceil($row_total/$record_show);

//query place
$sql = "SELECT * FROM tb_place";
if(isset($_GET['type_place_id']) && !empty($_GET['type_place_id'])) {
    $sql .= " WHERE type_place_id = '".$_GET['type_place_id']."'"; 
}

if(isset($_GET['search']) && !empty($_GET['search'])) {

    /* Like ช่วยให้ค้นหาได้ดีขึ้น */
    $sql .= " WHERE title LIKE '%".$_GET['search']."%'";    
}

$sql .= " LIMIT $offset, $record_show ";

$query_place = mysqli_query($conn, $sql);


$sql_fa = "SELECT * FROM tb_favorite";
$query_fa = mysqli_query($conn, $sql_fa);
?>


<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
    <?php
        if($user!='') {
            include('includes/navbar2.php'); 
        } else{ 
            include('includes/navbar.php'); 		
        }
    ?>
    
    <form action="" method="POST" class="form">

    <!-- <?php include('includes/slide.php') ?> -->
    <h2 class="mt-5 mb-5 pt-4 pb-4 text-center bg-gradient text-black" style="background-color: #e3f2fd">สถานที่แนะนำ</h2>
    <div class="container ">

        <!-- Search -->
        <div class="d-flex">
            <div class="mx-auto"></div>
                <div class="justify-content-end col-md-3 px-3">
                    <form action="" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="ค้นหา" name="search" value="<?=(isset($_GET['search']) ? $_GET['search'] : '' )?>">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
        </div>

        <div class="row">
            <div class="col-9"> 
                <div class="row">

                    <?php if(mysqli_num_rows($query_place)) : ?>
                        <?php foreach($query_place as $data) : ?>
                            <div class="col-12 col-md-6 col-lg-3 p-2">
                            
                                <div class="p-3">
                                <div class="position-relative">
                                    <img src="admin/upload/place/<?=$data['image']?>" height="150" class="card-img-top">
                                </div>
                                
                                                 
                                <div class="card-body">
                                    <p class="card-text"><?=$data['title_s']?></p>
                                    <a href="place_detail.php?id=<?=$data['id']?>" class="btn btn-dark">รายละเอียด</a>
                                </div>
                                </div>
                            </div>
                        <?php endforeach; ?> 

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="?page=1" tabindx="-1" aria-disable="true">Frist</a>
                                </li>
                                <li class="page-item <?=$page > 1 ? '' : 'disabled'?>">
                                    <a class="page-link" href="?page=<?=$page-1?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php for($i=1; $i <= $page_total; $i++):?>
                                    <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                                <?php endfor;?>
                                <li class="page-item <?=$page <= $page_total ? '' : 'disabled'?>">
                                    <a class="page-link" href="?page=<?=$page+1?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?=$page_total?>">Last</a>
                                </li>
                            </ul>
                        </nav>

                        <?php else: ?>
                            <div class="col-12 p-2">
                                <div class="card p-4">
                                    <h6 class="fw-bolder py-2" style="color: grey">ไม่พบรายการที่ค้นหา</h6>
                                </div>
                            </div>
                    <?php endif; ?> 
                </div>
            </div>

            <div class="col-3">
                <ul class="list-group mt-4 pb-4">
                    <li class="list-group-item bg-primary text-white p-3">หมวดหมู่</li>
                    <a href="place.php" class="list-group-item text-dark list-menu-custom 
                    <?= !isset($_GET['type']) ? 'active-list-menu-custom' : '' ?>">ทั้งหมด</a>
                    <?php foreach($query_type_place as $data) : ?>
                        <a href="?type_place_id=<?=$data['id']?>" class="list-group-item text-dark list-menu-custom
                        <?=isset($_GET['type']) && $_GET['type'] == $data['id'] ? 'active-list-menu-custom' : '' ?>"><?=$data['title']?></a>
                    <?php endforeach; ?> 
                </ul> 
            </div> 
            
            
        </div>
    </div>

    <?php include('includes/footer.php') ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    </form>
</body>
</html>