<?php
include_once("Controller/cCart.php");
$p = new controlCart();


$idgiohang = $_GET['idgiohang'];
$p-> DeleteGioHang($idgiohang);


echo header("refresh: 0; url='index.php?mod=cart'");

