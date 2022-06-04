<?php
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('/', $url);
    $url = explode('.', $url[2]);
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary">
    <div class="container-fluid">

        <a class="navbar-brand me-0 logo-absolute text-white" href="#"><h2>Travel in prachaup</h2></a>
        <div></div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item menu-custom">
                <a class="nav-link text-white mx-2 <?= $url[0] == '' || $url[0] == 'phone' ? 'active-menu-custom' : '' ?>" href="phone.php">โทรฉุกเฉิน</a>
            </li>
            <li class="nav-item menu-custom mx-2">
                <a class="nav-link text-white <?= $url[0] == '' || $url[0] == 'index' ? 'active-menu-custom' : '' ?> " aria-current="page" href="index.php">หน้าหลัก</a>
            </li>
            <li class="nav-item menu-custom">
                <a class="nav-link text-white mx-2 <?= in_array($url[0], array('place','place_detail')) ? 'active-menu-custom' : '' ?>" href="place.php">สถานที่</a>
            </li>
            <li class="nav-item menu-custom">
                <a class="nav-link text-white mx-2 <?= $url[0] == '' || $url[0] == 'about' ? 'active-menu-custom' : '' ?>" href="about.php">เกี่ยวกับ</a>
            </li>
            <li class="nav-item menu-custom">
                <a class="nav-link text-white mx-2 <?= $url[0] == '' || $url[0] == 'contact' ? 'active-menu-custom' : '' ?>" href="contact.php">ติดต่อ</a>
            </li>
            <li class="nav-item menu-custom">
                <a class="nav-link text-white mx-2 <?= $url[0] == '' || $url[0] == 'admin' ? 'active-menu-custom' : '' ?>" href="admin">เข้าสู่ระบบ</a>
            </li>
        </ul>
        </div>
    </div>
</nav>