<?php 

include('Model/mMenu.php');

class controlMenu
{
    function getMenu(){
        $p = new modelMenu();
        $tbl = $p->SelectMenu();
        return  $tbl;
    }
    function getAllMenu(){
        $p = new modelMenu();
        $tbl = $p->SelectAllMenu();
        return  $tbl;
    }


    function getoneMenuByDate($ngaytao){
        $p = new modelMenu();
        $tbl = $p->SelectoneMenuByDate($ngaytao);
        return  $tbl;
    }
    function InsertMenu($ngaytao){
        $p = new modelMenu();
        $tbl = $p->InsertMenu($ngaytao);
        return  $tbl;
    }

    function InsertMenuDetails($idthucdon, $id_monan)
    {
        $p = new modelMenu();
        $tbl = $p->InsertMenuDetails($idthucdon, $id_monan);
        if ($tbl) {
            return 1;
        } else {
            return 0;
        }
    }

    function getMenuByDate($ngaytao){
        $p = new modelMenu();
        $tbl = $p->SelectMenuByDate($ngaytao);
        return  $tbl;
    }

    function DeletedMonAnByidAndByThucDon($id_monan, $idthucdon){
        $p = new modelMenu();
        $tbl = $p->DeletedMonAnByidAndByThucDon($id_monan, $idthucdon);
        return  $tbl;
    }
}
?>