<?php
include_once("Controller/cQuanly.php");
$p = new controlQuanly();


$idtaikhoan = $_GET['idtaikhoan'];
$p-> DeleteUser($idtaikhoan);

$mod = isset($_GET['po']) && $_GET['po'] == 'NVBep' ? 'NhanVienBep' : 'NhanVienCongTy';
echo header("refresh:0; url='admin.php?mod=$mod'");



?>

