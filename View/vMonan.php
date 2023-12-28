<?php
include 'Includes/functions/functions.php';
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
include("Controller/cMonan.php");

$p = new controlMonan();
$loaimon = $p->getAllLoaiMonAn();


if (isset($_REQUEST['idloai'])) {
    $cate = $_REQUEST['idloai'];
    $dish = $p->getAllMonanbyLoai($cate);
} elseif (isset($_REQUEST['search'])) {
    $search = $_REQUEST['search'];
    $dish = $p->getSearch($search);
}
elseif (isset($_REQUEST['date'])){
    $ngay = $_REQUEST['date'];
    $dish = $p->getAllMonAnThucdonbyDate($ngay);
}
 else {
    $dish = $p->getAllMonAnThucdon();
}

if (isset($_GET['date'])) {
    $_SESSION['ngaylenmon'] = $_GET['date'];
}
?>
<style>
    .txt{
        color: #f1f1f1;
    }
  .vertical-line {
    border-left: 1px solid #ffffff; 
    height: 100%;
  }

 
  .section-container {
    border-bottom: 1px solid #ffffff; 
    margin-bottom: 20px; 
    padding-bottom: 20px; 
  }

    

.button-container {
    display: flex;
    flex-direction: column; /* Hiển thị các nút theo chiều dọc */
}

.button {
    display: inline-block;
    padding: 10px 15px;
    margin: 5px;
    background-color: #FFCC00;
    color: #fff;
    text-decoration: none;
    border-radius: 10px;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #FF9900;
}

</style>
<script>
    function filterByBuoi() {
        var selectedBuoi = document.getElementById("selectBuoi").value;
        var currentUrl = window.location.href;
        var baseUrl = currentUrl.split('?')[0];  // Lấy phần đầu của URL (không bao gồm tham số)
        
        if (selectedBuoi) {
            // Tạo URL mới với tham số cm
            var newUrl = baseUrl + "?mod=menus&act=list&cm=" + selectedBuoi;
            window.location.href = newUrl;
        } else {
            // Nếu không có buoi nào được chọn, xóa tham số cm khỏi URL
            window.location.href = baseUrl + "?mod=menus&act=list";
        }
    }
</script>


<section style="padding: 100px 0 100px; background-color: #222227;">
  <div class="container">
    <div class="row">
    <div class="col-lg-3 col-md-5">
      <div class="sidebar">
        <div class="sidebar__item">
          <h4 class="txt">Lịch đặt món tuần này:</h4>
          <ul>
    <?php
    // Mảng chứa các ngày trong tuần
    $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');

    // Mảng lưu trữ menu
    $menu = array();

    // Duyệt qua từng ngày trong tuần
    foreach ($days as $index => $day) {
        // Lấy timestamp của ngày hiện tại trong tuần
        $timestamp = strtotime('this week ' . $day);

        // Lấy timestamp của thứ bảy trong tuần
        $saturday = strtotime('this week saturday');

        // Lấy timestamp của ngày hiện tại
        $ngayHientai = new DateTime();
        $ngayHientaiTimestamp = $ngayHientai->getTimestamp();

        // Nếu đã qua thứ bảy trong tuần, thì chọn ngày của tuần tiếp theo
        if ($ngayHientaiTimestamp >= $saturday) {
            $timestamp = strtotime('next week ' . $day);
        }

        // Định dạng ngày theo định dạng 'dd/mm/yyyy' và lưu vào mảng menu
        $menu[$index] = date('d/m/Y', $timestamp);

        // Chuyển đổi định dạng ngày thành 'yyyy-mm-dd' và lưu vào mảng newDate
        $newDate[$index] = date_format(date_create_from_format('d/m/Y',  $menu[$index]), 'Y-m-d');
        ?>

        <!-- Hiển thị thông tin ngày dưới dạng list -->
        <li><a class="text-warning" href="index.php?mod=menus&act=list&date=<?php echo $newDate[$index] ?>">Thứ <?php echo $index + 2 ?>, Ngày <?php echo $menu[$index];  ?></a></li>
    <?php
    } ?>
</ul>

        </div>



        <div class="sidebar__item">
          <div class="latest-product__text">
            <h4 class="txt">Món ăn hôm nay</h4>
            <?php $today = date("Y-m-d");


            $menuToday = $p->getAllMonAnThucdonbyDate($today);
            if ($menuToday) {
              foreach ($menuToday as $item) {

            ?>
                <div class="latest-product__slider owl-carousel">

                  <div class="latest-prdouct__slider__item">
                    <a href="#" class="latest-product__item">
                      <div class="latest-product__item__pic">
                        <img style="width: 150px;" src="Design/image/<?php echo $item['hinhanh'] ?>" alt="">
                      </div>
                      <div class="latest-product__item__text">
                        <h6 class="txt"><?php echo $item['tenmonan'] ?></h6>
                        <span class="txt"><?php echo number_format($item['gia']) ?>
                        </span>
                      </div>
                    </a>

                  </div>


                </div>
            <?php }
            } ?>


          </div>
        </div>
      </div>
      </div>
        <div class="col-md-9">
        <div class="product__discount">
                    
        <?php
            $today = new DateTime();

            // Check if today is Saturday (6) or Sunday (7)
            if ($today->format('N') == 6 || $today->format('N') == 7) {
                $tomorrow = $today->modify('next Monday')->format('Y-m-d');
            } else {
                $tomorrow = $today->add(new DateInterval('P1D'))->format('Y-m-d');
            }
            

            // Format the next business day for display
            $tomorrow_full = (new DateTime($tomorrow))->format("l, d/m/Y");
            $ngaytt = (new DateTime($tomorrow))->format("d/m/Y");
        ?>


                    <div class="section-title product__discount__title">
                        <h2 class="txt">Món ăn cho ngày tiếp theo: <?php echo $ngaytt  ?></h2>
                    </div>
                    <?php
                   // Create a new DateTime object representing the current date and time
                    $tomorrow = new DateTime();

                    // Add an interval of 1 day (P1D) to the current date and time
                    $tomorrow->add(new DateInterval('P1D'));

                    // Format the resulting date as 'Y-m-d' (year-month-day)
                    $tomorrow_date = $tomorrow->format('Y-m-d');

                    // Assuming $p is an instance of your class, adjust this part based on your actual implementation
                    $menuTomorrow = $p->getAllMonAnThucdonbyDate($tomorrow_date);

                    // Initialize a counter variable
                    $dem_tomorrow = 0;

                    ?>
