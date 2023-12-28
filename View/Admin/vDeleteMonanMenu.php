<?php

include_once("Controller/cMenu.php");


$menu = new controlMenu();

$id_monan = $_GET['id_monan'];
$idthucdon = $_GET['idthucdon'];


$kq = $menu->DeletedMonAnByidAndByThucDon($id_monan, $idthucdon);
echo '<script>alert("xóa món khỏi menu thành công")</script>';

echo header("refresh: 0; url='admin.php?mod=listMenu'");
?>