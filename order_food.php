<!-- PHP INCLUDES -->

<?php
    //Set page title
    $pageTitle = 'Order Food';

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

    <!-- START ORDER FOOD SECTION -->

	<section class="order_food_section">

        


			<!-- SELECT MENUS -->

			<div class="select_menus_tab order_food_tab" id="menus_tab">

				<!-- ALERT MESSAGE -->

				<div class="alert alert-danger" role="alert" style="display: none">
					Bạn chưa chọn món ăn!!!!
				</div>

                <div class="text_header">
                    <span>
                        1. Hãy chọn món ăn bạn muốn!!!
                    </span>
                </div>

				<div>
					<?php
						$stmt = $con->prepare("Select * from loai_thucdon");
                    	$stmt->execute();
                    	$menu_categories = $stmt->fetchAll();


                    	foreach($menu_categories as $category)
                    	{
                    		?>
                    			<div class="text_header">
									<span>
										<?php echo $category['tenthucdon']; ?>
									</span>
								</div>
								<div class="items_tab">
				        			<?php
				        				$stmt = $con->prepare("Select * from monan where idloaithucdon = ?");
				                    	$stmt->execute(array($category['idloaithucdon']));
				                    	$rows = $stmt->fetchAll();

				                    	foreach($rows as $row)
				                    	{
				                        	echo "<div class='itemListElement'>";
				                            	echo "<div class = 'item_details'>";
				                                	echo "<div>";
				                                    	 echo ("<img src='Design/image/".$row["hinhanh"]."' width='100px' height=100px/><br>"); 
														echo "<div>";
															echo "<br><h5><b>" . $row['tenmonan'] . "</b></h5>";
														echo "</div>";

				                                	echo "</div>";
													
													echo "<div class='item_description'>";
				                                    	echo $row['mota'];
				                                	echo "</div>";
				                                	echo "<div class = 'item_select_part'>";
				                                    	echo "<div class = 'menu_price_field'>";
				    										echo "<span style = 'font-weight: bold;'>";
				                                    			echo number_format($row['gia'], 0, ',', '.') . " VND"; 
				                                    		echo "</span>";
				                                    	echo "</div>";
				                                    ?>
				                                    	<div class="select_item_bttn">
				                                    		<div class="btn-group-toggle" data-toggle="buttons">
																<label class="menu_label item_label btn btn-secondary">
																	<input type="checkbox"  name="selected_menus[]" value="<?php echo $row['idthucdon'] ?>" autocomplete="off">Đặt món
																</label>
															</div>
				                                    	</div>
				                                    <?php
				                                	echo "</div>";
				                            	echo "</div>";
				                        	echo "</div>";
				                    	}
				            		?>
				    			</div>
                    		<?php
                    	}
					?>
				</div>				
			</div>


            <!-- CLIENT DETAILS -->


            <div class="client_details_tab order_food_tab" id="clients_tab">

                <div class="text_header">
                    <span>
                        2. Client Details
                    </span>
                </div>

                <div>
                    <div class="form-group colum-row row">
                        <div class="col-sm-12">
                            <input type="text" name="client_full_name" id="client_full_name" oninput="document.getElementById('required_fname').style.display = 'none'" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Full name">
                            <div class="invalid-feedback" id="required_fname">
                                Invalid Name!
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="email" name="client_email" id="client_email" oninput="document.getElementById('required_email').style.display = 'none'" class="form-control" placeholder="E-mail">
                            <div class="invalid-feedback" id="required_email">
                                Invalid E-mail!
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <input type="text"  name="client_phone_number" id="client_phone_number" oninput="document.getElementById('required_phone').style.display = 'none'" class="form-control" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Phone number">
                            <div class="invalid-feedback" id="required_phone">
                                Invalid Phone number!
                            </div>
                        </div>
                    </div>
                    <div class="form-group colum-row row">
                        <div class="col-sm-12">
                            <input type="text" name="client_delivery_address" id="client_delivery_address" oninput="document.getElementById('required_delivery_address').style.display = 'none'" class="form-control" placeholder="Delivery Address">
                            <div class="invalid-feedback" id="required_delivery_address">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NEXT AND PREVIOUS BUTTONS -->

            <div style="overflow:auto;padding: 30px;">
                <div style="float:right;">
                    <input type="hidden" name="submit_order_food_form">
                    <button type="button" class="next_prev_buttons" style="background-color: #bbbbbb;"  id="prevBtn"  onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" class="next_prev_buttons" onclick="nextPrev(1)">Next</button>
                </div>
            </div>

            <!-- Circles which indicates the steps of the form: -->

            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
            </div>

		</form>
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


    <!-- JS SCRIPTS -->

    <script type="text/javascript">

        /* chọn nhiều món */

        $('.menu_label').click(function() 
        {
            $(this).button('toggle');
            
        });

    </script>

    <!-- JS SCRIPT FOR NEXT AND BACK TABS -->

    <script type="text/javascript">
        
        var currentTab = 0;
        showTab(currentTab);

        //Show Tab Function

        function showTab(n) 
        {
            var x = document.getElementsByClassName("order_food_tab");
            x[n].style.display = "block";
            
            if (n == 0) 
            {
                document.getElementById("prevBtn").style.display = "none";
            } 
            else 
            {
                document.getElementById("prevBtn").style.display = "inline";
            }
            
            if (n == (x.length - 1)) 
            {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } 
            else 
            {
                document.getElementById("nextBtn").innerHTML = "Next";
            }

            fixStepIndicator(n)
        }

        // Next Prev Function

        function nextPrev(n) 
        {
            var x = document.getElementsByClassName("order_food_tab");
            
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) 
            {
                // ... the form gets submitted:
                document.getElementById("order_food_form").submit();
                return false;
            }

            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        // Validate Form Function

        function validateForm()
        {
            var x, id_tab, valid = true;
            x = document.getElementsByClassName("order_food_tab");
            id_tab = x[currentTab].id;

            if(id_tab == "menus_tab")
            {
                if(x[currentTab].querySelectorAll('input[type="checkbox"]:checked').length == 0)
                {
                    x[currentTab].getElementsByClassName("alert")[0].style.display = "block";
                    valid = false;
                }
                else
                {
                    x[currentTab].getElementsByClassName("alert")[0].style.display = "none";
                }
            }
            if(id_tab == "clients_tab")
            {
                y = x[currentTab].getElementsByTagName("input");
                z = x[currentTab].getElementsByClassName("invalid-feedback");

                for (var i = 0; i < y.length; i++) 
                {
                    if(y[i].value == "")
                    {
                        z[i].style.display = "block";
                        valid = false;
                    }
                    if(y[i].type == "email" && !ValidateEmail(y[i].value))
                    {
                        z[i].style.display = "block";
                        valid = false;
                    }
                }
            }

            if (valid) 
            {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }

            return valid;
        }



        function fixStepIndicator(n) 
        {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            
            for (i = 0; i < x.length; i++) 
            {
                x[i].className = x[i].className.replace(" active", "");
            }
            
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }

    
    </script>
