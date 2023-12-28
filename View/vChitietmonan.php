<?php
include_once("Controller/cMonan.php");


$p = new controlMonan();


if (isset($_GET['id_monan'])) {
    $id_monan = $_GET['id_monan'];
    $monan = $p->getShowchitiet($id_monan);
    
    if (!$monan) {
        echo "Không có món ăn nào được tìm thấy với ID này.";
        exit; // Stop execution if no menu item is found
    }
} else {
    echo "Không có ID món ăn được cung cấp.";
    exit; // Stop execution if no ID is provided
}

if (isset($_POST['btn'])) {
    // Check if the user is logged in
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}
// In ra giá trị của biến session
if (isset($_SESSION['is_login']) && is_array($_SESSION['is_login'])) {
    // Kiểm tra xem 'idtaikhoan' có tồn tại trong 'is_login' không
    if (isset($_SESSION['is_login']['idtaikhoan'])) {
        // Lấy giá trị 'idtaikhoan'
        $idtaikhoan = $_SESSION['is_login']['idtaikhoan'];

        // Tiếp tục xử lý
        // ...

    } else {
        // Xử lý khi 'idtaikhoan' không tồn tại trong 'is_login'
        echo 'Không có ID tài khoản.';
        exit;
    }
} else {
    // Xử lý khi 'is_login' không tồn tại
    echo 'Không có thông tin đăng nhập.';
    exit;
}


