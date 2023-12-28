
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="Design/css/login.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="" id="form-login" method="post">
                <h1 class="form-heading">ĐĂNG NHẬP</h1>
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-input" placeholder="Tên đăng nhập" name="username">
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <input type="password" class="form-input" placeholder="Mật khẩu" name="password">
                    <div id="eye">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
                <input type="submit" value="Đăng nhập" class="form-submit" name="btn_login">
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Xin chào !</h1>
                    <p>Chào mừng bạn đến với bếp ăn Vô Tri - Nơi ẩm thực thăng hoa</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="text/javascript" src="Design/js/login.js"></script>
    
</body>

</html>
<?php
include_once("Controller/clogin.php");

if (isset($_REQUEST['btn_login'])) {
    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);

    // Check if either username or password is empty
    if (empty($username)) {
        echo "<script>alert('Vui lòng nhập tên đăng nhập.');</script>";
        // Optionally, you can redirect to the login page or perform other actions here
    } elseif (empty($password)) {
        echo "<script>alert('Vui lòng nhập mật khẩu.');</script>";
        // Optionally, you can redirect to the login page or perform other actions here
    } else {
        $p = new controllogin();
        $tblUser = $p->getAllLogin($username, $password);

        // Check if $tblUser is empty or the login attempt is unsuccessful
        if (empty($tblUser)) {
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng kiểm tra lại và thử lại.');</script>";
            // Optionally, you can redirect to the login page or perform other actions here
        } else {
            // Assuming the login is successful, you can proceed with role-based redirection
            if ($_SESSION['is_login']['vaitro'] == 1 || $_SESSION['is_login']['vaitro'] == 2 || $_SESSION['is_login']['vaitro'] == 3) {
                header("Location: admin.php");
                exit();
            } elseif ($_SESSION['is_login']['vaitro'] == 4) {
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Error: Bạn không có quyền truy cập trang web');</script>";
                // Optionally, you can redirect to the login page or perform other actions here
            }
        }
    }
}
?>




