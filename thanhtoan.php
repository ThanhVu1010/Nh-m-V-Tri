<?php

    include "connect.php";
    include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .payment-selection {
    font-family: 'Arial', sans-serif;
    width: 80%;
    margin: 20px auto;
    border: 1px solid #ccc;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.payment-method {
    display: flex;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.payment-method:last-child {
    border-bottom: none;
}

.payment-method img {
    width: 50px;
    height: auto;
    margin-right: 20px;
}

.payment-method span.dropdown {
    margin-left: auto;
    font-size: 1.2em;
}

button {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #f5f5f5;
    cursor: pointer;
}

        </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
        </head>
<body>
    <div class="payment-selection">
        <h2>Chọn Phương thức thanh toán</h2>
        <div class="payment-method">
            <a href="thanhtoanbangATM.php"><img src="Design/images/Atmcard.png" alt="ATM Card">
            <span>Thẻ ATM và tài khoản ngân hàng</span></a>
        </div>
        <div class="payment-method">
            <a href="https://momo.vn/"><img src="Design/images/Vimomo.png"  alt="Vinpay">
            <span>Ví điện tử</span></a>
        </div>
        <button id="btnQuayLai">QUAY LẠI</button>
    </div>
    
</body>
</html>
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
 </section>		
		<footer class="footer_section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 xs-padding">
						<div class="copyright">
							© 
							<script type="text/javascript"> 
								document.write(new Date().getFullYear())
							</script>
							Vincent Restaurant Powered by JAIRI Idriss
						</div>
					</div>
					<div class="col-md-6 xs-padding">
						<ul class="footer_social">
							<li><a href="#">Orders</a></li>
							<li><a href="#">Terms</a></li>
							<li><a href="#">Report Problem</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>

	
		<!-- INCLUDE JS SCRIPTS -->

		<script src="Design/js/jquery.min.js"></script>
		<script src="Design/js/bootstrap.min.js"></script>
		<script src="Design/js/bootstrap.bundle.min.js"></script>
		<script src="Design/js/main.js"></script>

	</body>

	<!-- END BODY TAG -->

</html>

<!-- END HTML TAG -->
