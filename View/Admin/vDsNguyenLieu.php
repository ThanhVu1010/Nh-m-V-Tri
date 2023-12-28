<?php
include_once("Controller/cMonan.php");


$p = new controlMonan();

$list =  $p->getNguyenLieu();


?>


<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
    <h1>Danh sách món ăn</h1>
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
                    <th scope="col">STT</th>
                    <th scope="col">Tên nguyên liệu</th>
                    <th scope="col">Tác vụ</th>
                  </tr>
                </thead>
                <tbody>
                <?php  
                $i =1;
                foreach($list as $item) { ?>
                  <tr>
                    <th scope="row"><?php echo  $i++ ?></th>
                    <td><?php echo $item['tennguyenlieu'] ?></td>
                    
                    <td><button class="btn btn-secondary"><a href="admin.php?mod=DeleteNguyenLieu&idnguyenlieu=<?php echo$item['idnguyenlieu'] ?>" class="text-light" onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa</a></button></td>
             

                  </tr>
                <?php } ?>
                  
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
