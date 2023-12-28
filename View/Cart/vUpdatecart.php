<?php
include_once("Controller/cCart.php");
$p = new controlCart();

date_default_timezone_set('Asia/Ho_Chi_Minh');

function processAndUpdateCart($p) {
    $idtaikhoan = isset($_SESSION['is_login']['idtaikhoan']) ? $_SESSION['is_login']['idtaikhoan'] : null;
    if (!$idtaikhoan) {
        // Người dùng chưa đăng nhập, không có gì để xử lý
        return;
    }

    $ngaylenmon = isset($_SESSION['ngaylenmon']) ? $_SESSION['ngaylenmon'] : null;
    if (!$ngaylenmon) {
        // Ngày lên món không tồn tại, không có gì để xử lý
        return;
    }

    $idTK = $p->getAllDetailCartAndDate($idtaikhoan, $ngaylenmon);

    $foods = array();

    foreach ($idTK as $item) {
        $id_monan = $item['id_monan'];
        $SL = $item['soluong'];

        if (isset($foods[$id_monan])) {
            $foods[$id_monan]['soluong'] += $SL;
        } else {
            $foods[$id_monan] = $item;
        }
    }

    $soluong = $foods[$id_monan]['soluong'];
    $currentDate = new DateTime();
    $ngaytao = $currentDate->format('Y-m-d H:i:s');

    $p->UpdateShopchitietgiohang($id_monan, $soluong, $ngaylenmon);
}

function redirectToDeleteDuplicate($date) {
    header("refresh: 0; url='index.php?mod=cart&act=DeleteDuplicate&date=$date'");
    exit;
}

// Bắt đầu xử lý
processAndUpdateCart($p);

$date = isset($_GET['date']) ? $_GET['date'] : null;
if ($date) {
    redirectToDeleteDuplicate($date);
}
?>
