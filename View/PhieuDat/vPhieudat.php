<?php

include_once("Controller/cPhieudatmon.php");
include_once("Controller/cQuanly.php");


$us = new controlQuanly();


$p = new controlPhieu();

$idtaikhoan = $_SESSION['is_login']['idtaikhoan'];
$user = $us->getUserById($idtaikhoan);

$duyetdon = '';
$trangthai = '';
if (isset($_GET['trangthai']) || isset($_GET['duyetmon'])) {
    if (isset($_GET['duyetmon'])) {
        $duyetdon = $_GET['duyetmon'];
    }
    if (isset($_GET['trangthai'])) {
        $trangthai = $_GET['trangthai'];
    }
    $listOder = $p->getPhieuByidTaiKhoanFind($idtaikhoan, $trangthai, $duyetdon);
} else {
    $listOder = $p->getPhieuByidTaiKhoan($idtaikhoan);
}

$total = $p->getSumbyidtaikhoan($idtaikhoan);



    //////////Cập nhật lại tổng tiền và số lượng cho bảng đơn đặt món theo idPhieu;
    $OrderDetail = $p->getOrderDetail();

    $tongTienDonHang = array();
    foreach ($OrderDetail as $od) {
        $tongtien = $od['gia'] * $od['soluong'];
        $od['tongtien'] = $tongtien;
        $tongTienDonHang[] = $od;
    }
    
    
    $totalByPhieuId = array();
    foreach ($tongTienDonHang as $item) {
        $idPhieu = $item['idPhieu'];
        $tongtien = $item['tongtien'];
        $tongsoluong = $item['soluong'];
    
    
        if (isset($totalByPhieuId[$idPhieu])) {
            $totalByPhieuId[$idPhieu]['tongtien'] += $tongtien;
            $totalByPhieuId[$idPhieu]['soluong'] +=     $tongsoluong; 
        } else {
            $totalByPhieuId[$idPhieu]['tongtien'] = $tongtien;
            $totalByPhieuId[$idPhieu]['soluong'] =     $tongsoluong; 
    
        }
    }
     
 
        $p->UpdateTongAndSoluongPhieu($totalByPhieuId);
 

    
  


?>

<main id="main" class="main">

    <div class="pagetitle">


        <div class="col-lg-12 col-md-12 ">
            <nav class="navbar navbar-expand-sm bg-light shadow-lg p-3 mb-5 bg-body rounded-  position-fixed" style="top: 100px; z-index: 10; margin-left: -15px; width: 100%;">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        

                        <li class="nav-item mt-2" style="margin-left: 1000px; width: 300px;">
                            <?php
                            $totalAmount = !empty($total[0]['tongtien']) ? number_format($total[0]['tongtien']) : 0;
                            $total = !empty($total[0]['tongtien']) ? $total[0]['tongtien'] : 0;
                            $user = $user['hoten'] ;
                            ?>

                            <h5 class="text-dark float-right mb-3">
                                Tổng tiền cần thanh toán: 
                                <span class="text-danger"><b><?php echo $totalAmount; ?> VND</b></span>
                            </h5>

                            <?php if ($total != 0): ?>
                                <button class="btn btn-danger mt-2" style="float: right; margin-bottom: 10px">
                                    <a class="text-light" href="index.php?mod=Order&act=ThanhToan&total=<?php echo $total ?>&user=<?php echo $user ?>">
                                        Thanh toán
                                    </a>
                                </button>
                            <?php endif; ?>
                        </li>



                    </ul>
                </div>

            </nav>

<br><br><br>


<?php
$resultArray = array();

// Kiểm tra xem $listOder có tồn tại và là một mảng hoặc đối tượng hay không
if (!empty($listOder) && (is_array($listOder) || is_object($listOder))) {
    foreach ($listOder as $item) {
        $idPhieu = $item['idPhieu'];
        if (!isset($resultArray[$idPhieu])) {
            // Nếu idPhieu chưa tồn tại trong mảng kết quả, thêm một mảng mới với khóa là idPhieu
            $resultArray[$idPhieu] = array();
        }
        // Thêm phần tử vào mảng idPhieu tương ứng
        $resultArray[$idPhieu][] = $item;
    }

    // Chuyển mảng kết quả thành mảng tuần tự nếu bạn muốn
    $resultArray = array_values($resultArray);
} else {
    // Xử lý trường hợp $listOder không phải là mảng hoặc đối tượng hoặc là mảng rỗng
    echo "<div style='padding-top: 70px'>";
    echo "Không có phiếu!!!";
    echo "</div>";
}
?>



