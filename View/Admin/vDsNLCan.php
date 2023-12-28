<?php
include_once("Controller/cMonan.php");


$p = new controlMonan();


if (!isset($_POST['sub_date'])) {
  $ngayHienTai = date('Y-m-d');
  $ngaylenmon = date('Y-m-d', strtotime($ngayHienTai));
} else {
    $ngaylenmon = date('Y-m-d', strtotime($_POST['date']));
}


$list = $p->getOrderbyDate($ngaylenmon);
?>

<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
<main id="main" class="main">

  <div class="">
    <h1>Xem thực đơn nguyên liệu cần nấu</h1>

    <div class="row">
      <div class="col-md-3">

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
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th>STT</th>
              <th>Tên món</th>
             
              <th>Số lượng</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            $Monan = array();
            if (!empty($list)) {
              foreach ($list as $index => $item) {
                $Monan[] = array(
                  'id_monan' => $item['id_monan'],
                  'soluong' => $item['tongSoLuong'],
                );

            ?>
                <tr class="text-center">
                  <td><?php echo  $i++; ?></td>
                  <td><?php echo $item['tenmonan'] ?></td>
                  <td><?php echo $item['tongSoLuong']; ?></td>
                 
                </tr>
            <?php }
            } ?>
          </tbody>

          <tfoot>
            <tr class="text-center">
              <td colspan="5"> <button type="button" class="btn btn-success" data-bs-target="#total" data-bs-toggle="modal">Xem thống kê</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>



    <?php

    $tongTK = array();

    $tongTK = array();

foreach ($Monan as $index => $monan) {
  $id_monan = $monan['id_monan'];
  $list_ngl = $p->getNguyenLieuofMonan($ngaylenmon, $id_monan);

  foreach ($list_ngl as $item) {
    $tongTK[] = array(
      'tennguyenlieu' => $item['tennguyenlieu'],
      'Tong' => $item['soluongsudung'] * $monan['soluong'],
      'donvitinh' => $item['donvitinh'] 
    );
  }
}

     


$sumByTenNguyenLieu = array();

foreach ($tongTK as $item) {
  $tenNguyenLieu = $item["tennguyenlieu"];
  $tong = $item["Tong"];
  
  // Check if 'donvitinh' key exists and is not null
  if (isset($item['donvitinh']) && !is_null($item['donvitinh'])) {
    $donvitinh = $item["donvitinh"];
  } else {
    // Assign a default value if 'donvitinh' is not present or is null
    $donvitinh = 'N/A';
  }

  if (isset($sumByTenNguyenLieu[$tenNguyenLieu])) {
    $sumByTenNguyenLieu[$tenNguyenLieu] += $tong;
  } else {
    $sumByTenNguyenLieu[$tenNguyenLieu] = $tong;
  }
}
    ?>

   <!-- modal Tổng kết -->
<div class="modal" id="total" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Thống kê nguyên liệu</h5>
        <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th>STT</th>
              <th>Tên nguyên liệu</th>
              <th>Tổng khối lượng</th>
              <th>Đơn vị tính</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($sumByTenNguyenLieu as $index => $item) { ?>
                <tr class="text-center">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $index; ?></td>
                    <td><?php echo number_format($item); ?><span></span></td>
                    <td>
                        <?php
                        // Kiểm tra nếu donvitinh là null thì hiển thị N/A
                        if (is_null($donvitinh)) {
                            echo 'N/A';
                        } else {
                            echo $donvitinh;
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


    <?php



    ?>
</main>
    </section>
</div>

<?php

?>

