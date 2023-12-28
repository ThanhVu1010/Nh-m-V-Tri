<?php
include_once("ketnoi.php");
class modelPhieu
{

    function SelectOrder()
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM phieudatmon ";
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

    function SelectOrderDetail()
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM chitietphieu INNER JOIN monan ON chitietphieu.id_monan = monan.id_monan";
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

    function SelectOrderNewCreateByIdTaiKhoan($idtaikhoan)
    {
        // Kiểm tra xem $idtaikhoan có giá trị hay không
        if ($idtaikhoan === null) {
            // Trả về mảng rỗng nếu $idtaikhoan là NULL
            return array();
        }
    
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        // Thêm dấu ngoặc kép (`) cho tên cột ngaydat
        $tbl = "SELECT * FROM phieudatmon WHERE idtaikhoan = $idtaikhoan ORDER BY `ngaydat` DESC LIMIT 1";
    
        $table = mysqli_query($con, $tbl);
        $list_users = array();
    
        if ($table) {
            if (mysqli_num_rows($table) > 0) {
                while ($row = mysqli_fetch_assoc($table)) {
                    $list_users[] = $row;
                }
            }
    
            // Giải phóng bộ nhớ
            mysqli_free_result($table);
        } else {
            // Báo lỗi nếu có vấn đề với truy vấn
            trigger_error("Lỗi truy vấn: " . mysqli_error($con), E_USER_ERROR);
        }
    
        // Đóng kết nối
        $p->dongKetNoi($con);
    
        // Trả về mảng dữ liệu
        return $list_users;
    }
    
    

    function UpdateTotalOrder($totalByPhieuId)
    {
        if (empty($totalByPhieuId)) {
            // Xử lý trường hợp mảng rỗng hoặc NULL
            return false;
        }
    
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        $update = '';
        foreach ($totalByPhieuId as $idPhieu => $total) {
            // Thêm kiểm tra xem $idPhieu và $total có giá trị hợp lệ hay không
            if ($idPhieu && $total) {
                $update .= "UPDATE phieudatmon SET `tongtien` = $total WHERE idPhieu = $idPhieu; ";
            }
        }
    
        if (!empty($update)) {
            $kq = mysqli_multi_query($con, $update);
            $p->dongKetNoi($con);
            return $kq;
        } else {
            // Xử lý trường hợp $update là chuỗi trống
            return false;
        }
    }

    function selectPhieuByidTaiKhoan($idtaikhoan){
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM taikhoan JOIN phieudatmon ON taikhoan.idtaikhoan = phieudatmon.idtaikhoan JOIN chitietphieu 
        ON phieudatmon.idPhieu = chitietphieu.idPhieu JOIN monan ON chitietphieu.id_monan = monan.id_monan 
        WHERE taikhoan.idtaikhoan = '$idtaikhoan'  ORDER BY phieudatmon.ngaydat DESC;";
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
    
    function SelectPhieuByidTaiKhoanFind($idtaikhoan, $trangthai, $duyetdon)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);

        $find = '';
        if ($trangthai != '') {
            $find = " AND phieudatmon.trangthai = $trangthai";
        }
        if ($duyetdon != '') {
            $find = "AND duyetdon= $duyetdon";
        }
        $tbl = "SELECT * FROM taikhoan JOIN phieudatmon ON taikhoan.idtaikhoan = phieudatmon.idtaikhoan JOIN chitietphieu 
        ON phieudatmon.idPhieu = chitietphieu.idPhieu JOIN monan ON chitietphieu.id_monan = monan.id_monan 
        WHERE taikhoan.idtaikhoan = '$idtaikhoan' $find ORDER BY phieudatmon.ngaydat DESC;";
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

    function selectSumbyidtaikhoan($idtaikhoan){
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT Sum(tongtien) as tongtien FROM phieudatmon WHERE idtaikhoan = '$idtaikhoan' AND trangthai = 0 GROUP BY idtaikhoan";
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

    function UpdateTongAndSoluongPhieu($totalByPhieuId)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);

