

<style>
    .nav-header img {
        width: 50px; 
        height: auto;
        margin-right: 10px; 
    }
    .navbar-brand b {
        font-weight: bold; 
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); 
    }
    #vertical-menu {
    color: black; 
}



#vertical-menu .nav-link {
    color: black ; 
}

#vertical-menu .nav-link:hover {
    background-color: rgba(6,173,239,255); /* Hiệu ứng khi di chuột qua */
}

</style>
<!-- TRANG CHU NAVBAR HEADER -->
<header class="headerMenu сlearfix sb-page-header">   
    <div class="nav-header">
        <img src="Design/images/icon.jpg" alt="">
        <a class="navbar-brand" href="admin.php"><b>VÔ TRI</b></a> 
    </div>

    <div class="nav-controls top-nav">
        <ul class="nav top-menu">
            <li class="navbar-item dropdown pe-3 profile-user">
                <?php if (isset($_SESSION['is_login']['hoten'])): ?>
                    <a class="navbar-link  navbar-profile d-flex align-items-center pe-0 profile-main" style="color: black;" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="./Design/images/<?php echo $_SESSION['is_login']['hinhanh'] ?>" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px;">&nbsp;
                        <?php if (isset($_SESSION['is_login']['hoten'])): ?>
                            <span  class="d-none d-md-block ps-2"><b><?php echo $_SESSION['is_login']['hoten'] ?></b></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="background-color: #fff; box-shadow: 1px 2px 3px #000;">
                        <li class="dropdown-header">
                            <h6 class="text-center"><b><?php echo $_SESSION['is_login']['hoten'] ?></b></h6>
                            <p class="text-center"><?php echo $_SESSION['is_login']['tenvaitro']; ?></p>
                        </li>
                        <?php if (isset($_SESSION['login']) && $_SESSION['is_login']['vaitro'] != 4): ?>
                            <li>
                                <a class="dropdown-item" href="admin.php">
                                    <i class="fa-solid fa-gear"></i>
                                    <span class="ml-2">Vào trang quản lý</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="admin.php?mod=Profile">
                                <i class="bi bi-person"></i>
                                <span class="ml-2">Hồ sơ người dùng</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="index.php?mod=Order&act=dsphieu">
                                <i class="bi bi-question-circle"></i>
                                <span class="ml-2">Xem phiếu đặt món</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="index.php?mod=logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span class="ml-2">Đăng xuất</span>
                            </a>
                        </li>
                    </ul>
                <?php else: ?>
                    <li class="navbar-item">
                        <a class="navbar-link text-white" href="?mod=login" id="login">Đăng nhập</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </li>
                <?php endif; ?>
            </li>
            
            <li class="main-li webpage-btn">
                <a class="nav-item-button " href="index.php" target="_blank">
                    <i class="fas fa-binoculars"></i>
                    <span>Xem Website</span>
                </a>
            </li>
        </ul>
    </div>
</header>

<!-- VERTICAL NAVBAR -->

<aside class="vertical-menu" style="padding-left: 30px; padding-top: 100px;" id="vertical-menu">
    <div>
        <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
    <a class="nav-link " href="admin.php">
       
        <span>Trang chủ</span>
    </a>
    </li><!-- End Dashboard Nav -->
    <li class="nav-heading">Chức năng</li>
    <?php

    if (isset($_SESSION['login'])) {
    if ($_SESSION['is_login']['vaitro'] == 1) {
    ?>

        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <span>Quản lý người dùng</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
            <a href="admin.php?mod=NhanVienBep">
                <span>Danh sách nhân viên bếp</span>
            </a>
            </li>

            <li>
            <a href="admin.php?mod=NhanVienCongTy">
                <span>Danh sách nhân viên công ty</span>
            </a>
            </li>

            <li>
            <a href="admin.php?mod=addUser">
                <span>Thêm người dùng</span>
            </a>
            </li>

        </ul>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
            <span>Quản lý món ăn</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

            <li>
            <a href="admin.php?mod=DSMonAn">
                <span>Danh Sách món ăn</span>
            </a>
            </li>
            <li>
            <a href="admin.php?mod=addMonan">
                </i><span>Thêm món ăn mới</span>
            </a>
            </li>
        </ul>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <span>Thực đơn</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

            <li>
            <a href="admin.php?mod=listMenu">
                <span>Danh sách thực đơn</span>
            </a>
            </li>
            <li>
            <a href="admin.php?mod=addMenu">
                <span>Thêm thực đơn mới</span>
            </a>
            </li>

        </ul>
        </li>


        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
            <span>Quản lý nguyên liệu</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

            <li>
            <a href="admin.php?mod=Nguyenlieu">
                <span>Thực đơn nguyên liệu cần nấu</span>
            </a>
            </li>
        
                <a href="admin.php?mod=DsNguyenLieu">
                <span>Danh sách nguyên liệu</span>
                </a>
            </li>
            <li>
                <a href="admin.php?mod=addNguyenLieu">
                <span>Thêm nguyên liệu</span>
                </a>
            </li>

        
        </ul>
        </li>


        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <span>Quản lý phiếu</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
            <a href="admin.php?mod=DSPhieu">
                <span>Danh sách phiếu đặt món</span>
            </a>
            </li>

            <li>
            <a href="admin.php?mod=XacNhanPhieu">
            <span>Xác nhận phiếu</span>
            </a>
            </li>
            <li>
            <a href="admin.php?mod=DuyetPhieu">
            <span>Duyệt phiếu đặt</span>
            </a>
            </li>
            
            </li>
            <li>
            <a href="admin.php?mod=XacNhanThanhToan">
                <span>Xác nhận thanh toán</span>
            </a>
            </li>
        </ul>
        </li>
    <?php }
    } ?>




    <?php
    if (isset($_SESSION['login'])) {
    if ($_SESSION['is_login']['vaitro'] == 2) {
    ?>
        <li class="nav-item">
        <a class="nav-link collapsed" href="admin.php?mod=DSPhieu">
            
            <span>Xem phiếu đặt món</span>
        </a>
        </li>
        
        <li class="nav-item">
        <a class="nav-link collapsed" href="admin.php?mod=DuyetPhieu">
            
            <span>Duyệt phiếu đặt món</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="admin.php?mod=XacNhanPhieu">
            
            <span>Xác nhận phiếu</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="admin.php?mod=XacNhanThanhToan">
            
            <span>Xác nhận thanh toán</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="admin.php?mod=listMenu">
        
            <span>Xem thực đơn cần nấu</span>
        </a>
        </li>

    
    <?php }
    } ?>


    </ul>
    </div>
</aside>



