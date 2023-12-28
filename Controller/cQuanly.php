<?php 

include('Model/mQuanly.php');

class controlQuanly
{
function getVaitro(){
    $p = new modelQuanly();
    $tbl = $p->SelectVaitro();
    return  $tbl;
}

function getUsersDifferentIdTaiKhoan($idtaikhoan){
    $p = new modelQuanly();
    $tbl = $p->SelectUsersDifferentIdTaiKhoan($idtaikhoan);
    return  $tbl;
}


function getUser(){
    $p = new modelQuanly();
    $tbl = $p->SelectUser();
    return  $tbl;
}

function getUserById($idtaikhoan)
{
    $p = new modelQuanly();
    $tbl = $p->SelectUserById($idtaikhoan);
    return  $tbl;
}


function getSoluongPhieubyNgay($ngaylenmon)
{
    $p = new modelQuanly();
    $tbl = $p->selectSoluongPhieubyNgay($ngaylenmon);
    return  $tbl;
}

function getSoluongNguoiDat($ngaylenmon)
{
    $p = new modelQuanly();
    $tbl = $p->selectSoluongNguoiDat($ngaylenmon);
    return  $tbl;
}

function getSales($ngaylenmon){
    $p = new modelQuanly();
    $tbl = $p->selectSales($ngaylenmon);
    return  $tbl;
}

function getNhanvienBep(){
    $p = new modelQuanly();
    $tbl = $p->selectNhanvienBep();
    return  $tbl;
}

function getselectNhanvienCongty(){
    $p = new modelQuanly();
    $tbl = $p->selectNhanvienCongty();
    return  $tbl;
}

function DeleteUser($idtaikhoan){
    $p = new modelQuanly();
    $tbl =$p->DeleteUser($idtaikhoan);
    return  $tbl;
}
function  UpdateUser($idtaikhoan, $matkhau, $maNV, $hoten, $sdt, $email, $hinhanh, $vaitro, $tmpimg = '', $typeimg = '', $sizeimg = '')
{
    $upload_success = false;
    if ($typeimg != '') {
        $type_array = explode('/',   $typeimg);
        $image_type = $type_array[0];
        if ($image_type == "image" && $sizeimg <= 10 * 1024 * 1024) {
            if (move_uploaded_file($tmpimg, "Design/image/" . $hinhanh)) {
                $upload_success = true;
            } else {
                return -1;
            }
        } else {
            return -2;
        }
    }
    $p = new modelQuanly();
    $update =  $p->UpdateUser($idtaikhoan, $matkhau, $maNV, $hoten, $sdt, $email, $hinhanh, $vaitro);
    if ($update) {
        return 1;
    } else {
        return 0;
    }
}
function DoiMatKhau($idtaikhoan, $matkhau){
    $p = new modelQuanly();
    $tbl =$p->DoiMatKhau($idtaikhoan, $matkhau);
    return  $tbl;
}

function getUsers(){
    $p = new modelQuanly();
    $tbl = $p->SelectUsers();
    return  $tbl;
}
function InsertUser($tendangnhap, $matkhau, $maNV, $hoten, $sdt, $email, $hinhanh, $ngaytao, $vaitro, $tmpimg, $typeimg, $sizeimg) {
    if ($hinhanh != '') {
        $type_array = explode('/', $typeimg);
        $image_type = $type_array[0];

        if ($image_type == "image") {
            if ($sizeimg <= 10 * 1024 * 1024) {
                try {
                    if (!move_uploaded_file($tmpimg, "assets/imageProfile/" . $hinhanh)) {
                        throw new Exception('Failed to move uploaded file');
                    }
                } catch (Exception $e) {
                    return -1; // Lỗi khi di chuyển tệp tin
                }
            } else {
                return -2; // Kích thước tệp tin vượt quá giới hạn
            }
        } else {
            return -3; // Không phải loại hình ảnh
        }
    } else {
        $hinhanh = 'user.jpg';
    }

    // Kiểm tra dữ liệu đầu vào
    if (empty($tendangnhap) || empty($matkhau) || empty($maNV) || empty($hoten) || empty($sdt) || empty($email) || empty($ngaytao) || empty($vaitro)) {
        return -4; // Dữ liệu đầu vào không hợp lệ
    }

    $p = new modelQuanly();

    $ins = $p->InsertUser($tendangnhap, $matkhau, $maNV, $hoten, $sdt, $email, $hinhanh, $ngaytao, $vaitro);

    if ($ins) {
        return 1; // Thêm người dùng thành công
    } else {
        return 0; // Thêm người dùng thất bại
    }
}





}
?>