        if (is_array($totalByPhieuId) && count($totalByPhieuId) > 0) {
            $update = '';
            foreach ($totalByPhieuId as $idPhieu => $item) {
                $total = $item['tongtien'];
                $soluong = $item['soluong'];
                $update .= "UPDATE phieudatmon SET `tongtien` = $total, tongsoluong = $soluong WHERE idPhieu = $idPhieu; ";
            }
            $kq = mysqli_multi_query($con, $update);
            $p->dongKetNoi($con);
            return $kq;
        } else {
            // Trả về false hoặc thực hiện các xử lý khác tùy vào logic ứng dụng của bạn
            $p->dongKetNoi($con);
            return false;
        }
    }
    function InsertChiTietPhieu($dsgio, $dsphieu)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $insert = "INSERT INTO chitietphieu (`idPhieu`, `id_monan`, `soluong`, `ngaylenmon`) VALUES";

        foreach ($dsgio as $item) {
            foreach ($dsphieu as $order) {
                if ($item['ngaylenmon'] == $order['ngaylenmon'] && $item['idtaikhoan'] == $order['idtaikhoan']) {
                    $id_monan = $item['id_monan'];
                    $soluong = $item['soluong'];
                    $ngaylenmon =  $item['ngaylenmon'];
                    $idPhieu = $order['idPhieu'];
                    $insert .= "($idPhieu, $id_monan, $soluong, '$ngaylenmon'),";
                }
            }
        }
        $insert = rtrim($insert, ", ");
        $kq = mysqli_query($con,  $insert);
        $p->dongKetNoi($con);
        return $kq;
    }

    


    function InsertPhieu($idtaikhoan, $result, $tongtien, $ngaydat)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $insert = "INSERT INTO phieudatmon (`idPhieu`, `idtaikhoan`, `tongsoluong`, `tongtien`, `ngaylenmon`, `ngaydat`) 
  VALUES ";

        foreach ($result as $item) {

            $tongsoluong = $item['soluong'];
            $ngaylenmon = $item['ngaylenmon'];


            $idPhieu  = rand(0, 1000000);
            $idPhieu = $_SESSION['is_login']['idtaikhoan'] . $idPhieu;
            $insert .= "($idPhieu, $idtaikhoan, '$tongsoluong', '$tongtien', '$ngaylenmon', '$ngaydat'),";
        }


        $insert = rtrim($insert, ", ");
        $kq = mysqli_query($con,  $insert);
        $p->dongKetNoi($con);
        return $kq;
    }
    
    function deleteIdPhieu($idPhieu){
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);

        $delete = "DELETE FROM phieudatmon WHERE idPhieu = $idPhieu";
        $kq = mysqli_query($con, $delete);
        $p->dongKetNoi($con);
        return $kq;
    }

    function SelectOrderByNgayLenMon($ngaylenmon)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM taikhoan 
        JOIN  phieudatmon ON taikhoan.idtaikhoan =  phieudatmon.idtaikhoan        
        JOIN chitietphieu ON phieudatmon.idPhieu = chitietphieu.idPhieu 
        JOIN monan ON chitietphieu.id_monan = monan.id_monan WHERE chitietphieu.ngaylenmon = '$ngaylenmon'";
        $table = mysqli_query($con, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($con);
    }
    function DuyetPhieu($approve, $ngaylenmon)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        $update = '';
        foreach ($approve as $item) {
            $idtaikhoan =  $item['idtaikhoan'];
            $duyetdon =  $item['duyetdon'];
            $update .= "UPDATE phieudatmon SET duyetdon = $duyetdon WHERE idtaikhoan = $idtaikhoan and ngaylenmon = '$ngaylenmon'; ";
        }
    
        $kq = mysqli_multi_query($con, $update);
    
        if ($kq === false) {
            // Print the error details
            echo 'Error: ' . mysqli_error($con);
        } else {
            echo 'Update successful!';
        }
    
        $p->dongketnoi($con);
        return $kq;
    }
    
    function SelectSumOrder()
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT taikhoan.idtaikhoan, taikhoan.maNV, taikhoan.hoten, taikhoan.sdt, taikhoan.email, Sum(tongtien) as TongTien, COUNT(idPhieu) as TongSoPhieu
         FROM phieudatmon INNER JOIN taikhoan ON phieudatmon.idtaikhoan = taikhoan.idtaikhoan WHERE thanhtoan = 0 GROUP BY phieudatmon.idtaikhoan";

        $table = mysqli_query($con, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($con);
    }

    function SelectPhieuNoPay()
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM  phieudatmon
         WHERE  thanhtoan = 0";

        $table = mysqli_query($con, $tbl);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($con);
    }
    function XacNhanPhieu($trangthai, $ngaylenmon)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        $update = '';
        foreach ($trangthai as $item) {
            $idtaikhoan =  $item['idtaikhoan'];
            $trangthai =  $item['trangthai'];
            $update .= "UPDATE phieudatmon SET trangthai = $trangthai WHERE idtaikhoan = $idtaikhoan and ngaylenmon = '$ngaylenmon'; ";
        }
    
        $kq = mysqli_multi_query($con, $update);
    
        if ($kq === false) {
            // Print the error details
            echo 'Error: ' . mysqli_error($con);
        } else {
            echo 'Update successful!';
        }
    
        $p->dongketnoi($con);
        return $kq;
    }

    function ThanhToanPhieu($thanhtoan, $ngaylenmon)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        $update = '';
        foreach ($thanhtoan as $item) {
            $idtaikhoan =  $item['idtaikhoan'];
            $thanhtoan =  $item['thanhtoan'];
            $update .= "UPDATE phieudatmon SET thanhtoan = $thanhtoan WHERE idtaikhoan = $idtaikhoan and ngaylenmon = '$ngaylenmon'; ";
        }
    
        $kq = mysqli_multi_query($con, $update);
    
        if ($kq === false) {
            // Print the error details
            echo 'Error: ' . mysqli_error($con);
        } else {
            echo 'Update successful!';
        }
    
        $p->dongketnoi($con);
        return $kq;
    }
    function SelectPayByIdTaiKhoan($idtaikhoan)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT chitietphieu.id_monan ,SUM(chitietphieu.soluong) as soluong, monan.tenmonan, monan.gia FROM phieudatmon 
        INNER JOIN chitietphieu ON phieudatmon.idPhieu=chitietphieu.idPhieu
        INNER JOIN monan ON chitietphieu.id_monan = monan.id_monan WHERE phieudatmon.idtaikhoan = '$idtaikhoan' AND phieudatmon.thanhtoan = 0
        GROUP BY chitietphieu.id_monan";
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



}
?>