<div class="menu-items-container">
    <?php
    $dem = 0;
    $total_tomorrow = $menuTomorrow->num_rows; // Đếm số món để sử dụng trong vòng lặp

    while ($row_tomorrow = $menuTomorrow->fetch_assoc()) :
        if ($dem % 4 == 0) {
            echo '<div class="row">'; // Mở hàng mới
        }
    ?>
        <div class="col-md-3 menu-item">
            <a href="?mod=chitiet&id_monan=<?php echo $row_tomorrow['id_monan']; ?>&date=<?php echo $_GET['date'] ?>" onclick="showDetails(this)">
                <div class="thumbnail" style="cursor:pointer">
                    <div class="menu-image">
                        <div class="circular-image">
                            <img src="Design/image/<?php echo $row_tomorrow['hinhanh']; ?>" style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid orange;" />
                        </div>
                    </div>
                    <p class="text-white"><b><?php echo $row_tomorrow['tenmonan']; ?></b></p>
                    <p class="text-white"><?php echo number_format($row_tomorrow['gia'], 0, ',', '.'); ?> VND</p>
                    <a href="index.php?mod=cart&act=Add&id_monan=<?php echo $row_tomorrow['id_monan']; ?>&date=<?php echo $_GET['date'] ?>" class="btn btn-danger">Thêm vào giỏ hàng</a>


                </div>
            </a>
        </div>
    <?php
        $dem++;
        if ($dem % 4 == 0 || $dem == $total_tomorrow) {
            echo '</div>'; // Đóng hàng
        }
    endwhile;
    ?>
</div>







<h2 class="text-white">Danh sách món </h2>
<?php
echo '<div class="menu-items-container">';
$dem = 0;

// Set the timezone to Vietnam
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Reset the cursor to the first position of the query result
$dish->data_seek(0);

// Count the total number of items in the query result
$totalItems = $dish->num_rows;

// Create a DateTime object for today with the correct timezone
$today = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));


// Determine the selected date based on the provided date or default to null
if (!isset($_REQUEST['date'])) {
    $selectedDate = null;
} else {
    $selectedDate = new DateTime($_REQUEST['date'], new DateTimeZone('Asia/Ho_Chi_Minh'));
}

while ($row = $dish->fetch_assoc()) {
    // Start a new row when it's the first item in the row
    if ($dem % 4 === 0) {
        echo '<div class="row">';
    }

    echo '<div class="col-md-3 menu-item">';

    // Check if a date is provided and it's less than or equal to the current date
    if ($selectedDate > $today) {
        // Display information for items that can be ordered
        echo '<a href="?mod=chitiet&id_monan='. $row['id_monan']. '&date='. $_GET['date'].'" onclick="showDetails(this)">';
        echo '<div class="thumbnail" style="cursor:pointer">';
        echo '<div class="menu-image">';
        echo '<div class="circular-image">';
        echo '<img src="Design/image/' . $row['hinhanh'] . '" style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid orange;" />';
        echo '</div>';
        echo '</div>';
        echo '<p class="text-white"><b>' . $row['tenmonan'] . '</b></p>';
        echo '<p class="text-white">' . number_format($row['gia'], 0, ',', '.') . ' VND</p>';
        echo '</div>';
        echo '</a>';
        
        // Add the "Đặt món" button
        echo '<div class="buttondatmon">';
        echo '<a href="index.php?mod=cart&act=Add&id_monan=' . $row['id_monan'] . '&date=' . $_GET['date'] . '" class="btn btn-danger">Thêm vào giỏ hàng</a>';

        echo '</div>';
    } else {
             // Display information for items that cannot be ordered
        echo '<div style="position: relative;">';
        echo '<img src="Design/image/' . $row['hinhanh'] . '" style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid orange;" />';
        echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: red; font-size: 18px; font-weight: bold;">Không thể đặt món</div>';
        echo '</div>';
        echo '<p class="text-white"><b>' . $row['tenmonan'] . '</b></p>';
        echo '<p class="text-white">' . number_format($row['gia'], 0, ',', '.') . ' VND</p>';
    }

    echo '</div>';

    // Close the row when it's the last item in the row or the last item overall
    if (($dem + 1) % 4 === 0 || $dem + 1 === $totalItems) {
        echo '</div>';
    }

    $dem++;
}

echo '</div>';
?>

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
<?php include_once ("Includes/templates/footer.php"); ?>