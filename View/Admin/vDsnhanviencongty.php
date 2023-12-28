<?php 
include_once('Controller/cQuanly.php');

$p = new controlQuanly();

$dsNVCty = $p->getselectNhanvienCongty();



?>


<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
    <h1>Danh sách nhân viên công ty</h1>
    <nav>
      <ol class="breadcrumb">

        <li class="breadcrumb-item">Nhân viên công ty</li>

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
                  <th >Mã nhân viên</th>
                  <th >Họ tên</th>
                  <th >Chức vụ</th>
                  <th >Email</th>
                  <th >Tác vụ</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                if (!empty($dsNVCty)) {
                  foreach ($dsNVCty as $item) { ?>
                    <tr>
                      <th ><?php echo  $i++ ?></th>
                      <td><?php echo $item['maNV'] ?></td>
                      <td><?php echo $item['hoten'] ?></td>
                      <td><?php echo $item['tenvaitro'] ?></td>
                      <td><?php echo $item['email'] ?></td>
                      <td><button class="btn btn-secondary"><a style="color: #fff;" href="admin.php?mod=DeleteUser&idtaikhoan=<?php echo $item['idtaikhoan'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa</a></button>
                        <button class="btn btn-secondary"><a href="admin.php?mod=UpdateUser&po=NVBep&idtaikhoan=<?php echo $item['idtaikhoan'] ?>" style="color: #fff;">Sửa</a></button>
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