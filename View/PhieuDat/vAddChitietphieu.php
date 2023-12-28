<?php

// Hàm thực hiện việc xử lý và lưu thông tin đơn hàng
function processAndSaveOrderDetails() {
    // Bao gồm các file cần thiết
    include_once("Controller/cPhieudatmon.php");
    include_once("Controller/cCart.php");

    // Khởi tạo đối tượng controlCart để quản lý giỏ hàng
    $cart = new controlCart();

    // Khởi tạo đối tượng controlPhieu để quản lý phiếu đặt hàng
    $p = new controlPhieu();

    // Lấy thông tin từ session
    $idtaikhoan = $_SESSION['is_login']['idtaikhoan'];
    $currentDate = new DateTime();
    $tongtien = 0;
    $ngaydat = $currentDate->format('Y-m-d H:i:s');

    // Lấy ngày lên món từ tham số GET
    $_SESSION['ngaylenmon'] = $_GET['ngaylenmon'];
    $ngaylenmon = $_GET['ngaylenmon'];

    // Lấy danh sách sản phẩm trong giỏ hàng theo idtaikhoan và ngày lên món
    $dsmua = $cart->GetAllCartByIdTaiKhoanAndDate($idtaikhoan, $ngaylenmon);

    // Tạo một mảng để lưu thông tin đơn hàng sau khi xử lý
    $result = [];

    // Kiểm tra nếu danh sách sản phẩm không trống
    if (!empty($dsmua)) {
        foreach ($dsmua as $item) {
            $idtaikhoan = $item['idtaikhoan'];
            $ngaylenmon = $item['ngaylenmon'];

            // Kiểm tra xem mảng kết quả đã có mục với idtaikhoan và ngaylenmon tương ứng chưa
            if (isset($result[$idtaikhoan][$ngaylenmon])) {
                $result[$idtaikhoan][$ngaylenmon]['soluong'] += $item['soluong'];
                $result[$idtaikhoan][$ngaylenmon]['tenmonan'] .= ', ' . $item['tenmonan'];
            } else {
                // Tạo một mục mới trong mảng kết quả cho idtaikhoan và ngaylenmon
                $result[$idtaikhoan][$ngaylenmon] = [
                    'idtaikhoan' => $idtaikhoan,
                    'maNV' => $item['maNV'],
                    'hoten' => $item['hoten'],
                    'sdt' => $item['sdt'],
                    'soluong' => $item['soluong'],
                    'tenmonan' => $item['tenmonan'],
                    'ngaylenmon' => $item['ngaylenmon']
                ];
            }
        }
    }

    // Gọi hàm InsertPhieu để lưu đơn hàng vào cơ sở dữ liệu
    $p->InsertPhieu($idtaikhoan, $result[$idtaikhoan], $tongtien, $ngaydat);

    // Chuyển hướng trang sau khi xử lý xong
    echo header("refresh: 0; url='index.php?mod=Order&act=AddPhieu'");
}

// Gọi hàm để thực hiện xử lý đơn hàng
processAndSaveOrderDetails();

?>
