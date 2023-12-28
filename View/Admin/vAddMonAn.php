<?php
include_once("Controller/cMonan.php");

$p = new controlMonan;

$list_loai  = $p->getAllLoaiMonAn();
$list_nguyenlieu = $p->getAllNguyenLieu();
$listMonAn = $p->getAllMonAn();

if (isset($_REQUEST["btn_addDish"])) {
    $error = array();

    // Kiểm tra kiểu dữ liệu của $listMonAn
    if (is_array($listMonAn)) {
        foreach ($listMonAn as $item) {
            // Kiểm tra kiểu dữ liệu của $item
            if (is_array($item) && isset($item['tenmonan'])) {
                if (strcasecmp(trim($_REQUEST["tenmonan"]), trim($item['tenmonan'])) == 0) {
                    $error['tenmonan'] = 'Món ăn đã tồn tại !';
                }
            }
        }
    }

    if (empty($_REQUEST['tenmonan'])) {
        $error['empty']['tenmonan'] = 'Chưa nhập món ăn *';
    }
    if (empty($_REQUEST['gia'])) {
        $error['empty']['gia'] = 'Chưa nhập giá *';
    }
    if (empty($_REQUEST['mota'])) {
        $error['empty']['mota'] = 'Chưa nhập mô tả *';
    }
    if ($_REQUEST['loaimonan'] == 0) {
        $error['empty']['loaimonan'] = 'Chưa chọn loại món ăn *';
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
        <h2 class="mt-4 m-3">Thêm món ăn mới</h2>
        <form action="#" enctype="multipart/form-data" method="post">
            <table class="admin_upload">

                <tr>
                    <th>Tên món ăn:</th>
                    <th><input type="text" name="tenmonan" id="manv" placeholder="Nhập tên món ăn">
                        <p class="text-danger"><?php if (!empty($error['tenmonan'])) {
                                                    echo  $error['tenmonan'];
                                                } elseif (!empty($error['empty']['tenmonan'])) {
                                                    echo  $error['empty']['tenmonan'];
                                                } ?></p>


                    </th>
                </tr>
                <tr>
                    <th>giá:</th>
                    <th><input type="number" id="gia" name="gia" placeholder="nhập giá">
                        <p class="text-danger"><?php if (!empty($error['empty']['gia']))   echo  $error['empty']['gia'];   ?></p>

                    </th>
                </tr>

                <tr>
                    <th>Mô tả</th>
                    <th><textarea name="mota" id="" cols="30" rows="10"></textarea>
                        <p class="text-danger"><?php if (!empty($error['empty']['mota']))   echo  $error['empty']['mota'];   ?></p>

                    </th>
                </tr>
                <tr>
                    <th>Loại món ăn:</th>
                    <th>

                        <select name="loaimonan" id="option" class="insert">
                            <option value="0">chọn Loại món....</option>

                            <?php foreach ($list_loai  as $title_item) { ?>
                                <option value="<?php echo $title_item['id_loaimonan'] ?>"><?php echo $title_item['tenloaimonan'] ?></option>
                            <?php  } ?>
                        </select>

                        <p class="text-danger"><?php if (!empty($error['empty']['loaimonan']))   echo  $error['empty']['loaimonan'];   ?></p>

                    </th>
                </tr>
                <tr>

                    <th>Nguyên liệu cho món ăn:</th>
                    <th>


                        <?php foreach ($list_nguyenlieu as $index => $item) { ?>
                            <div class="nguyenlieu">
                                <label for="checkbox<?php echo $index ?>"><?php echo $item['tennguyenlieu'] ?></label>
                                <input type="checkbox" class="show-form" data-form="form<?php echo $index ?>" id="checkbox<?php echo $index ?>" style="margin-right:20px;" name="nguyenlieu[]" id="" value="<?php echo $item['idnguyenlieu'] ?>">
                            </div>
                        <?php  } ?>


                    </th>

                </tr>
                <tr>
                    <th><span>Trọng lượng nguyên liệu cần nấu giá trị/suất ăn:</span>

                    </th>
                    <th>
                        <div id="checkboxes-container"> </div>
                    </th>
                </tr>

                <tr>
                    <th>Ảnh món ăn:</th>
                    <th><input type="file" name="upfile" id=""></th>
                </tr>
                <tr>

                    <td>

                    </td>
                    <td>
                        <input type="submit" value="Thêm" id="submit" name="btn_addDish">
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

<script>
    <?php $tenmonanAn = array();
    foreach ($list_nguyenlieu as $nguyenLieu) {
        $tenmonanAn[] = $nguyenLieu['tennguyenlieu'];
    }
    ?>
    var nguyenlieu = <?php echo json_encode($tenmonanAn); ?>;


    var formsContainer = document.getElementById('checkboxes-container');

    for (var i = 0; i < ingredients.length; i++) {


        // Tạo form
        var form = document.createElement('div');
        form.id = 'form' + i;
        form.className = 'form-container';
        form.innerHTML = `
               
                    <label for="soluong${i}">Số lượng cần dùng của ${nguyenlieu[i]} :</label>
                    <input type="text" id="soluong${i}" name="soluong${i}"><br>
                    <div id="result${i}"></div>
             
            `;
        formsContainer.appendChild(form);

    }

    var checkboxes = document.querySelectorAll('.show-form');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
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

<?php

if (isset($_POST['btn_addDish'])) {
    if (empty($error)) {
        $tenmonan = $_POST['tenmonan'];
        $gia = $_POST['gia'];
        $mota = $_POST['mota'];
        $id_loaimonan = $_POST['loaimonan'];
        $hinhanh = $_FILES["upfile"]["name"];
        $tmpimg = $_FILES["upfile"]["tmp_name"];
        $typeimg = $_FILES["upfile"]["type"];
        $sizeimg = $_FILES["upfile"]["size"];


        $kq = $p->InsertMonanNew($tenmonan, $gia, $mota, $hinhanh, $id_loaimonan, $tmpimg, $typeimg, $sizeimg);

        if ($kq == 1) {

            echo '<script>alert("Thêm món thành công")</script>';


            $dsSLNL = array();

            foreach ($list_nguyenlieu as $index => $ngl) {
                if (isset($_POST["nguyenlieu"]) && !empty($_POST["soluong$index"])) {
                    $dsSLNL[] = [
                        'nguyenlieu' => $_POST["nguyenlieu"],
                        'soluong' => $_POST["soluong$index"]
                    ];
                }
            }

            $id_monan = $p->getMonanMoi();
            $id_monan = $id_monan['id_monan'];
            $p->InsertChiTietNguyenLieuMonAn($dsSLNL, $id_monan);
        } elseif ($kq == 0) {
            echo '<script>alert("Không thể thêm món")</script>';
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


