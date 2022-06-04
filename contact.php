<?php
include('connection/connection.php');

session_start();

$id =1;
$sql = "SELECT * FROM tb_about WHERE id = '$id'";

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
    <h2 class="mt-5 mb-5 pt-4 pb-4 text-center bg-gradient text-black" style="background-color: #e3f2fd">ติดต่อ</h2>
    <div class="container">

        <div class="row">
            <div class="col-8">
                <h2><p class="text-decoration-underline">ข้อมูลติดต่อ</p></h2>
                <p class="mt-5 fs-5"><?=$result['name']?></p>
                <p class="fs-5 mt-5">email : <?=$result['email']?></p>
                <p class="fs-5">phone : <a href="Tel:<?php echo $result['phone'];?>" class="text-dark"><?=$result['phone'];?></a></p>
            </div>
        </div>

    </div>

    <?php include('includes/footer.php') ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

</body>
</html>