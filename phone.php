<?php
include('connection/connection.php');

session_start();

$sql = "SELECT * FROM tb_phone";

if(isset($_GET['search']) && !empty($_GET['search'])) {

    /* Like ช่วยให้ค้นหาได้ดีขึ้น */   
    $sql .= " WHERE district LIKE '%".$_GET['search']."%'";
}

$query_phone = mysqli_query($conn, $sql);

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

    <h2 class="mt-5 mb-3 pt-5 pb-3 text-center bg-gradient text-black" style="">เบอร์โทรฉุกเฉิน</h2>
    <div class="container ">

        <div class="d-flex">
            <div class="mx-auto"></div>
                <div class="justify-content-end col-md-3 px-3 mb-2">
                    <form action="" method="get">
                            
                        <select  name="search" >
                                <option >กรุณาเลือกอำเภอ</option>
                                <option >หัวหิน</option>
                                <option >บางสะพาน</option>
                                <option >เมือง</option>
                                <option >กุยบุรี</option>
                                <option >ทับสะแก</option>
                                <option >สามร้อยยอด</option>
                                <option >ปราณบุรี</option>
                                <option >บางสะพานน้อย</option>
                            

                        </select>
                        <button type="submit" value="<?=(isset($_GET['search']) ? $_GET['search'] : '' )?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </button>
                        

                    </form>
                </div>
        </div>

        <table class="table">
            <thead>
                <tr class="table-warning">
                    <th scope="col">อำเภอ</th>
                    <th scope="col">หน่วยงาน</th>
                    <th scope="col">เบอร์โทรฉุกเฉิน</th>
                    <th scope="col">ข้อมูลเพิ่มเติม</th>
                    <th scope="col">เมนู</th>
                </tr>
            </thead>
                <?php if(mysqli_num_rows($query_phone)) : ?>
                    <?php foreach($query_phone as $data) : ?>
                        <tbody>
                            <tr>
                                <td class="align-middle"><?=$data['district']?></td>
                                <td class="align-middle"><?=$data['agency']?></td>
                                <td class="align-middle"><?=$data['phone']?></td>
                                <td class="align-middle"><?=$data['detail']?></td>
                                <td class="align-middle">
                                    <a href="tel:<?=$data['phone']?>" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?> 

                    <?php else: ?>
                        <div class="col-12 p-2">
                            <div class="card p-4">
                                <h6 class="fw-bolder py-2" style="color: grey">ไม่พบรายการที่ค้นหา</h6>
                            </div>
                        </div>
                <?php endif; ?> 
            </table>
          
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

</body>
</html>