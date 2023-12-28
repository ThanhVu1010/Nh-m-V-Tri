<?php 
include_once('Controller/cMonan.php');

$p = new controlMonan();

$dsMonan = $p->getDSMonan();



?>


<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 100px 0 0;">
    <h1>Danh sách món ăn </h1>
    <nav>
      <ol class="breadcrumb">

        <li class="breadcrumb-item">Món ăn</li>

      </ol>
    </nav>
  
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Quản lý</h5>

           

            <table id="example" class="table table-striped">
              <thead>
                <tr>
                <th >STT</th>
                  <th>Tên món</th>
                  <th >Giá</th>
                  <th >Hình ảnh</th>
                  <th >Loại Món Ăn</th>
                  <th >Tác vụ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                if (!empty($dsMonan)) {
                  foreach ($dsMonan as $item) { ?>
                    <tr>
                      <th ><?php echo  $i++ ?></th>
                      <td><?php echo $item['tenmonan'] ?></td>
                      <td><?php echo $item['gia'] ?></td>
                      <td><img style="width: 100px; height: 40px;" src="Design/image/<?php echo $item['hinhanh'] ?>" alt=""></td>
                      <td><?php echo $item['tenloaimonan'] ?></td>
                      <td><button class="btn btn-secondary"><a style="color: #fff;" href="admin.php?mod=DeleteMon&id_monan=<?php echo $item['id_monan'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa</a></button>
                        <button class="btn btn-secondary"><a href="admin.php?mod=UpdateMonAn&id_monan=<?php echo $item['id_monan'] ?>" style="color: #fff;">Sửa</a></button>
                      </td>
                    </tr>
                  <?php }
                } else {
                  ?>

              </tbody>
            </table>
            <h5 class="text-center  text-danger">Không có tài khoản nào !</h5>
          <?php } ?>

          </div>
        </div>

      </div>
    </div>
  </section>

</div>