<?php

include_once("Controller/cQuanly.php");

$p = new controlQuanly();


$list_user = $p->getVaitro();

$idtaikhoan = $_GET['idtaikhoan'];
$user  = $p->getUserById($idtaikhoan);
$diff = $p->getUsersDifferentIdTaiKhoan($idtaikhoan);

if (isset($_REQUEST["btn"])) {
    $error = array();
    foreach ($diff  as $item) {
        if ($_REQUEST["email"] == $item['email']) {
            $error['email'] = 'Email đã tồn tại !';
        }
        if (empty($_REQUEST['maNV'])) {
            $error['empty']['maNV'] = 'Chưa nhập mã nhân viên *';
        }
        if (empty($_REQUEST['tendangnhap'])) {
            $error['empty']['tendangnhap'] = 'Chưa nhập tên đăng nhập *';
        }
        if (empty($_REQUEST['hoten'])) {
            $error['empty']['hoten'] = 'Chưa nhập họ tên *';
        }
        if (empty($_REQUEST['sdt'])) {
            $error['empty']['sdt'] = 'Chưa nhập số điện thoại *';
        }
        if (empty($_REQUEST['email'])) {
            $error['empty']['email'] = 'Chưa nhập email *';
        }
        if (empty($_REQUEST['vaitro'])) {
            $error['empty']['vaitro'] = 'Chưa chọn chức vụ *';
        }
        if ($_REQUEST["maNV"] == $item['maNV']) {
            $error['maNV'] = 'Mã nhân viên đã tồn tại !';
        }
        if ($_REQUEST["tendangnhap"] == $item['tendangnhap']) {
            $error['tendangnhap'] = 'tên đăng nhập đã tồn tại !';
        }
        if ($_REQUEST["sdt"] == $item['sdt']) {
            $error['sdt'] = 'Số điện thoại đã tồn tại !';
        }
    }
}

