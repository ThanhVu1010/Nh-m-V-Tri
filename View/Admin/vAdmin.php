<?php
include_once("Controller/cQuanly.php");

$p = new controlQuanly();

$ngayhientai = date('d-m-Y');
if (isset($_POST['sub_date'])) {
    $ngaylenmon = $_POST['date'];
} else {
    $ngaylenmon = date('Y-m-d');
}


$totalnumberofordersbydate = $p->getSoluongPhieubyNgay($ngaylenmon);
$totalnumberuser = $p->getSoluongNguoiDat($ngaylenmon);
$sumSales = $p->getSales($ngaylenmon);




function calculateTotalSales($sumSales) {
    if (!empty($sumSales)) {
        $totalSales = 0;
        foreach ($sumSales as $item) {
            $totalSales += $item['TongTien'];
        }
        return number_format($totalSales, 0, ',', '.') . ' VNĐ';
    } else {
        return number_format(0);
    }
}




?>





<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
        <div class="inside-page" style="padding:20px">
            <div class="page_title_top" style="margin-bottom: 1.5rem!important;">
                <h1 style="color: #5a5c69!important;font-size: 1.75rem;font-weight: 400;line-height: 1.2;">
                    Trang chủ
                </h1>
            </div>

            <div class="container mt-3 mb-3">
            <form action="" method="post">
                <div class="form-group mb-2">
                    <label for="date" class="mr-2">Chọn ngày thống kê:</label>
                    <input type="date" class="form-control p-2" name="date" id="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'] ?>">
                </div>
                <input type="submit" value="Submit" id="submitBtn" name="sub_date" class="btn btn-primary">
            </form>
            </div>
            <div class="container">

            




        
        <div class="row">
            <!-- Total Clients -->
            <div class="col-sm-6 col-lg-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-3">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Số lượng nhân viên đặt<span> | <?php echo isset($_POST['date']) ? date("d/m/Y", strtotime($_POST['date'])) : 'Hôm nay'; ?></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h4><?php echo isset($totalnumberuser) ? count($totalnumberuser) : '0'; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Total Menus -->
            <div class="col-sm-6 col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-3">
                                <i class="fas fa-utensils fa-4x"></i>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Số lượng phiếu đặt món<span> | <?php echo isset($_POST['date']) ? date("d/m/Y", strtotime($_POST['date'])) : 'Hôm nay'; ?></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h4><?php echo isset($totalnumberofordersbydate['TongSoLuongPhieu']) ? $totalnumberofordersbydate['TongSoLuongPhieu'] : '0'; ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Total Appointments -->
            <div class="col-sm-6 col-lg-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-3">
                                <i class="far fa-calendar-alt fa-4x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Lịch đặt món</h5>
                                
                            </div>
                        </div>
                    </div>
                    <a href="admin.php?mod=listMenu">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                </div>
                
            </div>

            <!-- Total Orders -->
            <div class="col-sm-6 col-lg-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-3">
                                <i class="fas fa-pizza-slice fa-4x"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Doanh thu <span> | <?php echo isset($_POST['date']) ? date("d/m/Y", strtotime($_POST['date'])) : 'Hôm nay'; ?></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h4><?php echo calculateTotalSales($sumSales); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- START ORDERS TABS -->
        
    </div>
        </div>

    </section>
</div>

    
