<?php
include_once("Controller/cMonan.php");

$p = new controlMonan();

// Retrieve data
$list_loai = $p->getAllLoaiMonAn();
$list_nguyenlieu = $p->getAllNguyenLieu();
$id_monan = $_GET['id_monan'];
$monan = $p->getLoaiMonAn($id_monan);

$dsNguyenLieu = $p->getAllNguyenLieubyIDMonan($id_monan);

// Process form submission
if (isset($_POST['btn'])) {
    $tenmonan = $_POST['tenmonan'];
    $gia = $_POST['gia'];
    $mota = $_POST['mota'];
    $id_loaimonan = isset($monan['id_loaimonan']) ? $monan['id_loaimonan'] : null;

    if ($p->isTenMonAnExists($tenmonan, $id_monan)) {
        echo '<script>alert("Tên món ăn đã tồn tại. Vui lòng chọn tên khác."); 
              </script>';
        exit; // Dừng lại nếu có tên món ăn trùng lặp
    }
    
    // Handle file upload
    if ($_FILES["upfile"]["name"] != '') {
        $tmpimg = $_FILES["upfile"]["tmp_name"];
        $typeimg = $_FILES["upfile"]["type"];
        $hinhanh = $_FILES["upfile"]["name"];
        $sizeimg = $_FILES["upfile"]["size"];
    } else {
        $hinhanh = $_REQUEST['img_old'];
        $tmpimg = '';
        $typeimg = '';
        $sizeimg = '';
    }
    error_log("Trước khi gọi hàm: id_monan = $id_monan, tenmonan = $tenmonan, gia = $gia, mota = $mota, hinhanh = $hinhanh, id_loaimonan =$id_loaimonan");
    // Update dish information
    $kq = $p->UpdateMonanById($id_monan, $tenmonan, $gia, $mota, $hinhanh, $id_loaimonan, $tmpimg = '', $typeimg = '', $sizeimg = '');
    error_log("Sau khi gọi hàm: \$kq = $kq");
    if ($kq == 1) {
        // Update ingredient quantities
        $p->DeleteNguyenLieuByIdMonAn($id_monan);

        echo '<script>alert("Cập nhật món ăn thành công")</script>';

        $slNguyenLieu = array();
        foreach ($dsNguyenLieu as $ngl) {
            $nl = $ngl['idnguyenlieu'];
            $slNguyenLieu[] = [
                'nguyenlieu' => $ngl['idnguyenlieu'],
                'soluong' => $_POST["$nl"],
            ];
        }

        $p->InsertUpdateChiTietNguyenLieuMonAn($slNguyenLieu, $id_monan);
        echo header("refresh: 0; url='admin.php?mod=DSMonAn'");
    } elseif ($kq == 0) {
        echo '<script>alert("Không thể Sửa món ăn")</script>';
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
?>
<style>
    .form-container {
        display: none;
    }

    .admin_upload .nguyenlieu {
        border: 1px solid #000;
        display: inline-block;
        width: 140px;
        position: relative;
        margin: 10px;
        padding: 2px 5px;
    }

    .admin_upload input[type="checkbox"] {
        position: absolute;
        right: -10px;
        top: 6px;
    }
</style>



<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
<div class="container-fluid px-4 add">
    <div class="upload">
        <h2 class="mt-4">Sửa món ăn</h2>
        <form action="#" enctype="multipart/form-data" method="post">
            <table class="admin_upload">

            <tr>
                <th>Tên món ăn:</th>
                <th><input type="text" name="tenmonan" id="manv" placeholder="Nhập tên món ăn" value="<?php echo isset($monan['tenmonan']) ? $monan['tenmonan'] : ''; ?>"></th>
            </tr>
            <tr>
                <th>Giá:</th>
                <th><input type="number" id="gia" name="gia" placeholder="Nhập giá" value="<?php echo isset($monan['gia']) ? $monan['gia'] : ''; ?>"></th>
            </tr>
            <tr>
                <th>Mô tả:</th>
                <th><textarea name="mota" id="" cols="30" rows="10"><?php echo isset($monan['mota']) ? $monan['mota'] : ''; ?></textarea></th>
            </tr>

                <tr>
                    <th>Loại món ăn:</th>
                    <th> <select name="loaimonan" id="option" class="insert">
                            <?php foreach ($list_loai  as $title_item) {
                                if ($title_item['id_loaimonan'] == $monan['id_loaimonan']) {
                            ?>
                                    <option value="<?php echo $title_item['id_loaimonan'] ?>" selected><?php echo $title_item['tenloaimonan'] ?></option>
                                <?php  } else {
                                ?>
                                    <option value="<?php echo $title_item['id_loaimonan'] ?>"><?php echo $title_item['tenloaimonan'] ?></option>
                            <?php }
                            } ?>
                        </select></th>
                </tr>

                <tr>
                    <th><span>Số lượng nguyên liệu cần dùng <br> cho một suất ăn:</span></th>

                    <th>


                        <?php
                        if (!empty($dsNguyenLieu)) {
                            foreach ($dsNguyenLieu as $index => $item) {
                        ?>
                               <br> <label id="idnguyenlieu<?php echo $item['idnguyenlieu'] ?>" for="checkbox<?php echo $index ?>">Số lượng cần dùng của <?php echo $item['tennguyenlieu'] ?>:</label>
                                <input type="text" id="soluong<?php echo $item['idnguyenlieu'] ?>" name="soluong<?php echo $item['idnguyenlieu'] ?>" value="<?php echo $item['soluongsudung'] ?>">
                                <label id="donvitinh<?php echo $item['donvitinh'] ?>" for="checkbox<?php echo $index ?>"><?php echo $item['donvitinh'] ?></label>
                        <?php
                            }
                        } ?>


                    </th>
                </tr>

                <tr>

                    <th colspan="2" style="text-align: center;" class="justify-content-center">
                        <button class="btn btn-warning"><a href="admin.php?mod=UpDateNguyenLieu&id_monan=<?php echo $_GET['id_monan'] ?>">Thay đổi nguyên liệu</a></button>
                    </th>


                </tr>
                <tr>
    <th>Ảnh hiện tại:</th>
    <th> <img style="width: 150px;" src="Design/image/<?php echo isset($monan['hinhanh']) ? $monan['hinhanh'] : 'default_image.jpg'; ?>" alt="Current Image"></th>
</tr>


                <tr>
                    <th>Cập nhật ảnh mới:</th>
                    <th><input type="file" name="upfile" id=""></th>
                </tr>
                <tr>

                <tr>
    <td>
        <input type="hidden" name="img_old" value="<?php echo isset($monan['hinhanh']) ? $monan['hinhanh'] : ''; ?>">
    </td>
</tr>

                    <td>
                        <input type="submit" value="Sửa" id="submit" name="btn">
                        <input type="reset" value="Hủy" id="reset" name="btn">


                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>
    </section>
</div>

<script>
<?php $tenmonan = array();
foreach ($dsNguyenLieu as $nguyenLieu) {
    $tenmonan[] = $nguyenLieu['tennguyenlieu'];
}
?>
var nguyenlieu = <?php echo json_encode($tenmonan); ?>;

var formsContainer = document.getElementById('checkboxes-container');

for (var i = 0; i < nguyenlieu.length; i++) {
    // Tạo form
    var form = document.createElement('div');
    form.id = 'form' + i;
    form.className = 'form-container';
    form.innerHTML = `
        <label for="soluong${i}">Số lượng cần dùng của ${nguyenlieu[i]}:</label>
        <input type="text" id="soluong${i}" name="soluong${i}"><br>
        <div id="result${i}"></div>
    `;
    formsContainer.appendChild(form);
}

var checkboxes = document.querySelectorAll('.show-form');
checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        var formId = this.getAttribute('data-form');
        var formContainer = document.getElementById(formId);

        if (this.checked) {
            formContainer.style.display = 'block';
        } else {
            formContainer.style.display = 'none';
        }
    });
});

</script>
