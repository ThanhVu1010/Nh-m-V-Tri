<?php
include_once("Controller/cCart.php");
$p = new controlCart();


$id_monan = $_GET['id_monan'];
$p->DeleteCartMonan($id_monan);


echo header("refresh: 0; url='index.php?mod=cart'");

