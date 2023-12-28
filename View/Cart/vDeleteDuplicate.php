<?php
include_once("Controller/cCart.php");
$p = new controlCart();

function deleteDuplicateAndRedirect($p, $date) {
    $p->DeleteDuplicate();
    header("refresh: 0; url='index.php?mod=menus&date=$date'");
    exit;
}

// Bắt đầu xử lý
$date = isset($_GET['date']) ? $_GET['date'] : null;
if ($date) {
    deleteDuplicateAndRedirect($p, $date);
}
?>
