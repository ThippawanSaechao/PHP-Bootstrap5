<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $id_place = $_GET['id_place'];
    $sql = "DELETE FROM tb_place_gallery WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        $alert ='<script type="text/javascript">';
        $alert .='alert("ลบข้อมูลสำเร็จ");';
        $alert .='window.location.href = "?page=place&function=gallery&id='.$id_place.'";';
        $alert .='</script>';
        echo $alert;
        exit(); 
    }
}
?>