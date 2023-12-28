<?php

include_once("Controller/cMonan.php");


$menu = new controlMonan();

$id_monan = $_GET['id_monan'];



$kq = $menu->DeletedMonAnByidAndByThucDon($id_monan);

echo '<script>alert("xóa món khỏi menu thành công")</script>';

echo header("refresh: 0; url='admin.php?mod=DSMonAn'");
?>