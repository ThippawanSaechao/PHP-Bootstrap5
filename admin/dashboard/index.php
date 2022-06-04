<?php

//รวมจำนวนการเข้าชม
$sql_view = "SELECT SUM(view) as all_view FROM tb_place";
$query_view = mysqli_query($conn, $sql_view);
$result_view = mysqli_fetch_assoc($query_view);

//รวมจำนวนสถานที่
$sql_place = "SELECT COUNT(id) as count_place FROM tb_place";
$query_place = mysqli_query($conn, $sql_place);
$result_place = mysqli_fetch_assoc($query_place);

?>

<h1 class="app-page-title">หน้าหลัก</h1>
    <hr class="mb-4">
<div class="row g-4 settings-section">  

    <div class="col-12 col-md-12">

        <div class="app-card-body">
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">
                        <h3 class="mb-3">ยินดีต้อนรับ, <?=$_SESSION['user_login']?></h3>
                        
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div><!--//app-card-body-->					    
                </div><!--//inner-->
            </div><!--//app-card-->
        </div><!--//app-card-body--> 

        <div class="row g-4 mb-4">
            
            <div class="col-6">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">จำนวนการเข้าชมทั้งหมด</h4>
                        <div class="stats-figure"><?=$result_view['all_view']?></div>
                        <div class="stats-meta">ครั้ง</div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//col-->

            <div class="col-6">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">จำนวนรายการสถานที่ทั้งหมด</h4>
                        <div class="stats-figure"><?=$result_place['count_place']?></div>
                        <div class="stats-meta">รายการ</div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div><!--//col-->
            
        </div><!--//row-->

        <div class="app-card app-card-settings shadow-sm p-4"> 

        </div><!--//app-card-->
    </div>
</div><!--//row-->
