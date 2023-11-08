
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web bán thức ăn </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="chitietmon.css">
<style>
    #wp-products {
    width: 100%;
    margin: 50px;

  }
  
  #products {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  
  
  .chitiet img {
    object-fit: cover;
    width: 600px;
    height: 400px;
  }
  
  .chitiet1 {
    width: 500px;
    height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 20px;
  }
  
  .stars {
    display: flex;
  }
  
  .name {
    font-size: 30px;
    font-weight: bold;
  }
  
  .desc {
    font-size: 20px;
  }
  
  .price {
    font-size: 50px;
    color: red;
  }
  
  .order {
    background-color: blue;
    font-size: 30px;
    color: white;
    padding: 15px;
    text-align: center;
    margin-top: 20px;
    border-radius: 10px;
  }
  .order a{
    text-decoration: none;
    color: white;
    text-transform: uppercase;
  }
  #danhgia{
    width: 200px;
    height: 50px;
    background-color: #5cb9eb;
    margin-top: 40px;
    text-align: center;
    padding-top: 10px;
    border-radius: 10px;
  }
  #danhgia a{
    text-decoration: none;
    color: rgb(219, 40, 40);
    text-transform: uppercase;
  }
</style>
</head>
<?php
     include 'Includes/functions/functions.php';
     include "Includes/templates/header.php";
     include "Includes/templates/navbar.php";
?>
<body>
    <div id="wp-products">
        <h2>CHI TIẾT MÓN ĂN </h2>
        
        <div id="products">
            <div class="chitiet">
                <img src="Design/images/img_1.jpg" alt="">
            </div>
            <div class="chitiet1">
                <div class="stars">
                    
                    <span>
                        <img src="Design/images/star.png" alt="">
                    </span>
                    <span>
                        <img src="Design/images/star.png" alt="">
                    </span>
                    <span>
                        <img src="Design/images/star.png" alt="">
                    </span>
                    <span>
                        <img src="Design/images/star.png" alt="">
                    </span>
                    <span>
                        <img src="Design/images/star.png" alt="">
                    </span>
                </div>

                <div class="name">Món Ăn 1</div>
                <div class="desc">Mô Tả Ngắn Cho Sản Phẩm</div>
                <div class="price">50.000 VNĐ</div>
                <div class="order"><a href="datmon.html">Đặt món</a></div>
            </div>

        </div>
        <div id="danhgia">
            <div class="item">
                <div><a href="danhgiamonan.html">Đánh giá món ăn</a></div>
            </div>
        </div>
    </div>
    
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

    <?php include "Includes/templates/footer.php"; ?>
</html>
