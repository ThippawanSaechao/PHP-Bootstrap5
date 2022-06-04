<?php include('../connection/connection.php') ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

    <?php include ('include/head.php') ?>
    <?php include ('include/script.php') ?>
    <?php if(isset($_SESSION['user_login']) && !empty($_SESSION['user_login'])): ?>
        <body class="app">
            <?php include ('include/header.php'); ?>
            <!--//app-header-->
            <div class="app-wrapper">
                <div class="app-content pt-3 p-md-3 p-lg-4">
                    <div class="container-xl">
                        <?php 
                            if(!isset($_GET['page']) && empty($_GET['page'])) {
                                include('dashboard/index.php'); 
                            } elseif(isset($_GET['page']) && $_GET['page'] == 'about') {
                                include('about/index.php');
                            } elseif(isset($_GET['page']) && $_GET['page'] == 'place') {
                                if(isset($_GET['function']) && $_GET['function'] == 'add') {
                                    include('place/insert.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'update') {
                                    include('place/edit.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'delete') {
                                    include('place/delete.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'gallery') {
                                    include('place/gallery.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'gallery_delete') {
                                    include('place/gall_delete.php');
                                } else {
                                    include('place/index.php');
                                }
                            } elseif(isset($_GET['page']) && $_GET['page'] == 'placetype') {
                                if(isset($_GET['function']) && $_GET['function'] == 'add') {
                                    include('placetype/insert.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'update') {
                                    include('placetype/edit.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'delete') {
                                    include('placetype/delete.php');
                                } else {
                                    include('placetype/index.php');
                                }
                            } elseif(isset($_GET['page']) && $_GET['page'] == 'admin') {
                                if(isset($_GET['function']) && $_GET['function'] == 'add') {
                                    include('admin/insert.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'update') {
                                    include('admin/edit.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'resetpassword') {
                                    include('admin/resetpassword.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'delete') {
                                    include('admin/delete.php');
                                } else {
                                    include('admin/index.php');
                                }
                            } elseif(isset($_GET['page']) && $_GET['page'] == 'phone') {
                                if(isset($_GET['function']) && $_GET['function'] == 'add') {
                                    include('phone/insert.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'update') {
                                    include('phone/edit.php');
                                } elseif(isset($_GET['function']) && $_GET['function'] == 'delete') {
                                    include('phone/delete.php');
                                } else {
                                    include('phone/index.php');
                                }
                            } elseif(isset($_GET['page']) && $_GET['page'] == 'profile') {
                                include('profile/index.php');
                            } elseif(isset($_GET['page']) && $_GET['page'] == 'logout') {
                                include('logout/index.php');
                            }
                        ?>
                    </div>
                    <!--//container-fluid-->
                </div>
                <!--//app-content-->

                <?php include ('include/footer.php') ?>
                <!--//app-footer-->
            </div>
            <!--//app-wrapper-->
        </body>
    <?php else: ?>
        <?php include('login/index.php') ?>
    <?php endif; ?>
</html>
