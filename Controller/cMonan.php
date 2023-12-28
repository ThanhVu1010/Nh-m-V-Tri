<?php
include_once("Model/mMonan.php");

class controlMonan
{
    function getAllMonAn()
    {
        $p = new modelMonan();
        $tbl = $p->SelectAllMonAn();
        return $tbl;
    }

    function getOrderbyDate($ngaylenmon){
        $p = new modelMonan();
        $tbl = $p->SelectOrderbyDate($ngaylenmon);
        return $tbl;
    }
    function getNguyenLieuofMonan($ngaylenmon, $id_monan){
        $p = new modelMonan();
        $tbl = $p->SelectNguyenLieuofMonan($ngaylenmon, $id_monan);
        return $tbl;
    }
    function getNguyenLieu(){
        $p = new modelMonan();
        $tbl = $p->SelectNguyenLieu();
        return $tbl;
    }

    function getBinhluanByIdMonAn($id_monan){
        $p = new modelMonan();
        $tbl = $p->SelectBinhluanByIdMonAn($id_monan);
        return $tbl;
    }
    function InsertNguyenLieuMoi($tennguyenlieu){
        $p = new modelMonan();
        $tbl = $p->InsertNguyenLieuMoi($tennguyenlieu);
        return $tbl;
    }
    
    function InsertMonanNew($tenmonan, $gia, $mota, $hinhanh, $id_loaimonan, $tmpimg, $typeimg, $sizeimg)
    {
        if ($hinhanh != '') {
            $type_array = explode('/',   $typeimg);
            $image_type = $type_array[0];
            if ($image_type == "image") {
                if ($sizeimg <= 10 * 1024 * 1024) {
                    if (move_uploaded_file($tmpimg, "Design/image/" . $hinhanh)) {
                    } else {
                        return -1;
                    }
                } else {
                    return -2;
                }
            } else {
                return -3;
            }
        } else {
            $hinhanh = 'error.png';
        }
        $p = new modelMonan();
        $ins = $p->InsertMonanNew($tenmonan, $gia, $mota, $hinhanh, $id_loaimonan);
        if ($ins) {
            return 1;
        } else {
            return 0;
        }
    }

    function getMonanMoi()
    {
        $p = new modelMonan();
        $tbl = $p->SelectMonanMoi();
        return $tbl;
    }
    
    function getDSMonan()
    {
        $p = new modelMonan();
        $tbl = $p->SelectDSMonan();
        return $tbl;
    }

    function DeletedMonAnByidAndByThucDon($id_monan)
    {
        $p = new modelMonan();
        $tbl = $p->DeletedMonAnByidAndByThucDon($id_monan);
        return $tbl;
    }
    function InsertChiTietNguyenLieuMonAn($dsSLNL, $id_monan)
    {
        $p = new modelMonan();
        $ins = $p->InsertChiTietNguyenLieuMonAn($dsSLNL, $id_monan);
        return $ins;
    }
    function getShowchitiet($id_monan)
    {
        $p = new modelMonan();
        $tbl = $p->Showchitiet($id_monan);
        return $tbl;
    }

    function InsertBinhluan($idtaikhoan,$id_monan,$noidung,$danhgia, $ngaygui)
    {
        $p = new modelMonan();
        $tbl = $p->InsertBinhluan($idtaikhoan,$id_monan,$noidung,$danhgia, $ngaygui);
        return $tbl;
    }
    
    function getAllMonAnThucdon()
    {
        $p = new modelMonan();
        $tbl = $p->selectAllMonAnThucdon();
        return $tbl;
    }

    function getAllMonanbyLoai($cate)
    {
        $p = new modelMonan();
        $tbl = $p->SelectAllMonanbyLoai($cate);
        return $tbl;
    }

    function getAllMonAnThucdonbyDate($date)
    {
        $p = new modelMonan();
        $tbl = $p->selectAllMonAnThucdonbyDate($date);
        return $tbl;
    }

   
    function isTenMonAnExists($tenmonan, $id_monan)
    {
        $p = new modelMonan();
        $tbl = $p->isTenMonAnExists($tenmonan, $id_monan);
        return $tbl;
    }
    

    function getAllLoaiMonAn()
    {
        $p = new modelMonan();
        $tbl = $p->SelectAllLoaiMonAn();
        return $tbl;
    }

    function getAllNguyenLieu()
    {
        $p = new modelMonan();
        $tbl = $p->SelectAllNguyenLieu();
        return $tbl;
    }

    function getAllNguyenLieubyIDMonan($id_monan)
    {
        $p = new modelMonan();
        $tbl = $p->selectAllNguyenLieubyIDMonan($id_monan);
        return $tbl;
    }
    

    function getLoaiMonAn($id_monan){
        $p = new modelMonan();
        $tbl = $p->SelectLoaiMonAn($id_monan);
        return $tbl;
    }
    
    function UpdateMonanById($id_monan, $tenmonan, $gia, $mota, $hinhanh, $id_loaimonan, $tmpimg = '', $typeimg = '', $sizeimg = '')

    {
        $upload_success = false;
        if ($typeimg != '') {
            $type_array = explode('/',   $typeimg);
            $image_type = $type_array[0];
            if ($image_type == "image" && $sizeimg <= 10 * 1024 * 1024) {
                if (move_uploaded_file($tmpimg, "Design/image/" . $hinhanh)) {
                    $upload_success = true;
                } else {
                    return -1;
                }
            } else {
                return -2;
            }
        }else {
            $hinhAnhMon = 'error.png';
        }
        $p = new modelMonan();
        $update =  $p->UpdateMonanById($id_monan, $tenmonan, $gia, $mota, $hinhanh, $id_loaimonan);
        if ($update) {
            return 1;
        } else {
            return 0;
        }
    }
    function InsertUpdateChiTietNguyenLieuMonAn($slNguyenLieu, $id_monan){
        $p = new modelMonan();
            $delete = $p->InsertUpdateChiTietNguyenLieuMonAn($slNguyenLieu, $id_monan);
            return $delete;
    }

    function DeleteNguyenLieuByIdMonAn($id_monan){
        $p = new modelMonan();
        $delete = $p->DeleteNguyenLieuByIdMonAn($id_monan);
        return $delete;
    }
    
    function getSearch($search)
    {
        $p = new modelMonan();
        $tbl = $p->selectSearch($search);
        return $tbl;
    }
}
?>
