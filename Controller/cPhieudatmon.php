<?php
    include("Model/mPhieudatmon.php");

    class controlPhieu{

    function getOrderDetail(){
        $p = new modelPhieu();
        $tbl = $p->SelectOrderDetail();
        return $tbl;
    }
    function getAllOrder(){
        $p = new modelPhieu();
        $tbl = $p->SelectOrder();
        return $tbl;
    }

    function getOrderNewCreateByIdTaiKhoan($idtaikhoan){
        $p = new modelPhieu();
        $tbl = $p->SelectOrderNewCreateByIdTaiKhoan($idtaikhoan);
        return $tbl;
        
    }
    function  XacNhanPhieu($trangthai, $ngaylenmon){
        $p = new modelPhieu();
        $tbl = $p-> XacNhanPhieu($trangthai, $ngaylenmon);
        return $tbl;
        
    }
   
    function DuyetPhieu($approve, $ngaylenmon){
        $p = new modelPhieu();
        $tbl = $p->DuyetPhieu($approve, $ngaylenmon);
        return $tbl;
        
    }

    function ThanhToanPhieu($thanhtoan, $ngaylenmon){
        $p = new modelPhieu();
        $tbl = $p->ThanhToanPhieu($thanhtoan, $ngaylenmon);
        return $tbl;
        
    }

    
    function getOrderByNgayLenMon($ngaylenmon){
        $p = new modelPhieu();
        $tbl = $p->SelectOrderByNgayLenMon($ngaylenmon);
        return $tbl;
        
    }

    
    function getSumbyidtaikhoan($idtaikhoan){
        $p = new modelPhieu();
        $tbl = $p->selectSumbyidtaikhoan($idtaikhoan);
        return $tbl;
    }

    function getPhieuByidTaiKhoan($idtaikhoan){
        $p = new modelPhieu();
        $tbl = $p->selectPhieuByidTaiKhoan($idtaikhoan);
        return  $tbl;
    }

    function getPhieuByidTaiKhoanFind($idtaikhoan, $trangthai, $duyetdon){
        $p = new modelPhieu();
        $tbl = $p->SelectPhieuByidTaiKhoanFind($idtaikhoan, $trangthai, $duyetdon);
        return $tbl;
    }

    function UpdateTongAndSoluongPhieu($totalByPhieuId){
        $p = new modelPhieu();
        $tbl = $p->UpdateTongAndSoluongPhieu($totalByPhieuId);
        return $tbl;
    }

    function UpdateTotalOrder($totalByPhieuId){
        $p = new modelPhieu();
        $tbl = $p->UpdateTotalOrder($totalByPhieuId); 
        return  $tbl;
    }
    
    function InsertChiTietPhieu($dsgio, $dsphieu){
        $p = new modelPhieu();
        $tbl = $p->InsertChiTietPhieu($dsgio, $dsphieu);
        return  $tbl;
    }

    function InsertPhieu($idtaikhoan, $result, $tongtien, $ngaydat)
    {
        $p = new modelPhieu();
        $tbl = $p->InsertPhieu($idtaikhoan, $result, $tongtien, $ngaydat);
        return  $tbl;
    }

    function deleteIdPhieu($idPhieu){
        $p = new modelPhieu();
        $tbl = $p->deleteIdPhieu($idPhieu);
        return  $tbl;
    }

    function getPayByIdTaiKhoan($idtaikhoan){
        $p = new modelPhieu();
        $tbl = $p->SelectPayByIdTaiKhoan($idtaikhoan);
        return  $tbl;
    }

    function getPhieuNoPay(){
        $p = new modelPhieu();
        $tbl = $p-> SelectPhieuNoPay();
        return  $tbl;
    }
   
    function getSumOrder(){
        $p = new modelPhieu();
        $tbl = $p->SelectSumOrder();
        return  $tbl;
    }

    
    
    }
?>