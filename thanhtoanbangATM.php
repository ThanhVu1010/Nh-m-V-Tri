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
    <link rel="stylesheet" href="ttatm.css">
    <style>
        .payment-container {
    font-family: 'Times New Roman', Times, serif;
    width: 80%;
    max-width: 800px;
    margin: 50px auto;
    border: 1px solid #e1e1e1;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.payment-container h2 {
    font-size: 20px;
    margin-bottom: 20px;
}

.payment-container input[type="text"], .payment-container textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #e1e1e1;
    border-radius: 5px;
    font-size: 16px;
}

.banks {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.banks div {
    width: 23%; /* Điều chỉnh để có khoảng trắng giữa các khối */
    height: 80px;
    background-color: #f1f1f1; 
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.banks div:hover {
    background-color: #e1e1e1;
}

.bank-details label {
    display: block;
    font-weight: bold;
    margin-top: 10px;
}

button {
    padding: 10px 15px;
    margin: 10px 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #e1e1e1;
}

img{
    width: 100%;
  height: 80%;
}
        </style>
</head>
<body>
    <div class="payment-container">
        <h2>Thanh toán bằng thẻ ngân hàng ATM :</h2>
        <input type="text" placeholder="Tìm kiếm ngân hàng" readonly>
    
        <div class="banks">
            <div>
                <img src="Design/images/BIDV.png" alt="">
            </div>
            <div>
                <img src="Design/images/MB.png" alt="">
            </div>
            <div>
                <img src="Design/images/tech.jpg" alt="">
            </div>
            <div>
                <img src="Design/images/vpb.png" alt="">
            </div>
        </div>
    
        <div class="bank-details">
            <label>Tên ngân hàng:</label>
            <input type="text" value="" readonly>
    
            <label>Số tài khoản:</label>
            <input type="text">
    
            <label>Tên chủ tài khoản:</label>
            <input type="text" value="" readonly>
    
            <label>Số tiền:</label>
            <input type="text" value="" readonly>
    
            <label>Mô tả giao dịch:</label>
            <textarea ></textarea>
    <br>
            <button>Thanh Toán</button>
            <a href="thanhtoan.html"><button>Huỷ</button></a>
        </div>
    </div>
    
</body>
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

		<!-- INCLUDE JS SCRIPTS -->

		<script src="Design/js/jquery.min.js"></script>
		<script src="Design/js/bootstrap.min.js"></script>
		<script src="Design/js/bootstrap.bundle.min.js"></script>
		<script src="Design/js/main.js"></script>

	</body>

	<!-- END BODY TAG -->

</html>