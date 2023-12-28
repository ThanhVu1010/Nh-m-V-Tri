<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
ob_start();

// Set page title
$pageTitle = 'Admin';

if (isset($_SESSION['login'])) {
    $role = $_SESSION['is_login']['vaitro'];

    // Check if 'mod' is set
    if (isset($_GET['mod'])) {
        $mod = $_GET['mod'];

        switch ($role) {
            case 1:
                // Admin
                switch ($mod) {
                    case 'NhanVienBep':
                        include 'Includes/functions/functions.php';
                        include 'Includes/templates/adminHeader.php';
                        include 'Includes/templates/adminNavbar.php';
                        include "View/Admin/vDsnhanvienbep.php";
                        include 'Includes/templates/adminFooter.php';
                        break;

                    case 'NhanVienCongTy':
                        include 'Includes/functions/functions.php';
                        include 'Includes/templates/adminHeader.php';
                        include 'Includes/templates/adminNavbar.php';
                        include "View/Admin/vDsnhanviencongty.php";
                        include 'Includes/templates/adminFooter.php';
                        break;
                    case 'DeleteUser':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vDeleteUser.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'addUser':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vAddUser.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'UpdateUser':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vUpdateUser.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'listMenu':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vLichDatMon.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'DeleteMonan':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vDeleteMonanMenu.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'DSMonAn':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vDsMonAn.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'DeleteMon':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vDeleteMon.php";
                            include 'Includes/templates/adminFooter.php';
                            break;

                    case 'UpdateMonAn':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vUpdateMonAn.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'addMonan':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vAddMonAn.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'addMenu':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vAddMenu.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'Nguyenlieu':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vDsNLCan.php";
                            include 'Includes/templates/adminFooter.php';
                            break;    
                            
                    case 'DsNguyenLieu':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vDsNguyenLieu.php";
                            include 'Includes/templates/adminFooter.php';
                            break;    
                    case 'addNguyenLieu':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vAddNguyenLieu.php";
                            include 'Includes/templates/adminFooter.php';
                            break;            
                     case 'DSPhieu':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vDsPhieu.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'DuyetPhieu':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vDuyetPhieu.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                    case 'XacNhanPhieu':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vXacNhanPhieu.php";
                            include 'Includes/templates/adminFooter.php';
                            break;             
                    case 'XacNhanThanhToan':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vThanhToan.php";
                            include 'Includes/templates/adminFooter.php';
                            break;                      
                default:
                        include 'Includes/functions/functions.php';
                        include 'Includes/templates/adminHeader.php';
                        include 'Includes/templates/adminNavbar.php';
                        include 'View/Admin/vAdmin.php';
                        include 'Includes/templates/adminFooter.php';
                        break;
                }
                break;

            case 2: 
                switch ($mod) {
                        case 'DSPhieu':
                                include 'Includes/functions/functions.php';
                                include 'Includes/templates/adminHeader.php';
                                include 'Includes/templates/adminNavbar.php';
                                include "View/Admin/vDsPhieu.php";
                                include 'Includes/templates/adminFooter.php';
                                break;
                        case 'DuyetPhieu':
                                include 'Includes/functions/functions.php';
                                include 'Includes/templates/adminHeader.php';
                                include 'Includes/templates/adminNavbar.php';
                                include "View/Admin/vDuyetPhieu.php";
                                include 'Includes/templates/adminFooter.php';
                                break;
                        case 'XacNhanPhieu':
                                include 'Includes/functions/functions.php';
                                include 'Includes/templates/adminHeader.php';
                                include 'Includes/templates/adminNavbar.php';
                                include "View/Admin/vXacNhanPhieu.php";
                                include 'Includes/templates/adminFooter.php';
                                break;             
                        case 'XacNhanThanhToan':
                                include 'Includes/functions/functions.php';
                                include 'Includes/templates/adminHeader.php';
                                include 'Includes/templates/adminNavbar.php';
                                include "View/Admin/vThanhToan.php";
                                include 'Includes/templates/adminFooter.php';
                                break;   
                        case 'listMenu':
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include "View/Admin/vLichDatMon.php";
                            include 'Includes/templates/adminFooter.php';
                            break;
                            default:
                            include 'Includes/functions/functions.php';
                            include 'Includes/templates/adminHeader.php';
                            include 'Includes/templates/adminNavbar.php';
                            include 'View/Admin/vAdmin.php';
                            include 'Includes/templates/adminFooter.php';
                            break;
                    }
                    break;
                        

            default:
                // Default case
                include 'Includes/functions/functions.php';
                include 'Includes/templates/adminHeader.php';
                include 'Includes/templates/adminNavbar.php';
                include 'View/Admin/vAdmin.php';
                include 'Includes/templates/adminFooter.php';
                break;
        }
    }else{
        include 'Includes/functions/functions.php';
        include 'Includes/templates/adminHeader.php';
        include 'Includes/templates/adminNavbar.php';
        include 'View/Admin/vAdmin.php';
        include 'Includes/templates/adminFooter.php';
    }
}
?>
