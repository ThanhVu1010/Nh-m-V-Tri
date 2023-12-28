<?php
include_once("Controller/cCart.php");

$p = new controlCart();
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Hàm chuyển hướng
function redirect($url) {
    header("Location: $url");
    exit;
}

// Hàm lấy thông tin người dùng
function getUserInfo() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['is_login']['idtaikhoan'])) {
        redirect('index.php?mod=login');
    }
    return $_SESSION['is_login'];
}

// Hàm tạo mới giỏ hàng hoặc cập nhật giỏ hàng hiện tại
function createOrUpdateCart($p, $idtaikhoan) {
    $idgiohang = $idtaikhoan . rand(0, 1000000);
    $idTK = $p->getIdTKChitietgiohang($idtaikhoan);

    if (!$idTK) {
        $currentDate = new DateTime();
        $ngaydat = $currentDate->format('Y-m-d H:i:s');
        $tongTien = 0;
        $p->CreateShopCart($idgiohang, $ngaydat, $tongTien);
    } else {
        $idgiohang = $idTK[0]['idgiohang'];
    }

    return $idgiohang;
}

// Hàm xử lý thêm món vào giỏ hàng
function displayMessage($message) {
    echo "<div class='alert alert-success'>$message</div>";
}
function processFoodOrder($p, $idgiohang, $idtaikhoan) {
    $id_monan = isset($_GET['id_monan']) ? $_GET['id_monan'] : null;
    $gia = isset($_GET['gia']) ? $_GET['gia'] : null;

    if ($id_monan) {
        $_SESSION['id_monan'] = $id_monan;
        $_SESSION['gia'] = $gia;
        $soLuong = 1;
        $currentDate = new DateTime();
        $ngaylenmon = isset($_SESSION['ngaylenmon']) ? $_SESSION['ngaylenmon'] : null;
        $ngaydat = $currentDate->format('Y-m-d H:i:s');

        $idTK = $p->getIdTKChitietgiohang($idtaikhoan);

        if ($idTK) {
            $idgiohang = $idTK[0]['idgiohang'];
        }

        $_SESSION['idgiohang'] = $idgiohang;
        $p->CreateShopchitietgiohang($idgiohang, $idtaikhoan, $id_monan, $soLuong, $ngaylenmon, $ngaydat, $gia);

        $date = isset($_GET['date']) ? $_GET['date'] : null;
        if ($date) {
           // Hiển thị thông báo thành công
    
           // Chuyển hướng sau một khoảng thời gian
           echo "<script>
                   setTimeout(function(){
                       window.location.href = 'index.php?mod=cart&act=Update&date=$date';
                   }, 500);
                 </script>";

        }
    }
}

// Bắt đầu xử lý
$userInfo = getUserInfo();
$idtaikhoan = $userInfo['idtaikhoan'];

$idgiohang = createOrUpdateCart($p, $idtaikhoan);

processFoodOrder($p, $idgiohang, $idtaikhoan);
?>

<section style="padding: 150px 0 100px; ">
<?php displayMessage('Món đã được thêm vào giỏ hàng thành công!'); ?>
</section>