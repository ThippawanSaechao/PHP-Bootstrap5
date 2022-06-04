<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tb_type_place WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        $alert ='<script type="text/javascript">';
        $alert .='alert("ลบข้อมูลสำเร็จ");';
        $alert .='window.location.href = "?page=placetype";';
        $alert .='</script>';
        echo $alert;
        exit(); 
    }
}
?>