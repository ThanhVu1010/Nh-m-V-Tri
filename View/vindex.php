
<?php

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
	<!-- HOME SECTION -->

	<section class="home-section" id="home" style="padding:100px 0px;">
		<div class="container">
			<div class="row" style="flex-wrap: nowrap;">
				<div class="col-md-6 home-left-section">
					<div style="padding: 100px 0px; color: white;">
						<h1>
							Công ty Vô Tri 
						</h1>
                        <hr>
						<h5>
							Hệ thống bếp ăn của công ty Vô Tri cam kết đem lại cho nhân viên công ty những bữa ăn chất lượng và đầy đủ dinh dưỡng
						</h5>
                        <hr>
						<div style="display: flex;">
							<a href="?mod=menus&act=list&date=<?php echo $ngay_mai ?>" class="bttn_style_2" style="display: flex;justify-content: center;align-items: center;">
								Xem Thực đơn
								<i class="fas fa-angle-right"></i><i class="fas fa-angle-right"></i>
							</a>
						</div>
					</div>
				</div>
               
			</div>
		</div>
	</section>

	<!-- OUR QUALITIES SECTION -->

	<section class="our_qualities" style="padding:100px 0px;">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="./Design/images/quality_food_img.png" >
	                    <div class="caption">
	                        <h3>
	                            Thực đơn buổi sáng 
	                        </h3>
	                        <p>
							"Thực đơn sáng tạo, đánh thức vị giác và năng lượng!"
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="./Design/images/fast_delivery_img.png" >
	                    <div class="caption">
	                        <h3>
	                            Thực đơn buổi trưa
	                        </h3>
	                        <p>
							"Trải nghiệm hương vị tuyệt vời tại buổi trưa với chúng tôi!"
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="./Design/images/original_taste_img.png" >
	                    <div class="caption">
	                        <h3>
	                            Thực đơn buổi chiều
	                        </h3>
	                        <p>
							"Thực đơn đa dạng, hấp dẫn cho mọi khẩu vị vào buổi chiều!"
	                        </p>
	                    </div>
	                </div>
				</div>

			</div>
		</div>
	</section>

	<!-- OUR MENUS SECTION -->

	<section class="our_menus" id="menus">
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">KHÁM PHÁ MENU CỦA CHÚNG TÔI</h2>
			<div class="menus_tabs">
				<div class="menus_tabs_picker">
					<ul style="text-align: center;margin-bottom: 70px">
						<?php

	                        $stmt = $con->prepare("Select * from loaimonan");
	                        $stmt->execute();
	                        $rows = $stmt->fetchAll();
	                        $count = $stmt->rowCount();

	                        $x = 0;

							foreach ($rows as $row) {
								if ($x == 0) {
									echo "<li class = 'menu_category_name tab_category_links active_category' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['tenloaimonan'])."')>";
									echo $row['tenloaimonan'];
									echo "</li>";
								} else {
									echo "<li class = 'menu_category_name tab_category_links' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['tenloaimonan'])."')>";
									echo $row['tenloaimonan'];
									echo "</li>";
								}
							
								$x++;
							}
							
						?>
					</ul>
				</div>

				<div class="menus_tab">
					<?php
                
                        $stmt = $con->prepare("Select * from loaimonan");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        $count = $stmt->rowCount();

                        $i = 0;

                        foreach($rows as $row) 
                        {

                            if($i == 0)
                            {

                                echo '<div class="menu_item  tab_category_content" id="'.str_replace(' ', '', $row['tenloaimonan']).'" style=display:block>';

                                    $stmt_menus = $con->prepare("Select * from monan where id_loaimonan = ?");
                                    $stmt_menus->execute(array($row['id_loaimonan']) );
                                    $rows_menus = $stmt_menus->fetchAll();

                                    if($stmt_menus->rowCount() == 0)
                                    {
                                        echo "<div style='margin:auto'>không có món ăn nào trong thực đơn!</div>";
                                    }

                                    echo "<div class='row'>";
	                                    foreach($rows_menus as $menu)
	                                    {
	                                        ?>

	                                            <div class="col-md-4 col-lg-3 menu-column">
													<a href="?act=menus">
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                    <?php $source = "Design/image/".$menu['hinhanh']; ?>

	                                                    <div class="menu-image">
													        <div class="image-preview">
													            <div style="background-image: url('<?php echo $source; ?>');"></div>
													        </div>
													    </div>
													</a>                                                    
	                                                    <div class="caption">
	                                                        <h3>
	                                                            <?php echo $menu['tenmonan'];?>
	                                                        </h3>

	                                                        <span class="menu_price text-warning" >
	                                                        	<?php echo number_format($menu['gia'], 0, ',', '.') . " VND"; ?>
	                                                        </span>
                                                           
	                                                    </div>
														
													</div>
	                                            </div>

	                                        <?php
	                                    }
	                                echo "</div>";

                                echo '</div>';

                            }

                            else
                            {

                                echo '<div class="menus_categories  tab_category_content" id="'.str_replace(' ', '', $row['tenloaimonan']).'">';

                                    $stmt_menus = $con->prepare("Select * from monan where id_loaimonan = ? ");
                                    $stmt_menus->execute(array($row['id_loaimonan']) );
                                    $rows_menus = $stmt_menus->fetchAll();

                                    if($stmt_menus->rowCount() == 0)
                                    {
                                        echo "<div style='margin:auto'>không có món ăn nào trong thực đơn!</div>";
                                    }

                                    echo "<div class='row'>";
	                                    foreach($rows_menus as $menu)
	                                    {
	                                        ?>

	                                            <div class="col-md-4 col-lg-3 menu-column">
												<a href="?act=menus">
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                	<?php $source = "Design/image/".$menu['hinhanh']; ?>
	                                                    <div class="menu-image">
													        <div class="image-preview">
													            <div style="background-image: url('<?php echo $source; ?>');"></div>
													        </div>
													    </div>
														</a> 
	                                                    <div class="caption">
	                                                       <h3>
	                                                            <?php echo $menu['tenmonan'];?>
	                                                        </h3>
	                                                       <span class="menu_price text-warning" >
	                                                        	<?php echo number_format($menu['gia'], 0, ',', '.') . " VND"; ?>
	                                                        </span>
                                                           
	                                                    </div>
	                                                </div>
	                                            </div>

	                                        <?php
	                                    }
	                               	echo "</div>";

                                echo '</div>';

                            }

                            $i++;
                            
                        }
                    
                        echo "</div>";
                
                    ?>
				</div>
			</div>
		</div>
          <a href="?mod=menus&act=list&date=<?php echo $ngay_mai ?>" style="color: black;">
            <button class="btn btn-primary btn-icon" style="margin-left: 700px ;background-color: #F3D302">
              <img src="./Design/images/menu.svg" alt="menu icon">
              Xem thêm
            </button>
          </a>
	</section>



	<!-- CONTACT US SECTION -->

	<section class="contact-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 sm-padding">
                    <div class="contact-info">
                        <h2>
						Hãy liên lạc với chúng tôi và
							<br>gửi tin nhắn cho chúng tôi ngay hôm nay!
                        </h2>
                        <p>
						"Chúng tôi thành lập công ty này không chỉ để kiếm tiền,
						 <br> mà còn để tạo ra những sản phẩm và dịch vụ tốt nhất cho cộng đồng."
                        </p>
                        <h3>
                            Số 4, Nguyễn Văn Bảo, Phường 4, Gò Vấp
                        </h3>
                        <h4>
                            <span>Email:</span> 
                            <p>tapdoanvotri6789@gmail.com</p>
                            <br> 
                            <span>Số điện thoại:</span> 
                            <p>0123467899</p>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6 sm-padding">

				<b>ĐỀ XUẤT</b>
                    <div class="contact-form">
					
                        <div id="contact_ajax_form" class="contactForm">
							
                            <div class="form-group colum-row row">
                                <div class="col-sm-6">
                                    <input type="text" id="contact_name" name="name" oninput="document.getElementById('invalid-name').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Họ&Tên">
                                    <div class="invalid-feedback" id="invalid-name" style="display: block">
                                    	
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" id="contact_email" name="email" oninput="document.getElementById('invalid-email').innerHTML = ''" class="form-control" placeholder="Email">
                                    <div class="invalid-feedback" id="invalid-email" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="contact_message" name="Nội dung" oninput="document.getElementById('invalid-message').innerHTML = ''" cols="30" rows="5" class="form-control message" placeholder="Nội dung"></textarea>
                                    <div class="invalid-feedback" id="invalid-message" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button id="contact_send" class="bttn_style_2">Gửi tin nhắn </button>
                                </div>
                            </div>
                            <div id="sending_load" style="display: none;">Đang gửi...</div>
                            <div id="contact_status_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	
	<!-- WIDGET SECTION / FOOTER -->

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

    <!-- FOOTER BOTTOM  -->

    

		<script src="../Design/js/jquery.min.js"></script>
		<script src="../Design/js/bootstrap.min.js"></script>
		<script src="../Design/js/bootstrap.bundle.min.js"></script>
		<script src="../Design/js/main.js"></script>