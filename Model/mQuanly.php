<?php 

include_once("ketnoi.php");

class modelQuanly
{

    function SelectVaitro()
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM vaitro ORDER BY idvaitro DESC";
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
    function SelectUser()
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM taikhoan";
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
    function SelectUserById($idtaikhoan)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        // Kiểm tra xem $idtaikhoan có giá trị hay không
        if ($idtaikhoan === null) {
            // Trả về giá trị hoặc thông báo lỗi tùy thuộc vào yêu cầu của bạn
            return 'Invalid user ID';
        }
    
        // Sử dụng Prepared Statement để tránh lỗi SQL Injection
        $stmt = $con->prepare("SELECT * FROM `taikhoan` WHERE idtaikhoan = ?");
        $stmt->bind_param("i", $idtaikhoan);
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $list_user = $row;
            }
            $stmt->close();
            $p->dongKetNoi($con);
            return $list_user;
        } else {
            $stmt->close();
            $p->dongKetNoi($con);
            return null; // Hoặc trả về một giá trị tùy thuộc vào yêu cầu của bạn
        }
    }
    


function selectSoluongPhieubyNgay($ngaylenmon){
    $p = new KetNoiDB();
    $con = $p->moKetNoi($con);
    $tbl = "SELECT ngaylenmon, SUM(soluong) AS TongSoLuongPhieu FROM chitietphieu WHERE ngaylenmon= '$ngaylenmon' GROUP BY ngaylenmon";
    $table = mysqli_query($con, $tbl);
    $list_user = array();
    if (mysqli_num_rows($table) > 0) {
        while ($row = mysqli_fetch_assoc($table)) {
            $list_user = $row;
        }
        return $list_user;
    }
    $p->dongKetNoi($con);
}

function selectSoluongNguoiDat($ngaylenmon) {
    $p = new KetNoiDB();
    $con = $p->moKetNoi($con);
    $tbl = "SELECT idtaikhoan, ngaylenmon FROM phieudatmon WHERE ngaylenmon= '$ngaylenmon' GROUP BY idtaikhoan, ngaylenmon";
    $table = mysqli_query($con, $tbl);

    $list_user = array(); // Initialize the array

    if (mysqli_num_rows($table) > 0) {
        while ($row = mysqli_fetch_assoc($table)) {
            $list_user[] = $row; // Append each row to the array
        }
        return $list_user;
    }

    $p->dongKetNoi($con);
}

function selectSales($ngaylenmon) {
    $p = new KetNoiDB();
    $con = $p->moKetNoi($con);
    $tbl = "SELECT monan.tenmonan, chitietphieu.id_monan, chitietphieu.ngaylenmon, 
    SUM(soluong) AS TongSoLuong,
     SUM(soluong)*monan.gia as TongTien FROM chitietphieu 
     INNER JOIN monan on chitietphieu.id_monan = monan.id_monan 
     WHERE chitietphieu.ngaylenmon = '$ngaylenmon' GROUP BY chitietphieu.id_monan, chitietphieu.ngaylenmon";
    $table = mysqli_query($con, $tbl);

    $list_user = array(); // Initialize the array

    if (mysqli_num_rows($table) > 0) {
        while ($row = mysqli_fetch_assoc($table)) {
            $list_user[] = $row; // Append each row to the array
        }
        return $list_user;
    }

    $p->dongKetNoi($con);
}

function selectNhanvienBep(){
    $p = new KetNoiDB();
    $con = $p->moKetNoi($con);
    $tbl = "SELECT * FROM taikhoan INNER JOIN vaitro ON taikhoan.vaitro = vaitro.idvaitro Where vaitro != 4";
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

function selectNhanvienCongty(){
    $p = new KetNoiDB();
    $con = $p->moKetNoi($con);
    $tbl = "SELECT * FROM taikhoan INNER JOIN vaitro ON taikhoan.vaitro = vaitro.idvaitro Where vaitro = 4";
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

function DeleteUser($idtaikhoan)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $delete = " DELETE FROM taikhoan WHERE idtaikhoan = '$idtaikhoan'";
        $kq = mysqli_query($con, $delete);
        $p->dongKetNoi($con);
        return $kq;
    }


    function InsertUser($tendangnhap, $matkhau, $maNV, $hoten, $sdt, $email, $hinhanh, $ngaytao, $vaitro)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $insert = " INSERT INTO taikhoan(`tendangnhap`, `matkhau`, `maNV`, `hoten`, `sdt`, `email`, `hinhanh`, `ngaytao`, `vaitro`) 
        VALUES ('$tendangnhap', '$matkhau', '$maNV', '$hoten', '$sdt', '$email', '$hinhanh', '$ngaytao', '$vaitro')";
        $kq = mysqli_query($con, $insert);
        $p->dongKetNoi($con);
        return $kq;
    }

    function SelectUsersDifferentIdTaiKhoan($idtaikhoan)
{
    $p = new KetNoiDB();
    $con = $p->moKetNoi($con);

    // Kiểm tra xem $idtaikhoan có giá trị hay không
    if ($idtaikhoan === null) {
        // Trả về giá trị hoặc thông báo lỗi tùy thuộc vào yêu cầu của bạn
        return 'Invalid user ID';
    }

    // Sử dụng Prepared Statement để tránh lỗi SQL Injection
    $stmt = $con->prepare("SELECT * FROM `taikhoan` WHERE idtaikhoan != ?");
    $stmt->bind_param("i", $idtaikhoan);
    $stmt->execute();

    $result = $stmt->get_result();

    $list_users = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $list_users[] = $row;
        }
    }

    $stmt->close();
    $p->dongKetNoi($con);

    return $list_users;
}


function SelectUsers()
{
    $p = new KetNoiDB();
    $con = $p->moKetNoi($con);
    $tbl = "SELECT * FROM `taikhoan` ";
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


    function UpdateUser($idtaikhoan	, $matkhau, $maNV, $hoten, $sdt, $email, $hinhanh, $vaitro)
    {
        
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $update = "UPDATE taikhoan SET   matkhau = '$matkhau', maNV= '$maNV', hoten='$hoten', sdt = '$sdt',
        email = '$email', hinhanh = '$hinhanh', `vaitro` = '$vaitro'
         WHERE idtaikhoan = $idtaikhoan";
        $kq = mysqli_query($con, $update);
        $p->dongKetNoi($con);
        return $kq;
    }

    function DoiMatKhau($idtaikhoan, $matkhau) {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        // Use prepared statements to prevent SQL injection
        $update = "UPDATE taikhoan SET matKhau = ? WHERE idtaikhoan = ?";
        $stmt = mysqli_prepare($con, $update);
    
        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "si", $matkhau, $idtaikhoan);
    
            // Execute the statement
            $kq = mysqli_stmt_execute($stmt);
    
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Handle the error if preparing the statement fails
            echo "Error in preparing the statement: " . mysqli_error($con);
            $kq = false;
        }
    
        $p->dongketnoi($con);
        return $kq;
    }
    
}
?>