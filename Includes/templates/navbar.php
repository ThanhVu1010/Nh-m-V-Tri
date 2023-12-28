<!-- START NAVBAR SECTION -->
<header id="header" class="header-section" style="height: 100px;">
    <a href="index.php" class="navbar-brand text-white">
        <img src="Design/images/Nhom_vo_tri_logos_white.png" alt="Restaurant Logo" style="width: 150px;">
    </a>
    <form action="index.php" method="get">
        <input type="hidden" name="mod" value="search">
        <input type="search" name="search" placeholder="search...">
        <input type="submit" value="Search" name="btn_search">
    </form>


    <!-- Make sure to include Bootstrap CSS and JS -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
        <?php


$ngay_hien_tai = date('Y-m-d');

// Lấy mã số ngày trong tuần (1 là thứ 2, 7 là Chủ Nhật)
$ngay_trong_tuan = date('N', strtotime($ngay_hien_tai));

if ($ngay_trong_tuan >= 6) {
  // Nếu hôm nay là  thứ 7 hoặc Chủ Nhật, lấy ngày của thứ 2 tuần tiếp theo
  $ngay_mai = date('Y-m-d', strtotime('next Monday', strtotime($ngay_hien_tai)));
} else {
  // Ngược lại, lấy ngày tiếp theo sau 1 ngày
  $ngay_mai = date('Y-m-d', strtotime('+1 day', strtotime($ngay_hien_tai)));
}

?>
            <li class="navbar-item">
                <a class="navbar-link text-white" href="index.php">Trang chủ</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </li>
            <li class="navbar-item">
                <a class="navbar-link text-white" href="?mod=menus&date=<?php echo $ngay_mai ?>">Thực đơn</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </li>
            <li class="navbar-item">
                <a class="navbar-link text-white" href="?mod=introduce">Giới thiệu</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </li>

            
            <li class="navbar-item dropdown pe-3 profile-user">
    <?php if (isset($_SESSION['is_login']['hoten'])): ?>
        <a class="navbar-link text-white navbar-profile d-flex align-items-center pe-0 profile-main" href="#" role="button" data-bs-toggle="dropdown">
            <img src="./Design/images/<?php echo $_SESSION['is_login']['hinhanh'] ?>" alt="Profile" class="rounded-circle" style="width: 30px; height: 30px;">&nbsp;
            <?php if (isset($_SESSION['is_login']['hoten'])): ?>
                <span class="d-none d-md-block  ps-2"> <?php echo $_SESSION['is_login']['hoten'] ?></span>
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
                <a class="dropdown-item" href="?mod=Profile">
                    <i class="bi bi-person"></i>
                    <span class="ml-2">Hồ sơ người dùng</span>
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item" href="?mod=Order&act=dsphieu">
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


        <li class="navbar-item">
            <a style="color: white;" href="index.php?mod=cart">
                <i style="font-size: 24px; position: relative;" class="fas fa-shopping-cart"></i>
                giỏ hàng
            </a>
        </li>





        </ul>
    </nav>
</header>
<!-- END NAVBAR SECTION -->