?>
<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
<div class="container-fluid px-4 add mt-3">
    <div class="upload p-3" style="position: relative;">
        <h3 class="mb-5">Sửa người dùng</h3>


        <table class="admin_upload">
            <form action="" enctype="multipart/form-data" method="post">
                <tr>
                    <th>Mã nhân viên:</th>
                    <th><input type="text" name="maNV" id="maNV" placeholder="Nhập mã nhân viên" value="<?php echo $user['maNV'] ?>">
                        <p class="text-danger"><?php if (!empty($error['maNV'])) {
                                                    echo  $error['maNV'];
                                                } elseif (!empty($error['empty']['maNV'])) {
                                                    echo  $error['empty']['maNV'];
                                                }   ?></p>
                    </th>
                    </th>
                </tr>
                <tr>
                    <th>Mật khẩu:</th>
                    <th><input type="password" id="matkhau" name="matkhau" placeholder="nhập mật khẩu" value="<?php echo $user['matkhau'] ?>">

                    </th>
                </tr>

                <tr>
                    <th>Tên đăng nhập:</th>
                    <th><input type="text" name="tendangnhap" id="tendangnhap" placeholder="Nhập tên đăng nhập" value="<?php echo $user['tendangnhap'] ?>">
                        <p class="text-danger"><?php if (!empty($error['tendangnhap'])) {
                                                    echo  $error['tendangnhap'];
                                                } elseif (!empty($error['empty']['tendangnhap'])) {
                                                    echo  $error['empty']['tendangnhap'];
                                                }    ?></p>
                    </th>
                </tr>
                <tr>
                    <th>Họ tên:</th>
                    <th><input type="text" name="hoten" placeholder="Nhập họ tên" value="<?php echo $user['hoten'] ?>">
                        <p class="text-danger"><?php if (!empty($error['empty']['hoten'])) {
                                                    echo  $error['empty']['hoten'];
                                                }    ?></p>
                    </th>
                </tr>
                <tr>
                <tr>
                    <th>Số điện thoại:</th>
                    <th><input type="number" name="sdt" placeholder="Nhập số điện thoại" value="<?php echo $user['sdt'] ?>">
                        <p class="text-danger"><?php if (!empty($error['sdt'])) {
                                                    echo  $error['sdt'];
                                                } elseif (!empty($error['empty']['sdt'])) {
                                                    echo  $error['empty']['sdt'];
                                                }   ?></p>
                    </th>
                </tr>
                <tr>
                    <th>Email:</th>
                    <th><input type="text" name="email" placeholder="Nhập email" value="<?php echo $user['email'] ?>">
                        <p class="text-danger"><?php if (!empty($error['email'])) {
                                                    echo  $error['email'];
                                                } elseif (!empty($error['empty']['email'])) {
                                                    echo  $error['empty']['email'];
                                                }   ?></p>
                    </th>
                </tr>
                <tr>
                    <th>Thêm ảnh:</th>
                    <th>
                        <input type="file" name="upfile" id="">

                    </th>
                </tr>
                <tr>
                    <th>Chọn chức vụ:</th>
                    <th>
                        <?php foreach ($list_user as $title_item) {

                            if ($user['vaitro'] == $title_item['idvaitro']) { ?>
                                <input checked type="radio" id="" name="vaitro" value="<?php echo $title_item['idvaitro'] ?>">
                                <label for="age1"><?php echo $title_item['tenvaitro'] ?></label>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>


                            <?php } else {
                            ?><input type="radio" id="" name="vaitro" value="<?php echo $title_item['idvaitro'] ?>">
                                <label for="age1"><?php echo $title_item['tenvaitro'] ?></label>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <?php }
                        } ?>
                        <p class="text-danger"><?php if (!empty($error['empty']['vaitro'])) {
                                                    echo  $error['empty']['vaitro'];
                                                }    ?></p>
                    </th>
                </tr>
                <tr>

                    <td>
                        <input type="hidden" name="hinhanh" value="<?php echo $user['hinhanh'] ?>">

                    </td>
                    <td>
                        <input type="submit" value="Cập nhật" id="submit" name="btn">
                        <input type="reset" value="Hủy" id="reset" name="btn">


                    </td>
                </tr>
            </form>
        </table>
    </div>
</div>
    </section>
</div>

</body>

</html>
<?php


if (isset($_REQUEST["btn"])) {
    if (empty($error)) {

    $maNV = $_REQUEST["maNV"];
    $matkhau = $_REQUEST["matkhau"];
    $tendangnhap = $_REQUEST["tendangnhap"];
    $hoten = $_REQUEST["hoten"];
    $sdt = $_REQUEST["sdt"];
    $email = $_REQUEST["email"];
    $vaitro = $_REQUEST["vaitro"];
    $hinhanh = $_REQUEST['hinhanh'];




    $p = new controlQuanly();

    $kq = $p->UpdateUser($idtaikhoan, $matkhau, $maNV, $hoten, $sdt, $email, $hinhanh, $vaitro, $tmpimg = '', $typeimg = '', $sizeimg = '');

    if ($kq == 1) {
        echo '<script>alert("Sửa nhân viên thành công")</script>';
        if ($_GET['po'] == 'NVBep') {
            echo header("refresh:0; url='admin.php?mod=NhanVienBep");
        } else {
            echo header("refresh:0; url='admin.php?mod=NhanVienCongTy'");
        }
    } elseif ($kq == 0) {
        echo '<script>alert("Không thể sửa nhân viên")</script>';
    } elseif ($kq == -1) {
        echo '<script>alert("Không thể Upload ảnh")</script>';
    } elseif ($kq == -2) {
        echo '<script>alert("Kích thước size phải nhỏ hơn 10MB")</script>';
    } elseif ($kq == -3) {
        echo '<script>alert("File thêm dữ liệu phải là file ảnh")</script>';
    } else {
        echo "Lỗi";
    }
}

}
?>