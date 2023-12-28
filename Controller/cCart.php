<?php

include_once("Model/mCart.php");
class controlCart
{
    function getAllCart($idTK)
    {
        $p = new modelCart();
        $tbl = $p->SelectAllCart($idTK);
        return  $tbl;
    }

    function getCart()
    {
        $p = new modelCart();
        $tbl = $p->SelectCart();
        return  $tbl;
    }

    function getAllCartByIdTaiKhoan($idTK){
        $p = new modelCart();

        $result = $p->SelectAllCartByIdTaiKhoan($idTK);
        // Lấy dữ liệu từ kết quả dưới dạng mảng
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        return $data;
    }

    function GetAllCartByIdTaiKhoanAndDate($idtaikhoan, $ngaylenmon){
        $p = new modelCart();
        $result = $p->SelectAllCartByIdTaiKhoanAndDate($idtaikhoan, $ngaylenmon);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }
    
    function getIdTKChitietgiohang($idtaikhoan){
        $p = new modelCart();
        $tbl = $p->SelectIdTKChitietgiohang($idtaikhoan);
        return  $tbl;
    }    



    function getAllDetailCartAndDate($idtaikhoan, $ngaylenmon){
        $p = new modelCart();
        $tbl = $p->SelectAllDetailCartAndDate($idtaikhoan, $ngaylenmon);
        return  $tbl;
    }    

    function CreateShopCart($idgiohang, $ngaydat, $tongtien)
    {
        $p = new modelCart();
        $tbl = $p->CreateCart($idgiohang, $ngaydat, $tongtien);
        return  $tbl;
    }

    function CreateShopchitietgiohang($idgiohang, $idtaikhoan, $id_monan, $soluong, $ngaylenmon, $ngaydat)
    {
        $p = new modelCart();
        $tbl = $p->Createchitietgiohang($idgiohang, $idtaikhoan, $id_monan, $soluong, $ngaylenmon, $ngaydat);
        return  $tbl;
    }

    function UpdateShopchitietgiohang($id_monan, $soluong, $ngaylenmon)
    {
        $p = new modelCart();
        $tbl = $p->Updatechitietgiohang($id_monan, $soluong, $ngaylenmon);
        return  $tbl;
    }

    function DeleteCartMonan($id_monan){
        $p = new modelCart();
        $tbl = $p->DeleteMonan($id_monan);
        return  $tbl;
    }

    function DeleteCartByidTKAndNgay($idtaikhoan, $ngaylenmon){
        $p = new modelCart();
        $tbl = $p->DeleteCartByidTKAndNgay($idtaikhoan, $ngaylenmon);
        return  $tbl;
    }

    function DeleteGioHang($idgiohang){
        $p = new modelCart();
        $tbl = $p->DeleteGioHang($idgiohang);
        return  $tbl;
    }

    function DeleteMonanCartDate($today){
        $p = new modelCart();
        $tbl = $p->DeleteMonanCartDate($today);
        return  $tbl;
    }

    function DeleteDuplicate(){
        $p = new modelCart();
        $tbl = $p->DeleteDuplicate();
        return  $tbl;
    }
}
?>