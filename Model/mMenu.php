<?php
include_once("ketnoi.php");
class modelMenu{
    function SelectMenu()
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl= "SELECT * FROM thucdon JOIN chitietthucdon ON thucdon.idthucdon = chitietthucdon.idthucdon
        JOIN monan ON chitietthucdon.id_monan = monan.id_monan
        ORDER BY thucdon.ngaytao DESC LIMIT 1";
        $table = mysqli_query($con, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongKetNoi($con);
    }
    function SelectAllMenu()
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl= "SELECT * FROM thucdon ";
        $table = mysqli_query($con, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongKetNoi($con);
    }


    
    function InsertMenuDetails($idthucdon, $id_monan)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        // Check if $idthucdon is not NULL
        if ($idthucdon !== null) {
            if (!empty($id_monan)) { // <-- Check if $id_monan is not empty
                $insert = "INSERT INTO chitietthucdon (`idthucdon`, `id_monan`)
                    VALUES ";
    
                foreach ($id_monan as $item) {
                    $insert .= "('$idthucdon', '$item'), ";
                }
    
                $insert = rtrim($insert, ", ");

                if (!empty($insert)) {
                    $kq = mysqli_query($con, $insert);
                } else {
                    // Handle the case when $insert is empty
                    echo 'Error: $insert is empty.';
                    $kq = false;
                }
                $p->dongketnoi($con);
    
                return $kq;
            } else {
                // Handle the case when $id_monan is empty
                echo 'Error: $id_monan is empty.';
    
                // You might want to log this error or display a user-friendly message.
                // For now, returning false.
                return false;
            }
        } else {
            // Handle the case when $idthucdon is NULL
            echo 'Error: $idthucdon is NULL.';
    
            // You might want to log this error or display a user-friendly message.
            // For now, returning false.
            return false;
        }
    }

    

    

function InsertMenu($ngaytao)
{
    $p = new KetNoiDB();
    $con = $p->moKetNoi($con);
    $insert = "INSERT INTO thucdon (`ngaytao`) VALUES('$ngaytao')";
    $kq = mysqli_query($con, $insert);

    if (!$kq) {
        die("Lỗi truy vấn SQL: " . mysqli_error($con));
    }


    $p->dongketnoi($con);
    return $kq;
}





function SelectMenuByDate($ngaytao){
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM thucdon JOIN chitietthucdon ON thucdon.idthucdon = chitietthucdon.idthucdon 
        JOIN monan ON chitietthucdon.id_monan = monan.id_monan where thucdon.ngaytao = '$ngaytao' ";
        $table = mysqli_query($con, $tbl);
        $list_user = array(); 
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_user[] = $row; 
            }
            return $list_user;
        }
    
        $p->dongKetNoi($con);
        
    }

    function SelectoneMenuByDate($ngaytao){
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl= "SELECT * FROM thucdon WHERE ngaytao = '$ngaytao' ";
        $table = mysqli_query($con, $tbl);
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users = $row;
            }
            return $list_users;
        }
        $p->dongKetNoi($con);
    }

    function DeletedMonAnByidAndByThucDon($id_monan, $idthucdon){
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $delete = "DELETE FROM chitietthucdon WHERE idthucdon= $idthucdon AND id_monan = $id_monan";
        $kq = mysqli_query($con,  $delete);
        $p->dongKetNoi($con);
        return $kq;
    }
    


}


?>