<?php

    include "connect.php";
    include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";

?>
<style>
    .tv{
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 0px;
    }
    .tv table{
        width: 100%;
        height: 100%;
        margin-left: 120px;
    }
    .tv table td{
        width: 30%;
        height: 100%;
        padding: 10px;
        float:left;
    }
    .tv table td img{
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }
    .tv table td h3{
        text-align: center;
        padding: 15px 0px;
    }
    h5{
        text-align: justify;
        font-style: italic;
    }
</style>
<section class="home-section" id="home">
		<div class="container">
			<div class="row" style="flex-wrap: nowrap;">
				
					<div style="padding: 100px 0px; color: white;">
						<h1 class="text-warning" >
							Công ty Vô Tri
						</h1>
                        <hr>
						<h5><li>
                            Bếp ăn công ty Vô tri là một không gian ấm cúng và thân thiện, nơi các nhân viên có thể thưởng 
                            thức những bữa ăn ngon miệng và bổ dưỡng. Bếp ăn được thiết kế với không gian rộng rãi, 
                            thoáng mát, có đầy đủ tiện nghi và trang thiết bị hiện đại. 
                            <br>  <br>
                            </li>
                            <li>
                            Thực đơn của bếp ăn được thay đổi hàng ngày, đảm bảo cung cấp đầy đủ dinh dưỡng cho các nhân viên. 
                            Các món ăn được chế biến từ nguyên liệu tươi ngon, đảm bảo an toàn vệ sinh thực phẩm.
                            <br>  <br>
                            </li>
                             <li>
                            Bếp ăn công ty Vô tri không chỉ là nơi để ăn uống mà còn là nơi để các nhân viên giao lưu, gặp gỡ, trò chuyện. Bếp ăn là một trong những yếu tố góp phần 
                            tạo nên văn hóa doanh nghiệp thân thiện và gắn kết tại Vô tri.
                            </li>
						</h5>
					</div>
				
			</div>
		</div>
	</section>
    <div>
        <h1 style="text-align: center; padding: 50px 0px;">Thành viên</h1>
    </div>
    <div class="tv">
        <table>
            <tr>
                <td>
                    <img src="Design/images/img_1.jpg" alt="">
                    <h3>ĐẶNG NGỌC HIẾU</h3>
                </td>
                <td>
                    <img src="Design/images/img_1.jpg" alt="">
                    <h3>BÙI THỤC ĐOAN</h3>
                </td>
                <td>
                    <img src="Design/images/img_1.jpg" alt="">
                    <h3>NGUYỄN THANH VŨ</h3>
                </td>
                <td>
                    <img src="Design/images/img_1.jpg" alt="">
                    <h3>DƯƠNG CÔNG HIẾU</h3>
                </td>
                <td>
                    <img src="Design/images/img_1.jpg" alt="">
                    <h3>NGUYỄN HOÀNG HƯNG</h3>
                </td>
                <td>
                    <img src="Design/images/img_1.jpg" alt="">
                    <h3>NGUYỄN MINH ÂN</h3>
                </td>
            
            </tr>
        </table>
    </div>
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
