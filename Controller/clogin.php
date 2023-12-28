<?php
include_once("Model/mlogin.php");

class controllogin
{
    function getAllLogin($username, $password)
    {
        $p = new modellogin();
        $tblLogin = $p->selectLogin();

        if ($tblLogin) {
            // Kiểm tra kết quả nhận được có dữ liệu không
            if ($tblLogin->num_rows > 0) {
                while ($item = $tblLogin->fetch_assoc()) {
                    if ($username == $item['tendangnhap'] && $password == $item['matkhau']) {
                        $_SESSION['login'] = true;
                        $_SESSION['is_login'] = array();
                        $_SESSION['is_login']['hoten'] = $item['hoten'];
                        $_SESSION['is_login']['vaitro'] = $item['vaitro'];
                        $_SESSION['is_login']['idtaikhoan'] = $item['idtaikhoan'];
                        $_SESSION['is_login']['tenvaitro'] = $item['tenvaitro'];
                        $_SESSION['is_login']['tendangnhap'] = $item['tendangnhap'];
                        $_SESSION['is_login']['maNV'] = $item['maNV'];
                        $_SESSION['is_login']['sdt'] = $item['sdt'];
                        $_SESSION['is_login']['email'] = $item['email'];
                        $_SESSION['is_login']['ngaytao'] = $item['ngaytao'];
                        $_SESSION['is_login']['hinhanh'] = $item['hinhanh'];
                        $_SESSION['is_login']['matkhau'] = $item['matkhau']; 
                        return 1;
                    }
                }
            } else {
                // Xử lý trường hợp không có dữ liệu
                return -1;
            }
        } else {
            // Xử lý trường hợp có lỗi truy vấn
            return -1;
        }

        return 0;
    }
}
?>