<style>
     @keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    color: palevioletred;
  }
  60% {
    
  }
}

.noOrder  {
  display: inline-block;
  animation: bounce 1s infinite;
}

</style>
<div style="margin-top: 150px; padding-left: 150px;">

<?php foreach ($resultArray as $index => $order): ?>
    <div class="container m-3 shadow-lg p-3 mb-5 bg-body rounded">
    <?php $isFirstIteration = true; ?>

        <?php foreach ($order as $item): ?>
            <?php if ($isFirstIteration): ?>
                <?php if ($item['trangthai'] == 0): ?>
                    <h5><span class="badge bg-warning  mb-3 p-2"></i>Chưa nhận món</span></h5>
                <?php else: ?>
                    <h5><span class="badge bg-success mb-3 p-2"></i>Đã nhận món</span></h5>
                <?php endif; ?>
                <?php if ($item['duyetdon'] == 0): ?>
                    <h5><span class="badge bg-primary  mb-3 p-2"></i>Phiếu chưa được duyệt</span></h5>
                <?php else: ?>
                    <h5><span class="badge bg-success mb-3 p-2"></i>Phiếu đã được duyệt</span></h5>
                <?php endif; ?>
                <?php if ($item['thanhtoan'] == 0): ?>
                    <h5><span class="badge bg-danger  mb-3 p-2"></i>Chưa thanh toán</span></h5>
                <?php else: ?>
                    <h5><span class="badge bg-success mb-3 p-2"></i>Đã Thanh Toán</span></h5>
                <?php endif; ?>

                <?php $isFirstIteration = false; ?>
            <?php endif; ?>
        <?php endforeach; ?>


        <?php foreach ($order as $item): ?>
            <div class="row border-top border-bottom">
                <div class="col-md-1 p-2">
                    <img src="Design/image/<?php echo $item['hinhanh'] ?>" class="img-fluid img-thumbnail" alt="Không có hình">
                </div>

                <div class="col-md-8 d-flex flex-column ">
                    <h5 class="name-product mt-3 mb-2"><b><?php echo $item['tenmonan'] ?></b></h5>
                    <p class="mb-2">x<?php echo $item['soluong'] ?></p>
                </div>

                <div class="col-md-3 d-flex flex-column align-items-end justify-content-center p-2">
                    <span class="text-danger"><?php echo number_format($item['gia'] * $item['soluong']) ?> VND</span>
                </div>
                                     <!-- ... (Các phần còn lại của mã HTML) ... -->
            </div>
        <?php endforeach; ?>

        <?php
       $prices = array_column($order, 'gia');
       $quantities = array_column($order, 'soluong');
       $totalPrice = array_sum(array_map(function ($price, $quantity) {
           return $price * $quantity;
       }, $prices, $quantities));
       
        $ngaynhan = (new DateTime($item['ngaylenmon']))->format("d/m/Y");
        ?>

        <div class="row mt-3">
            <div class="col-md-3 d-flex flex-column align-items-start justify-content-start p-2">
                <span>Ngày nhận: <?php echo $ngaynhan; ?></span>
            </div>
            <div class="col-md-9 d-flex flex-column align-items-end justify-content-end p-2">
                <h5>Thành tiền: <span class="text-danger"><?php echo number_format($totalPrice) ?> VND</span></h5>
            </div>

            <div style="margin-left: 1000px;">
            <?php $cancelButtonDisplayed = false; ?>
<?php foreach ($order as $item): ?>
    <?php if ($item['thanhtoan'] == 0 && !$cancelButtonDisplayed): ?>
        <a class="btn btn-danger" href="#" onclick="confirmDelete('<?php echo $item['idPhieu']; ?>')"><b>Hủy phiếu</b></a>
        <?php $cancelButtonDisplayed = true; ?>
    <?php endif; ?>
<?php endforeach; ?>


            </div>

            <script>
                function confirmDelete(idPhieu) {
                    var result = confirm("Bạn có chắc chắn muốn hủy phiếu này không?");
                    if (result) {
                        window.location.href = "index.php?mod=Order&act=DeletePhieu&idPhieu=" + idPhieu;
                    } else {
                        // Người dùng không chấp nhận, không làm gì cả hoặc thực hiện các xử lý khác
                    }
                }
            </script>
        </div>
    </div>
<?php endforeach; ?>

</div>

        </div>
    </div>



</main>
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