$comment = $p->getBinhluanByIdMonAn($id_monan);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết món ăn</title>
    <style>
        body{
            background-color: black;
            color: white;
        }
        /* Định dạng hình ảnh */
        .chitiet img {
            width: 650px; /* Điều chỉnh kích thước để nó đầy đủ cả chiều rộng của phần chứa */
            height: 400px; /* Đảm bảo tỷ lệ khung hình được giữ nguyên */
            object-fit: cover; /* Hiển thị toàn bộ hình ảnh và không bị méo */
        }

        /* Định dạng phần thông tin món ăn */
        .info {
            overflow: hidden;
            margin-top: 20px;
        }

        .name {
            font-size: 24px;
            font-weight: bold;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #e44d26; /* Màu cam, có thể điều chỉnh tùy ý */
            margin-top: 10px;
        }

        .order {
            margin-top: 10px;
        }

        /* Định dạng tabs */
        .nav-tabs {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<section style="padding: 100px 0 100px; background-color: #222227;">
<div class="container mt-5 ">
    <div class="row">
        <div class="col-md-8">
            <div class="chitiet">
                <img src="Design/image/<?php echo $monan['monan']['hinhanh']; ?>" alt="<?php echo $monan['monan']['tenmonan']; ?>">
            </div>
        </div>
        <div class="col-md-4">
        <div class="info">
    <div class="name"><h2><?php echo $monan['monan']['tenmonan']; ?></h2></div>
    <div class="product__details__rating">
                                <i class="">&#9733;</i>
                                <i class="">&#9733;</i>
                                <i class="">&#9733;</i>
                                <i class="">&#9733;</i>
                                <i class="">&#9733;</i>
                                <span>(<?php if (!empty($comment)) {
                                            echo count($comment);
                                        } else {
                                            echo 0;
                                        } ?> nhận xét)</span>
                            </div>
    <div class="price"><?php echo number_format($monan['monan']['gia'], 0, ',', '.') ?> VNĐ</div>
    <div><h3>Nguyên liệu bao gồm:</h3></div>

    <?php
    if (isset($monan['nguyenlieu']) && is_array($monan['nguyenlieu'])) {
        echo '<ul>';
        foreach ($monan['nguyenlieu'] as $nguyenlieu) {
            // Hiển thị thông tin nguyên liệu với số lượng sử dụng và đơn vị tính
            echo '<li>' . $nguyenlieu['tennguyenlieu'] . ': ' . $nguyenlieu['soluongsudung'] . ' ' . $nguyenlieu['donvitinh'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Không có nguyên liệu.';
    }
    ?>
        <a href="index.php?mod=cart&act=Add&id_monan=<?php echo $monan['monan']['id_monan']; ?>&date=<?php echo $_GET['date'] ?>" class="btn btn-danger">Thêm vào giỏ hàng</a>
 
</div>


        </div>

        <!-- Tabs cho mô tả và đánh giá -->
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="moTa-tab" data-toggle="tab" href="#moTa">Mô tả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="danhGia-tab" data-toggle="tab" href="#danhGia">Đánh giá</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="moTa">
                    <p><?php echo $monan['monan']['mota']; ?></p>
                </div>
                <div class="tab-pane fade" id="danhGia">
                <div class="upload">
                    <h2 class="mt-4 m-3">Bình luận</h2>
                    <form action="#" enctype="multipart/form-data" method="post">
                        <table class="admin_upload">

                            <tr>
                                <th><textarea name="noidung" id="" cols="100" rows="5"></textarea></th>
                            </tr>
                            <div id="rating" class="rating">
                                <input type="radio" name="danhgia" id="star5" value="5" />
                                <label for="star5" class="star" data-value="5">
                                    <div class="stas"><span class="sta text-warning">&#9733;&#9733;&#9733;&#9733;&#9733;</span>&nbsp;&nbsp;(Siêu ngon)
                                    </div>
                                </label><br>
                                <input type="radio" name="danhgia" id="star4" value="4" />
                                <label for="star4" class="star" data-value="4">
                                    <div class="stas"><span class="sta text-warning">&#9733;&#9733;&#9733;&#9733;</span>&nbsp;&nbsp;(Ngon)
                                    </div>
                                </label><br>
                                <input type="radio" name="danhgia" id="star3" value="3" />
                                <label for="star3" class="star" data-value="3">
                                    <div class="stas "><span class="sta text-warning">&#9733;&#9733;&#9733;</span>&nbsp;&nbsp;(Tạm
                                        được)</div>
                                </label><br>
                                <input type="radio" name="danhgia" id="star2" value="2" />
                                <label for="star2" class="star" data-value="2">
                                    <div class="stas "><span class="sta text-warning">&#9733;&#9733;</span>&nbsp;&nbsp;(Dở)</div>
                                </label><br>
                                <input type="radio" name="danhgia" id="star1" value="1" />
                                <label for="star1" class="star" data-value="1">
                                    <div class="stas "><span class="sta text-warning">&#9733;</span>&nbsp;&nbsp;(Rất
                                        dở)</div>
                                </label>
                            </div>
                            <tr>
                                <td>
                                    <input type="submit" name="btn" class="btn btn-primary" value="Gửi">
                                </td>
                            </tr>

                            <?php
                                if (isset($_POST['btn'])) {
                                    // Check if the user is logged in
                                    if (session_status() == PHP_SESSION_NONE) {
                                        session_start();
                                    }
                                
                                    // In ra giá trị của biến session
                                    if (isset($_SESSION['is_login']) && is_array($_SESSION['is_login'])) {
                                        // Kiểm tra xem 'idtaikhoan' có tồn tại trong 'is_login' không
                                        if (isset($_SESSION['is_login']['idtaikhoan'])) {
                                            // Lấy giá trị 'idtaikhoan'
                                            $idtaikhoan = $_SESSION['is_login']['idtaikhoan'];
                                
                                            // Tiếp tục xử lý
                                            // ...
                                
                                            // Comment processing logic here
                                            if (isset($_POST['btn'])) {
                                                $idtaikhoan = $_SESSION['is_login']['idtaikhoan'];
                                                if (!$idtaikhoan) {
                                                    echo '<script>alert("Vui lòng đăng nhập trước khi bình luận.")</script>';
                                                } else {
                                                    // Sanitize and validate input
                                                    $noidung = isset($_POST['noidung']) ? htmlspecialchars($_POST['noidung']) : '';
                                                    $danhgia = isset($_POST['danhgia']) ? intval($_POST['danhgia']) : 0;
                                                    $id_monan = isset($_GET['id_monan']) ? intval($_GET['id_monan']) : 0;
                                                    $ngaygui = date("Y-m-d H:i:s");
                                
                                                    // Insert comment using a prepared statement
                                                    $kq = $p->InsertBinhluan($idtaikhoan, $id_monan, $noidung, $danhgia, $ngaygui);
                                
                                                    if ($kq) {
                                                        echo '<script>alert("Bình luận thành công")</script>';
                                                    } else {
                                                        echo '<script>alert("Có lỗi xảy ra. Vui lòng thử lại sau.")</script>';
                                                    }
                                                }
                                            }
                                        } else {
                                            // Xử lý khi 'idtaikhoan' không tồn tại trong 'is_login'
                                            echo 'Không có ID tài khoản.';
                                            exit;
                                        }
                                    } else {
                                        // Xử lý khi 'is_login' không tồn tại
                                        echo 'Không có thông tin đăng nhập.';
                                        exit;
                                    }
                                }
                                ?>
                        </table>
                    </form>
                </div>


                    <div class="product__details__text">
                        <div class="tab-pane <?php echo (!empty($comment)) ? 'tab-pane-show' : ''; ?>" id="tabs-3" role="tabpanel">
                            <div class="container" style="border-radius: 14px; background-color: #222227; width: 100%;">
                                <div class="cmt border-top border-bottom mb-4" style="margin-top: 140px;">

                                <?php if (!empty($comment)) : ?>
                                    <?php foreach ($comment as $item) : ?>
                                        <div class="comment shadow-lg p-3 mb-5 bg-dark" style="border-radius: 20px; position: relative;" id="<?= $item['idBinhluan'] ?>">

                                            <div class="row">
                                                <div class="col-md-12" style="display: flex; align-items: center;">
                                                    <span class="name" style="font-weight: bold;"><?= $item['hoten'] ?></span>&nbsp;
                                                    <span class="date ml-1"><?= date(" H:i d/m/Y", strtotime($item['ngaygui'])); ?></span>
                                                </div>
                                            </div>

                                            <div class="row ml-3">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-4 rating">
                                                    <?php for ($i = 0; $i < $item['danhgia']; $i++) : ?>
                                                        <span class="star text-warning">&#9733;</i></span>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>

                                            <div class="row ml-3">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-8">
                                                    <p class="message"><?= $item['noidung'] ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <h4 class="text-center">Chưa có đánh giá nào</h4>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
</section>

<section class="widget_section" style="background-color: black;padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                <img src="./Design/images/Nhom_vo_tri_logos_white.png" alt="Restaurant Logo" style="width: 150px;margin-bottom: 20px;">
                    <div class="footer_widget">
                        
                        <p>
                            Bếp ăn chúng tui cam kết đem lại cho nhân viên công ty những bữa ăn chất lượng và đầy đủ dinh dưỡng
                        </p>
                        <ul class="widget_social">
                            <li><a href="#" data-toggle="tooltip" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="LinkedIn"><i class="fab fa-linkedin fa-2x"></i></a></li>
                            <li><a href="#" data-toggle="tooltip" title="Google+"><i class="fab fa-google-plus-g fa-2x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                     <div class="footer_widget">
                        <h3>Địa chỉ</h3>
                        <p>
                            Số 4, Nguyễn Văn Bảo, Phường 4, Gò Vấp
                        </p>
                        <p>
                            votri666.@gmail.com <br>
                            0123456789
                        </p>
                     </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>
                            Thời gian hoạt động
                        </h3>
                        <ul class="opening_time">
                            <li>Thứ 2 _ 6:30am - 6:00pm</li>
                            <li>Thứ 3 _ 6:30am - 6:00pm</li>
                            <li>Thứ 4 _ 6:30am - 6:00pm</li>
                            <li>Thứ 5 _ 6:30am - 6:00pm</li>
                            <li>Thứ 6 _ 6:30am - 6:00pm</li>
                            <li>Thứ 7 _ 6:30am - 6:00pm</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
						<div class="footer_widget">
                        <h3>
                            Thời gian hoạt động
                        </h3>
                   
						<ul class="footer_social">
							<li><a href="#">Đặt món</a></li> <br>
							<li><a href="#">Giới thiệu</a></li><br>
							<li><a href="#">Báo cáo vấn đề</a></li><br>
						</ul>
					
                    </div>
					</div>
            </div>
        </div>
    </section>

</body>
</html>






 

   
