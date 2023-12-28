<?php
include_once("Controller/cMonan.php");
$p = new controlMonan();

$listNguyenLieu = $p->getNguyenLieu();


if (isset($_REQUEST["btn"])) {
    $error = array();
    foreach ($listNguyenLieu  as $item) {
        if (strcasecmp(trim($_REQUEST["tennguyenlieu"]), trim($item['tennguyenlieu'])) == 0) {
            $error['tennguyenlieu'] = 'Nguyên liệu đã tồn tại !';
        }
        if (empty($_REQUEST['tennguyenlieu'])) {
            $error['empty']['tennguyenlieu'] = 'Chưa nhập nguyên liệu *';
        }
    }
}
?>

<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
<div class="container-fluid px-4 add">
    <div class="upload">
        <h2 class="mt-4 m-3">Thêm nguyên liệu mới</h2>
        <form action="#" enctype="multipart/form-data" method="post">
            <table class="admin_upload">

                <tr>
                    <th>Tên nguyên liệu:</th>
                    <th><input type="text" name="tennguyenlieu" placeholder="Nhập tên nguyên liệu">
                        <p class="text-danger"><?php if (!empty($error['tennguyenlieu'])) {
                                                    echo   $error['tennguyenlieu'];
                                                } elseif (!empty($error['empty']['tennguyenlieu'])) {
                                                    echo   $error['empty']['tennguyenlieu'];
                                                } ?></p>
                    </th>
                </tr>

                <tr>

                    <td>

                    </td>
                    <td>
                        <input type="submit" value="Thêm" id="submit" name="btn">
                        <input type="reset" value="Hủy" id="reset" name="btn_file">


                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>
    </section>
</div>
</body>

</html>

<?php
if (isset($_POST['btn'])) {
    // Assuming 'tennguyenlieu' is the name attribute of your input field
    $tennguyenlieu = isset($_POST['tennguyenlieu']) ? $_POST['tennguyenlieu'] : '';

    // Now $tennguyenlieu should be defined and can be used in your logic
    $kq = $p->InsertNguyenLieuMoi($tennguyenlieu);
    echo '<script>alert("Thêm nguyên liệu thành công")</script>';
}
?>