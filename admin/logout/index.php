<?php
session_destroy();
$alert ='<script type="text/javascript">';
$alert .='alert("ออกจากระบบ");';
$alert .='window.location.href = "../admin/";';
$alert .='</script>';
echo $alert;
exit();
?>