<?php


include_once("Controller/cCart.php");

$p = new controlCart();





$ngayHomNay = date('y-m-d');
$p->DeleteMonanCartDate($ngayHomNay);
?>
<style>
    td {
        border-left: none !important;
        border-right: none !important;

    }
</style>
<?php
if (isset($_SESSION['login'])) {
    $idTK = $_SESSION['is_login']['idtaikhoan'];
    $list_buy = $p->getAllCartByIdTaiKhoan($idTK);
?>

    <main id="main" class="main" style="padding: 100px 0 100px; ">
    

        <div class="pagetitle">

        <h1 class="text-center m-3 p-3"><i class="fa-solid fas fa-shopping-cart"></i> Giỏ hàng </h1>
            <div class="col-lg-12 col-md-7">
                <?php


                if (!empty($list_buy)) {
                ?>
                    <div class="container ">


                        <div class="row" style="margin-left: 150px;">

                            <?php
                            $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

                            foreach ($daysOfWeek as $index => $day) {
                                $timestamp = strtotime('this week ' . $day);
                                $saturday = strtotime('this week Saturday');
                                $ngayHientai = new DateTime();
                                $ngayHientaiTimestamp = $ngayHientai->getTimestamp();

                                if ($ngayHientaiTimestamp >= $saturday) {
                                    $timestamp = strtotime('next week ' . $day);
                                }

                                $ngaydat = date('d/m/Y', $timestamp);
                                $ngaylenmon = date('Y-m-d 00:00:00', $timestamp);

                                $hasVisibleContent = false; // Biến kiểm tra xem có nội dung hiển thị hay không

                                foreach ($list_buy as $item) {
                                    if ($item['ngaylenmon'] === $ngaylenmon) {
                                        $hasVisibleContent = true; // Có nội dung hiển thị
                                        break;
                                    }
                                }

                                if ($hasVisibleContent) {
                            ?>
                             
                                    <div class="col-lg-12">

                                        <h6><b>Đặt cho thứ <?php echo $index + 2; ?> ngày <?php echo $ngaydat; ?></b></h6>
                                        <div class="shoping__cart__table table table-striped">
                                            <table style="align-items: center;">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Ảnh</th>
                                                        <th>Tên món</th>
                                                        <th>Đơn giá</th>
                                                        <th>Số lượng</th>
                                                        <th>Tổng tiền</th>
                                                        <th></th>                                                     
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    $tongTien = 0;
                                                    $total = array();
                                                    foreach ($list_buy as $item) {
                                                        if ($item['ngaylenmon'] === $ngaylenmon) {

                                                    ?>
                                                            <tr>
                                                                <td><?php echo $i++ ?></td>
                                                                <td class="shoping__cart__item">
                                                                    <img src="Design/image/<?php echo $item['hinhanh']; ?>" alt="" width="100" height="100">
                                                                </td>

                                                                <td class="shoping__cart__title" >
                                                                    <h5><?php echo $item['tenmonan']; ?></h5>
                                                                </td>


                                                                <td class="shoping__cart__price">
                                                                    <?php echo number_format($item['gia']); ?>
                                                                    <sup>đ</sup>
                                                                </td>
                                                                <td class="shoping__cart__quantity">

                                                                    <form id="myForm" action="" method="post">
                                                                        <input type="number" name="slcart" min='1' max="5" value="<?php echo $item['soluong']; ?>" id="slcart<?php echo $item['id_monan'] . $timestamp; ?>">
                                                                        <input type="hidden" name="id_monan" value="<?php echo $item['id_monan']; ?>">
                                                                        <input type="hidden" name="ngaylenmon" value="<?php echo $item['ngaylenmon']; ?>">
                                                                        <input style="display: none;" type="submit" value="Submit" id="btn_sl<?php echo $item['id_monan'] . $timestamp; ?>" name="btn_sl<?php echo $item['id_monan'] . $timestamp; ?>">
                                                                    </form>
                                                                </td>
                                                                <td class="shoping__cart__total">
                                                                    <?php echo number_format($item['soluong'] * $item['gia']); ?>
                                                                    <sup>đ</sup>
                                                                    <?php
                                                                    $tongTien += $item['soluong'] * $item['gia'];


                                                                    ?>
                                                                </td>
                                                                <td class="shoping__cart__item__close">
                                                                    <a style="border-radius: 5px; background-color: #ccc; padding:2px 5px; color:#000; " href="index.php?mod=cart&act=DeleteMonan&id_monan=<?php echo $item['id_monan'] ?>">X</a>
                                                                </td>
                                                            </tr>

                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td colspan="5">
                                                            <h6>Tổng tiền:</h6>
                                                        </td>
                                                        <td>
                                                            <h5><b><?php echo number_format($tongTien) ?> <sup>đ</sup></b></h5>
                                                        </td>
                                                    </tr>
                                                </tbody>                                                
                                            </table> <br>
                                            <div style="margin-left: 650px;">
                                                <a style="border-radius:10px; background-color: steelblue; padding: 10px 10px; color: #fff;" href="#" onclick="confirmOrder('<?php echo $item['ngaylenmon']; ?>')"><b>Đặt món</b></a>
                                                <a style="border-radius:10px; background-color: red;  padding: 10px 10px; color: #fff;" href="#" onclick="confirmCancel('<?php echo $item['idgiohang']; ?>')"><b>Hủy món</b></a>
                                            </div>

                                            <script>
                                            function confirmOrder(ngaylenmon) {
                                                var result = confirm("Bạn có chắc chắn muốn đặt món này không?");
                                                if (result) {
                                                    // Nếu người dùng chấp nhận, chuyển hướng đến trang xử lý đặt món
                                                    window.location.href = "index.php?mod=Order&act=OrderDate&ngaylenmon=" + ngaylenmon;
                                                } else {
                                                    // Người dùng không chấp nhận, không làm gì cả hoặc thực hiện các xử lý khác
                                                }
                                            }

                                            function confirmCancel(idgiohang) {
                                                var result = confirm("Bạn có chắc chắn muốn hủy món này không?");
                                                if (result) {
                                                    // Nếu người dùng chấp nhận, chuyển hướng đến trang xử lý hủy món
                                                    window.location.href = "index.php?mod=cart&act=DeleteGioHang&idgiohang=" + idgiohang;
                                                } else {
                                                    // Người dùng không chấp nhận, không làm gì cả hoặc thực hiện các xử lý khác
                                                }
                                            }
                                            </script>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>


                        </div>
                     

                    </div>

                <?php } else { ?>
                    <div >
                        <h3 style="text-align:center;">Bạn không có món ăn nào trong giỏ hàng!!!</h3>
                        <h3 style="text-align:center;">Xin hãy thêm món ăn vào để đặt món!!!</h3><br>
                        <a style="margin-left: 600px; border-radius:10px;" class="btn btn-danger" href="index.php?mod=menus&date=<?php echo $ngayHomNay ?>"><b>Quay lại trang Thực đơn</b></a>

                    </div>
                <?php } ?>

            </div>
        </div>



    </main>

    <?php } else { ?>
    <script>
        alert("Bạn cần đăng nhập để truy cập giỏ hàng!");
        window.location.href = "index.php?mod=login"; // Điều hướng đến trang đăng nhập
    </script>
<?php } ?>
<?php

if (!empty($list_buy)) {
    foreach ($list_buy as $item) {
        $timestamp = strtotime($item['ngaylenmon']);

        $post = 'btn_sl' . $item['id_monan'] .  $timestamp;



        if (isset($_POST["$post"])) {
            $soluong = $_POST['slcart'];
            $id_monan = $_POST['id_monan'];
            $ngaylenmon = $_POST['ngaylenmon'];


            $success = $p->UpdateShopchitietgiohang($id_monan, $soluong, $ngaylenmon);
            if ($success) {
                echo header("refresh: 0; url='index.php?mod=cart'");
            }
        }
    }
}
?>

<?php
if (!empty($list_buy)) {
    foreach ($list_buy as $item) {
        $timestamp = strtotime($item['ngaylenmon']);
?>
        <script>
            var slcartInput<?php echo $item['id_monan'] . $timestamp ?> = document.getElementById('slcart<?php echo $item['id_monan'] . $timestamp; ?>');
            var submitButton<?php echo $item['id_monan'] . $timestamp; ?> = document.getElementById('btn_sl<?php echo $item['id_monan'] . $timestamp; ?>');

            // Xử lý sự kiện onchange cho trường nhập
            slcartInput<?php echo $item['id_monan'] . $timestamp; ?>.onchange = function() {
                submitButton<?php echo $item['id_monan'] . $timestamp; ?>.click();
            };
        </script>
<?php }
} ?>
<script>
    // Lưu vị trí cuộn khi rời khỏi trang
    window.addEventListener('unload', function() {
        localStorage.setItem('scrollPos', window.pageYOffset);
    });

    // Khôi phục vị trí cuộn khi tải lại trang
    window.addEventListener('load', function() {
        const scrollPos = parseInt(localStorage.getItem('scrollPos'), 10);
        if (!isNaN(scrollPos)) {
            window.scrollTo(0, scrollPos);
            localStorage.removeItem('scrollPos');
        }
    });
</script>


<section class="widget_section" style="background-color: #222227;padding: 100px 0;">
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