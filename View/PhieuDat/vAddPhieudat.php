<?php

function processOrderAndRedirect() {
    // Import các file cần thiết
    include_once("Controller/cPhieudatmon.php");
    include_once("Controller/cCart.php");

    // Lấy thông tin người dùng từ phiên đăng nhập
    $idtaikhoan = $_SESSION['is_login']['idtaikhoan'];

    // Lấy ngày lên món từ phiên trước đó
    $ngaylenmon = $_SESSION['ngaylenmon'];

    // Khởi tạo đối tượng controlCart và controlPhieu
    $cart = new controlCart();
    $p = new controlPhieu();

    // Lấy danh sách đơn hàng mới tạo và danh sách món trong giỏ hàng
    $dsphieu = $p->getOrderNewCreateByIdTaiKhoan($idtaikhoan);
    $dsgio = $cart->getCart();

    // Thực hiện chèn thông tin đơn hàng vào CSDL
    $p->InsertChiTietPhieu($dsgio, $dsphieu);

    // Xóa giỏ hàng của người dùng sau khi đã đặt món
    $cart->DeleteCartByidTKAndNgay($idtaikhoan, $ngaylenmon);

    // ------------------------------------Tính tổng hóa đơn

    // Lấy thông tin chi tiết đơn hàng và đơn hàng
    $OrderDetail = $p->getOrderDetail();
    $Order = $p->getAllOrder();

    // Tính tổng tiền cho mỗi món trong đơn hàng
    $tongTienDonHang = array();

    foreach ($OrderDetail as $od) {
        // Kiểm tra giá trị gia
        if (!isset($od['gia']) || !is_numeric($od['gia'])) {
            echo '<script>alert("Lỗi: Giá không hợp lệ.")</script>';
            exit();
        }

        // Kiểm tra giá trị soluong
        if (!isset($od['soluong']) || !is_numeric($od['soluong'])) {
            echo '<script>alert("Lỗi: Số lượng không hợp lệ.")</script>';
            exit();
        }

        // Tính tổng tiền
        $tongtien = $od['gia'] * $od['soluong'];

        $od['tongtien'] = $tongtien;
        $tongTienDonHang[] = $od;
    }

    // Tính tổng tiền cho mỗi đơn hàng
    $totalByPhieuId = array();
    foreach ($tongTienDonHang as $item) {
        if (isset($item['idPhieu'])) {
            $idPhieu = $item['idPhieu'];
            $tongtien = $item['tongtien'];

            if (isset($totalByPhieuId[$idPhieu])) {
                $totalByPhieuId[$idPhieu] += $tongtien;
            } else {
                $totalByPhieuId[$idPhieu] = $tongtien;
            }
        } else {
            // Hiển thị thông báo alert nếu giá trị là null
            echo '<script>alert("Lỗi: ID phiếu không hợp lệ.")</script>';
            exit();
            // Thực hiện các hành động khác (nếu có) để xử lý lỗi
        }
    }

    // Cập nhật tổng tiền cho mỗi đơn hàng
    $p->UpdateTotalOrder($totalByPhieuId);

    // Lấy ngày hiện tại
    $date = date('Y-m-d');

    // Chuyển hướng về trang danh sách món ăn
    header("refresh: 0; url='index.php?mod=Order&act=dsphieu&date=$date'");
}

// Gọi hàm để thực hiện các hành động
processOrderAndRedirect();
?>
