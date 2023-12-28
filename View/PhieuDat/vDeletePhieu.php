<?php
include_once("Controller/cPhieudatmon.php");
$p = new controlPhieu();


$idPhieu = $_GET['idPhieu'];
$p-> deleteIdPhieu($idPhieu);


echo header("refresh: 0; url='index.php?mod=Order&act=dsphieu'");

