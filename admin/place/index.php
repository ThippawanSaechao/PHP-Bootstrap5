<?php 
    $sql = "SELECT *,p.id, p.title, tp.title AS title_type FROM tb_place p 
            LEFT JOIN tb_type_place tp ON p.type_place_id = tp.id";
    $query = mysqli_query($conn, $sql);
?>
<div class="row justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">จัดการข้อมูลสถานที่</h1>
    </div>
    <div class="col-auto">
        
    </div>
</div>

<hr class="mb-4">
<div class="row g-4 settings-section">  
    <div class="col-12 col-md-12">
        <div class="app-card app-card-settings shadow-sm p-4">
            
            <div class="app-card-body">
            <a href="?page=<?=$_GET['page']?>&function=add" class="btn btn-primary text-white mb-3">เพิ่มสถานที่</a>
             
                <table class="table" id="tableall">
                    <thead class="text-center">
                        <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">รูปภาพ</th>
                        <th scope="col">ประเภทสถานที่</th>
                        <th scope="col">ชื่อสถานที่</th>
                        <th scope="col">ที่ตั้ง</th>
                        <th scope="col">เมนู</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php 
                            $i = 1;
                            foreach($query as $data): 
                        ?>
                            <tr>
                                <td class="align-middle"><?=$i++?></td>
                                <td class="align-middle"><img src="upload/place/<?=$data['image']?>" class="rounded" width="50" height="50"></td>
                                <td class="align-middle"><?=$data['title_type']?></td>
                                <td class="align-middle"><?=$data['title']?></td>
                                <td class="align-middle"><?=$data['location']?></td>
                                <td class="align-middle">
                                    <a href="?page=<?=$_GET['page']?>&function=update&id=<?=$data['id']?>" class="btn-sm btn-warning">แก้ไข</a>
                                    <a href="?page=<?=$_GET['page']?>&function=gallery&id=<?=$data['id']?>" class="btn-sm btn-info">แกลลอรี่</a>
                                    <a href="?page=<?=$_GET['page']?>&function=delete&id=<?=$data['id']?>" onclick="return confirm('ยืนยันการลบข้อมูล')" class="btn-sm btn-danger">ลบ</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
