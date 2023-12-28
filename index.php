<?php
session_start();
ob_start();

if (isset($_GET['mod'])) {
    switch ($_GET['mod']) {
        case 'login':
            include_once('View/vlogin.php');
            break;
        case 'logout':
            include_once('View/vlogout.php');
            break;
        case 'menus':
            include_once('View/vMonan.php');
            break;
        case 'cart':
            if (!isset($_GET['act'])) {
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/Cart/vCart.php');
                include_once("Includes/templates/footer.php");
            }elseif($_GET['act'] == 'Add'){
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/cart/vAddcart.php');
                
            }elseif($_GET['act'] == 'Update'){
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/Cart/vUpdatecart.php');
                include_once("Includes/templates/footer.php");
			}
            elseif($_GET['act'] == 'DeleteDuplicate'){
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/Cart/vDeleteDuplicate.php');
                include_once("Includes/templates/footer.php");
			}
            elseif($_GET['act'] == 'DeleteMonan'){
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/Cart/vDeleteMonan.php');
                include_once("Includes/templates/footer.php");
			}
            elseif($_GET['act'] == 'DeleteGioHang'){
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/Cart/vDeleteGioHang.php');
                include_once("Includes/templates/footer.php");
			}
            break;  
        case 'Order':
            if (!isset($_GET['act'])) {
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/Cart/vCart.php');
                include_once("Includes/templates/footer.php");
            }elseif($_GET['act'] == 'OrderDate'){
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/PhieuDat/vAddChitietphieu.php');
                include_once("Includes/templates/footer.php");
            }elseif($_GET['act'] == 'AddPhieu'){
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/PhieuDat/vAddPhieudat.php');
                include_once("Includes/templates/footer.php");
			}elseif($_GET['act'] == 'dsphieu'){
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/PhieuDat/vPhieudat.php');
                include_once("Includes/templates/footer.php");
			}elseif($_GET['act'] == 'DeletePhieu'){
                include_once('View/PhieuDat/vDeletePhieu.php');
			}elseif($_GET['act'] == 'ThanhToan'){
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include_once('View/Thanhtoan/TrangThanhToan.php');

			}elseif($_GET['act'] == 'CongThanhToanMoMo_QR'){

                include_once('View/Thanhtoan/CongThanhToanMoMo.php');
			}elseif($_GET['act'] == 'CongThanhToanMoMo_ATM'){

                include_once('View/Thanhtoan/CongThanhToanMoMo_ATM.php');
			}
            break;    
            
        case 'introduce':
            include_once('gioithieu.php');
            break;
        case 'Profile':
            include 'Includes/functions/functions.php';
            include "Includes/templates/header.php";
            include "Includes/templates/navbar.php";
            include_once('View/Admin/vHoso.php');
       
            break;
        
        case 'chitiet':
            if (isset($_GET['id_monan'])) {
                include 'Includes/functions/functions.php';
                include "Includes/templates/header.php";
                include "Includes/templates/navbar.php";
                include_once('View/vChitietmonan.php');
                include_once("Includes/templates/footer.php");
            } else {
                echo "Không có ID món ăn được cung cấp.";
            }
            break;
        default:
            include "connect.php";
            include 'Includes/functions/functions.php';
            include "Includes/templates/header.php";
            include "Includes/templates/navbar.php";
            include_once("View/vindex.php");
            include_once("Includes/templates/footer.php");
            break;
    }
} else {
    include "connect.php";
    include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";
    include_once("View/vindex.php");
    include_once("Includes/templates/footer.php");
}
?>
