<?php

include_once("Controller/cPhieudatmon.php");


$p = new controlPhieu();




if (isset($_POST['sub_date'])) {
    $ngaylenmon = date('Y-m-d', strtotime($_POST['date']));
}elseif (isset($_POST['btn_duyet'])) {
    $ngaylenmon = date('Y-m-d', strtotime($_POST['date']));
} elseif (isset($_GET['date'])) {
    $ngaylenmon = date('Y-m-d', strtotime($_GET['date']));
} else {
  $ngayHienTai = date('Y-m-d');
  $ngaylenmon = date('Y-m-d', strtotime($ngayHienTai));
}



$_SESSION['ngayDuyet'] = $ngaylenmon;
$listOder = $p->getOrderByNgayLenMon($ngaylenmon);
$list = array();
?>
<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
<main id="main" class="main">

  <div class="">

    <h1>Duyệt phiếu đặt món</h1>

    <nav>
      <ol class="breadcrumb">

        <li class="breadcrumb-item"><?php echo $_SESSION['ngayDuyet']   ?></li>

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
                <input type="date" name="date" id="date" value="<?php echo $_SESSION['ngayDuyet'] ?>">
                <input style="display: none;" type="submit" value="Submit" id="submitBtn" name="sub_date">
                <input type="submit" value="Submit" id="submitBtn" name="sub_date" class="btn btn-primary">
              </form>
            </div>
            <form action="" method="post">
            <table id="example" class="table table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã nhân viên</th>
                    <th>Họ tên</th>
                    <th>Điện thoại</th>
                    <th>Tên món</th>
                    <th>Số lượng</th>
                    <th>Duyệt món</th>


                  </tr>
                </thead>
                <tbody>

                  <?php

                  if (!empty($listOder)) {

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
                          'duyetdon' => $item['duyetdon'],
                        ];

                        $list[] =  $result[$idtaikhoan];
                      }
                    }
                  }


                  if (!empty($result)) {
                    $i = 1;
                    foreach ($result as $order) {

                  ?>

                      <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $order['maNV']; ?></td>
                        <td><?php echo $order['hoten']; ?></td>
                        <td><?php echo $order['sdt']; ?></td>

                        <td><?php echo $order['tenmonan']; ?></td>
                        <td><?php echo $order['soluong']; ?></td>
                        <td>
                          <?php if ($order['duyetdon'] == 1) { ?>
                            <input checked type="checkbox" name="<?php echo  $order['idtaikhoan']; ?>">
                          <?php } else {
                          ?>
                            <input type="checkbox" name="<?php echo  $order['idtaikhoan']; ?>">
                          <?php } ?>
                        </td>
                      </tr>
                  <?php }
                  }  ?>



                </tbody>
              </table>
              <input type="hidden" name="date" value="<?php echo $_SESSION['ngayDuyet']  ?>">
              <input type="submit" value="Duyệt" name="btn_duyet">

            </form>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>
    </section>
</div>
<?php

if (isset($_POST['btn_duyet'])) {

  $approve = array();
  foreach ($list as $index => $item) {
    $check = $item['idtaikhoan'];
    if (isset($_POST["$check"])) {
      if ($_POST["$check"] == 'on') {
        $approve[] = array(
          'idtaikhoan' => $item['idtaikhoan'],
          'duyetdon' => 1
        );
      }
    } else {
      $approve[] = array(
        'idtaikhoan' => $item['idtaikhoan'],
        'duyetdon' => 0
      );
    }
  }

  $ngaylenmon = $_SESSION['ngayDuyet'];
$p->DuyetPhieu($approve, $ngaylenmon);

echo header("refresh: 0; url='admin.php?mod=DuyetPhieu&date=$ngaylenmon'");
}

