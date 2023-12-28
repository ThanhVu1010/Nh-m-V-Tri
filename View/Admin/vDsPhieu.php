<?php

include_once("Controller/cPhieudatmon.php");


$p = new controlPhieu();

if (!isset($_POST['sub_date'])) {
  $ngayHienTai = date('Y-m-d');
  $ngaylenmon = date('Y-m-d', strtotime($ngayHienTai));
} else {
    $ngaylenmon = date('Y-m-d', strtotime($_POST['date']));
}

$listOder = $p->getOrderByNgayLenMon($ngaylenmon);

?>

<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
<main id="main" class="main">

  <div class="">

    <h1>Danh sách phiếu đặt món</h1>

    <nav>
      <ol class="breadcrumb">

        <li class="breadcrumb-item">Phiếu đặt món</li>

      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div style="display: flex;">
              <h5 class="card-title">Chọn ngày xem:</h5>

              <form style="margin: 15px 20px" action="" method="post">
                <input type="date" name="date" id="date" value="<?php if (!isset($_POST['sub_date'])) {
                                                                  echo $ngayHienTai;
                                                                } else {
                                                                  echo $_POST['date'];
                                                                } ?>">
                <input style="display: none;" type="submit" value="Submit" id="submitBtn" name="sub_date">
                <input type="submit" value="Submit" id="submitBtn" name="sub_date" class="btn btn-primary">
              </form>
            </div>

            <table id="example" class="table table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Mã nhân viên</th>
                  <th>Họ tên</th>
                  <th>Điện thoại</th>
                  <th>Tên món</th>
                  <th>Số lượng</th>
                  <th>Xác nhận</th> 
                  <th>Trạng thái đơn</th>
                  <th>Thanh toán</th>                        

                </tr>
              </thead>
              <tbody>

                <?php if (!empty($listOder)) {

                  foreach ($listOder as $item) {
                    $idtaikhoan = $item['idtaikhoan'];
                    if (isset($result[$idtaikhoan])) {
                      $result[$idtaikhoan]['soluong'] += $item['soluong'];
                      $result[$idtaikhoan]['tenmonan'] .= ', ' . $item['tenmonan'];
                    } else {

                      $result[$idtaikhoan] = [
                        'idtaikhoan' => $idtaikhoan,
                        'maNV' =>  $item['maNV'],
                        'hoten' => $item['hoten'],
                        'sdt' => $item['sdt'],
                        'soluong' => $item['soluong'],
                        'tenmonan' => $item['tenmonan'],
                        'trangthai' => $item['trangthai'],
                        'duyetdon' => $item['duyetdon'],
                        'thanhtoan' => $item['thanhtoan']
                      ];
                    }
                  }
                }


                if (!empty($result)) {
                  $i = 1;
                  foreach ($result as $order) {

                ?>

                    <tr>
                      <th><?php echo $i++ ?></th>
                      <td><?php echo $order['maNV']; ?></td>
                      <td><?php echo $order['hoten']; ?></td>
                      <td><?php echo $order['sdt']; ?></td>

                      <td><?php echo $order['tenmonan']; ?></td>
                      <td><?php echo $order['soluong']; ?></td>
                      <td>
                        <?php if ($order['trangthai'] == 1) { ?>
                        <span class="badge bg-success">Đã xác nhận </span>
                        
                        <?php } else { ?>
                          <span class="badge bg-danger">Chưa xác nhận</span>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if ($order['duyetdon'] == 1) { ?>
                        <span class="badge bg-success">Đã nhận </span>
                          

                        <?php } else { ?>
                          <span class="badge bg-danger">Chưa nhận</span>


                        <?php } ?>
                      </td>
                      <td>
                        <?php if ($order['thanhtoan'] == 1) { ?>
                        <span class="badge bg-success">Đã thanh toán </span>
                          

                        <?php } else { ?>
                          <span class="badge bg-danger">Chưa thanh toán</span>


                        <?php } ?>
                      </td>
                      
                    </tr>
                <?php }
                }  ?>



              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>
    </section>
</div>