<!-- PHP INCLUDES -->

<?php
    //Set page title
    $pageTitle = 'Thực đơn';

    include "connect.php";
    include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";


?>

    <!-- ORDER FOOD PAGE STYLE -->

	<style type="text/css">
        body
        {
            background: #f7f7f7;
        }

		.text_header
		{
			margin-bottom: 5px;
    		font-size: 18px;
    		font-weight: bold;
    		line-height: 1.5;
    		margin-top: 22px;
    		text-transform: capitalize;
		}

        .items_tab
        {
            border-radius: 4px;
            background-color: white;
            overflow: hidden;
            box-shadow: 0 0 5px 0 rgba(60, 66, 87, 0.04), 0 0 10px 0 rgba(0, 0, 0, 0.04);
        }

        .itemListElement
        {
            font-size: 14px;
            line-height: 1.29;
            border-bottom: solid 1px #e5e5e5;
            cursor: pointer;
            padding: 16px 12px 18px 12px;
        }

        .item_details
        {
            width: auto;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -webkit-flex-direction: row;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -webkit-box-align: center;
            -webkit-align-items: center;
        }

        .item_label
        {
        	color: #9e8a78;
            border-color: #9e8a78;
            background: white;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active 
        {
            color: #fff;
            background-color: #9e8a78;
            border-color: #9e8a78;
        }

        .item_select_part
        {
            display: flex;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
            flex-shrink: 0;
        }

        .select_item_bttn
        {
            width: 55px;
            display: flex;
            margin-left: 30px;
            -webkit-box-pack: end;
            justify-content: flex-end;
        }

        .menu_price_field
        {
        	width: auto;
            display: flex;
            margin-left: 30px;
            -webkit-box-align: baseline;
            align-items: baseline;
        }

        .order_food_section
        {
            max-width: 720px;
            margin: 50px auto;
            padding: 0px 15px;
        }

        .item_label.focus,
        .item_label:focus
        {
            outline: none;
            background:initial;
            box-shadow: none;
            color: #9e8a78;
            border-color: #9e8a78;
        }

        .item_label:hover
        {
            color: #fff;
            background-color: #9e8a78;
            border-color: #9e8a78;
        }

        /* Make circles that indicate the steps of the form: */
        .step 
        {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;  
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active 
        {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish 
        {
            background-color: #4CAF50;
        }


        .order_food_tab
        {
            display: none;
        }

        .next_prev_buttons
        {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            cursor: pointer;
        }

        .client_details_tab  .form-control
        {
            background-color: #fff;
            border-radius: 0;
            padding: 25px 10px;
            box-shadow: none;
            border: 2px solid #eee;
        }

        .client_details_tab  .form-control:focus 
        {
            border-color: #ffc851;
            box-shadow: none;
            outline: none;
        }
	

	</style>

<section class="our_menus" id="menus">
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">THỰC ĐƠN TRONG TUẦN</h2>
			<div class="menus_tabs">
				<div class="menus_tabs_picker">
					<ul style="text-align: center;margin-bottom: 70px">
						<?php

	                        $stmt = $con->prepare("Select * from loai_thucdon");
	                        $stmt->execute();
	                        $rows = $stmt->fetchAll();
	                        $count = $stmt->rowCount();

	                        $x = 0;

							foreach ($rows as $row) {
								if ($x == 0) {
									echo "<li class = 'menu_category_name tab_category_links active_category' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['tenloaithucdon'])."')>";
									echo $row['tenloaithucdon'];
									echo "</li>";
								} else {
									echo "<li class = 'menu_category_name tab_category_links' onclick=showCategoryMenus(event,'".str_replace(' ', '', $row['tenloaithucdon'])."')>";
									echo $row['tenloaithucdon'];
									echo "</li>";
								}
							
								$x++;
							}
						?>
					</ul>
				</div>

				<div class="menus_tab">
					<?php
                
                        $stmt = $con->prepare("Select * from loai_thucdon");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        $count = $stmt->rowCount();

                        $i = 0;

                        foreach($rows as $row) 
                        {

                            if($i == 0)
                            {

                                echo '<div class="menu_item  tab_category_content" id="'.str_replace(' ', '', $row['tenloaithucdon']).'" style=display:block>';

                                    $stmt_menus = $con->prepare("Select * from monan where idloaithucdon = ?");
                                    $stmt_menus->execute(array($row['idloaithucdon']) );
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
													<a href="chitietmonan.php">
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
	                                                        <p>
	                                                            <?php echo $menu['mota']; ?>
	                                                        </p>
	                                                        <span class="menu_price text-warning" >
	                                                        	<?php echo number_format($menu['gia'], 0, ',', '.') . " VND"; ?>
	                                                        </span>
                                                            <div class="buttondatmon">
																<label class="menu_label item_label btn btn-secondary ">
																	<input type="checkbox"  name="selected_menus[]" value="<?php echo $row['idthucdon'] ?>" autocomplete="off">Đặt món
																</label>
															</div>
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

                                echo '<div class="menus_categories  tab_category_content" id="'.str_replace(' ', '', $row['tenloaithucdon']).'">';

                                       $stmt_menus = $con->prepare("Select * from monan where idloaithucdon = ? ");
                                    $stmt_menus->execute(array($row['idloaithucdon']) );
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
	                                                <div class="thumbnail" style="cursor:pointer">
	                                                	<?php $source = "Design/image/".$menu['hinhanh']; ?>
	                                                    <div class="menu-image">
													        <div class="image-preview">
													            <div style="background-image: url('<?php echo $source; ?>');"></div>
													        </div>
													    </div>
	                                                    <div class="caption">
	                                                       <h3>
	                                                            <?php echo $menu['tenmonan'];?>
	                                                        </h3>
	                                                        <p>
	                                                            <?php echo $menu['mota']; ?>
	                                                        </p>
	                                                       <span class="menu_price text-warning" >
	                                                        	<?php echo number_format($menu['gia'], 0, ',', '.') . " VND"; ?>
	                                                        </span>
                                                            <div class="buttondatmon">
																<label class="menu_label item_label btn btn-secondary">
																	<input type="checkbox"  name="selected_menus[]" value="<?php echo $row['idthucdon'] ?>" autocomplete="off">Đặt món
																</label>
															</div>
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
        
	</section>
 



	<!-- WIDGET SECTION / FOOTER -->

     <section class="widget_section" style="background-color: #222227;padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                <img src="Design/images/Nhom_vo_tri_logos_white.png" alt="Restaurant Logo" style="width: 150px;margin-bottom: 20px;">
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

    <?php include "Includes/templates/footer.php"; ?>
