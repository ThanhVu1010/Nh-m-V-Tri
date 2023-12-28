<?php


include 'Includes/functions/functions.php'; 
include 'Includes/templates/adminHeader.php';
include 'Controller/cQuanly.php';

$p = new controlQuanly();
?>
<main id="main" class="main">

  <div class="" >
    <h1>Hồ sơ</h1>
  </div><!-- End Page Title -->
  <div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper section profile" style="width: 100%;padding: 70px 0 0;">
 
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img src="Design/images/<?php echo $_SESSION['is_login']['hinhanh'] ?>" alt="Profile" class="rounded-circle" style="width: 100px; height: 100px;">
            <?php if (isset($_SESSION['is_login']['hoten'])) { ?>
              <h2><?php echo $_SESSION['is_login']['hoten']; ?></h2>
              <h3><?php echo $_SESSION['is_login']['tenvaitro']; ?></h3>
            <?php } ?>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Chi tiết hồ sơ</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Đổi mật khẩu</button>
              </li>
            </ul>
            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h3 class="card-title">Chi tiết hồ sơ</h3>
                
                <div class="row">
                  <div class="col-lg-3 col-md-4"><h5>Mã nhân viên:</h5></div>
                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['is_login']['maNV']; ?></div>
                  <div class="col-lg-3 col-md-4"><h5>Họ và tên:</h5></div>
                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['is_login']['hoten']; ?></div>
                  <div class="col-lg-3 col-md-4"><h5>Chức vụ:</h5></div>
                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['is_login']['tenvaitro']; ?></div>
                  <div class="col-lg-3 col-md-4"><h5>Email:</h5></div>
                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['is_login']['email']; ?></div>
                  <div class="col-lg-3 col-md-4"><h5>Số điện thoại:</h5></div>
                  <div class="col-lg-9 col-md-8"><?php echo $_SESSION['is_login']['sdt']; ?></div>
                </div>
              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="" method="post">

                  <div class="row mb-3">
                    <label for="matkhauhientai" class="col-md-4 col-lg-3 col-form-label">Mật khẩu hiện tại</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="matkhau" type="password" class="form-control" id="matkhauhientai" required>
                      <span class="text-danger"> <?php
                                                  if (!empty($error['matkhau'])) {
                                                    echo '<i class="bi bi-exclamation-circle"></i>' . $error['matkhau'];
                                                  } ?></span>

                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="matkhaumoi" class="col-md-4 col-lg-3 col-form-label">Mật khẩu mới</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="matkhaumoi" type="password" class="form-control" id="matkhaumoi" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="nhaplaimatkhau" class="col-md-4 col-lg-3 col-form-label">Nhập lại mật khẩu mới</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="nhaplaimatkhau" type="password" class="form-control" id="nhaplaimatkhau" required>
                      <span class="text-danger"> <?php if (!empty($error['nhaplaimatkhau'])) {
                                                    echo '<i class="bi bi-exclamation-circle"></i>' .  $error['nhaplaimatkhau'];
                                                  } ?></span>
                    </div>

                  </div>

                  <div class="text-center">
                    <input class="btn btn-primary" type="submit" value="Đổi mật khẩu" name="btn_pass">

                  </div>
                </form>

              </div>

            </div><!-- End Bordered Tabs -->
          </div>
        </div>

      </div>
    </div>
  </section>
  
  </div>
  

</main>

<?php 
$error = array();



$idtaikhoan = null;
$matkhauSession = null;



// Check if both 'idtaikhoan' and 'matkhau' are set in the session
if (isset($_SESSION['is_login']['idtaikhoan'], $_SESSION['is_login']['matkhau'])) {
    $idtaikhoan = $_SESSION['is_login']['idtaikhoan'];
    $matkhauSession = $_SESSION['is_login']['matkhau'];
} else {
    // Handle the case when 'idtaikhoan' or 'matkhau' is not set
    echo "Error: User ID or 'matkhau' not found in the session.";
    // You might want to redirect the user or display an error message.
    exit(); // Terminate the script or handle it as appropriate.
}

// ... (rest of your code)



// ... (rest of your code)

    if (isset($_POST['btn_pass'])) {
      $matkhau = $_POST['matkhau'];
      $matkhaumoi = $_POST['matkhaumoi'];
      $nhaplaimatkhau = $_POST['nhaplaimatkhau'];
    
    
      if ($matkhau != $matkhauSession) {
        $error['matkhau'] = 'Mật khẩu nhập sai';
      } else {
        unset($error['matkhau']);
      }
    
      if ($matkhaumoi != $nhaplaimatkhau) {
        $error['nhaplaimatkhau'] = 'Mật khẩu không khớp';
      }else {
        unset($error['nhaplaimatkhau']);
    
      }
    
    
      if (empty($error)) {
        $matkhau = $nhaplaimatkhau;
        $pas = $p->DoiMatKhau($idtaikhoan, $matkhau);
        if ($pas == 1) {
            echo '<script>
                    if (confirm("Thay đổi mật khẩu thành công. Bạn có muốn đăng nhập lại không?")) {
                        window.location.href = "index.php?mod=logout";
                    } else {
                        alert("Bạn đã thay đổi mật khẩu thành công. Bạn có thể đăng nhập lại sau.");
                    }
                  </script>';
        } else {
            echo '<script>alert("Không thể thay đổi mật khẩu")</script>';
        }


      }
    }
    
    
    ?>
