<?php
include_once("ketnoi.php");

class modelMonan
{
    function SelectAllMonAn()
{
    $p = new KetNoiDB();
    $con;

    if ($p->moKetNoi($con)) {
        $query = "SELECT * FROM monan ";
        $result = $con->query($query);

        if ($result) {
            $data = array();

            // Fetch all rows from the result
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            $p->dongKetNoi($con);
            return $data;
        } else {
            // Xử lý lỗi truy vấn
            echo "Lỗi truy vấn: " . $con->error;
        }
    } else {
        return false;
    }
}

    function InsertMonanNew($tenmonan, $gia, $mota, $hinhanh, $id_loaimonan)
    {
        $p = new KetNoiDB();
        $con;
    
        if ($p->moKetNoi($con)) {
            $insert = "INSERT INTO monan (tenmonan ,gia,mota, hinhanh, id_loaimonan)
            VALUES  ('$tenmonan', $gia,'$mota', '$hinhanh', $id_loaimonan)";
            $result = $con->query($insert);
    
            if ($result) {
                // Lấy id_monan của món ăn mới được thêm vào
                $id_monan = $con->insert_id;
                $p->dongKetNoi($con);
                return $id_monan;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }
    
    function SelectBinhluanByIdMonAn($id_monan)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM binhluan INNER JOIN taikhoan ON binhluan.idtaikhoan = taikhoan.idtaikhoan WHERE binhluan.id_monan = $id_monan ORDER BY ngaygui DESC";
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


    
    function InsertBinhluan($idtaikhoan,$id_monan,$noidung,$danhgia, $ngaygui)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $insert = "INSERT INTO binhluan (idtaikhoan, id_monan, noidung, danhgia, ngaygui)
        VALUES  ('$idtaikhoan','$id_monan','$noidung','$danhgia','$ngaygui')";
        $kq = mysqli_query($con,  $insert);
        $p->dongketnoi($con);
        return $kq;
    }
    
    function SelectOrderbyDate($ngaylenmon)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tblUsers = "SELECT chitietphieu.id_monan, monan.tenmonan, monan.hinhanh, chitietphieu.ngaylenmon, 
        SUM(soluong) AS tongSoLuong FROM chitietphieu INNER JOIN monan ON chitietphieu.id_monan = monAn.id_monan
         WHERE chitietphieu.ngaylenmon = '$ngaylenmon' GROUP BY id_monan, ngaylenmon";
        $table = mysqli_query($con, $tblUsers);
        $list_users = array();
        if (mysqli_num_rows($table) > 0) {
            while ($row = mysqli_fetch_assoc($table)) {
                $list_users[] = $row;
            }
            return $list_users;
        }
        $p->dongketnoi($con);
    }
    function SelectNguyenLieu()
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $tbl = "SELECT * FROM `nguyenlieu`";
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


    function InsertNguyenLieuMoi($tennguyenlieu)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $insert = "INSERT INTO nguyenlieu (tennguyenlieu )
        VALUES  ('$tennguyenlieu')";
        $kq = mysqli_query($con,  $insert);
        $p->dongketnoi($con);
        return $kq;
    }

    function SelectNguyenLieuofMonan($ngaylenmon, $id_monan)
{
    $p = new KetNoiDB();
    $con = $p->moKetNoi($con);

    $tblUsers = "SELECT 
                    nguyenlieu.tennguyenlieu,
                    chitietnguyenlieu.soluongsudung,
                    chitietnguyenlieu.donvitinh 
                 FROM 
                    chitietphieu
                 INNER JOIN 
                    monan ON chitietphieu.id_monan = monan.id_monan
                 INNER JOIN 
                    chitietnguyenlieu ON monan.id_monan = chitietnguyenlieu.id_monan
                 INNER JOIN 
                    nguyenlieu ON chitietnguyenlieu.idnguyenlieu = nguyenlieu.idnguyenlieu
                 WHERE 
                    chitietphieu.ngaylenmon = '$ngaylenmon' AND chitietphieu.id_monan = $id_monan
                 GROUP BY 
                    tennguyenlieu, soluongsudung";

    $table = mysqli_query($con, $tblUsers);

    if (!$table) {
        die('Error: ' . mysqli_error($con));
    }

    $list_users = array();

    if (mysqli_num_rows($table) > 0) {
        while ($row = mysqli_fetch_assoc($table)) {
            $list_users[] = $row;
        }
    }

    $p->dongketnoi($con);

    return $list_users;
}



    function SelectMonanMoi()
    {
        $p = new KetNoiDB();
    $con;

    if ($p->moKetNoi($con)) {
        $query = "SELECT * FROM monan ORDER BY id_monan DESC LIMIT 1";
        $result = $con->query($query);

        if ($result) {
            // Nếu có dữ liệu trả về
            if ($result->num_rows > 0) {
                // Lấy dữ liệu từ kết quả truy vấn
                $monanMoi = $result->fetch_assoc();

                // Đóng kết nối
                $p->dongKetNoi($con);

                return $monanMoi;
            } else {
                // Nếu không có dữ liệu
                $p->dongKetNoi($con);
                return null;
            }
        } else {
            // Xử lý lỗi truy vấn
            echo "Lỗi truy vấn: " . $con->error;
        }
    } else {
        return false;
    }
    }


    function InsertChiTietNguyenLieuMonAn($dsSLNL, $id_monan)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        if ($con) {
            $insert = "INSERT INTO chitietnguyenlieu(`idnguyenlieu`, `idmonan`,  `soluong`) VALUES ";
    
            if (!empty($dsSLNL)) {
                foreach ($dsSLNL as $item) {
                    if (isset($item['nguyenlieu'], $item['soluong'])) {
                        $idnguyenlieu = $item['nguyenlieu'];
                        $soluong = $item['soluong'];
                        $insert .= "($idnguyenlieu, $id_monan, $soluong), ";
                    }
                }
    
                $insert = rtrim($insert, ", ");
    
                try {
                    $kq = mysqli_query($con, $insert);
    
                    if (!$kq) {
                        throw new Exception(mysqli_error($con));
                    }
    
                    $p->dongKetNoi($con);
                    return $kq;
                } catch (Exception $e) {
                    echo 'Lỗi SQL: ',  $e->getMessage(), "\n";
                }
            } else {
                echo "Danh sách chi tiết nguyên liệu trống.";
            }
        } else {
            echo "Không thể kết nối đến cơ sở dữ liệu.";
        }
    }
    
    
    
    
    

    function SelectDSMonan()
    {
        $p = new KetNoiDB();
        $con;

        if ($p->moKetNoi($con)) {
            $query = "SELECT * FROM monan 
            INNER JOIN loaimonan on monan.id_loaimonan = loaimonan.id_loaimonan ORDER BY id_monan ASC";
            $result = $con->query($query);

            if ($result) {
                $p->dongKetNoi($con);
                return $result;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }

    
    function DeletedMonAnByidAndByThucDon($id_monan) {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        // Delete associated records in chitietnguyenlieu
        $deleteChitiet = "DELETE FROM chitietnguyenlieu WHERE id_monan = $id_monan";
        $kqChitiet = mysqli_query($con, $deleteChitiet);
    
        // Check if deleting associated records was successful
        if (!$kqChitiet) {
            // Handle the error, log it, or return an error response
            // For simplicity, let's return an error message
            $p->dongKetNoi($con);
            return "Error deleting associated records: " . mysqli_error($con);
        }
    
        // Now you can safely delete the monan record
        $deleteMonan = "DELETE FROM monan WHERE id_monan = $id_monan";
        $kqMonan = mysqli_query($con, $deleteMonan);
    
        $p->dongKetNoi($con);
    
        // Check if deleting monan record was successful
        if (!$kqMonan) {
            // Handle the error, log it, or return an error response
            // For simplicity, let's return an error message
            return "Error deleting monan record: " . mysqli_error($con);
        }
    
        // Return success message or any other indication of success
        return "Record deleted successfully";
    }
    


    function Showchitiet($id_monan)
{
    $p = new KetNoiDB();
    $con;
    
    if ($p->moKetNoi($con)) {
        $query = "SELECT monan.*, chitietnguyenlieu.*, nguyenlieu.tennguyenlieu
        FROM monan
        INNER JOIN chitietnguyenlieu ON monan.id_monan = chitietnguyenlieu.id_monan
        INNER JOIN nguyenlieu ON nguyenlieu.idnguyenlieu = chitietnguyenlieu.idnguyenlieu
        WHERE monan.id_monan =" . $id_monan;
        $result = $con->query($query);
    
        if ($result) {
            $data = array(); // Tạo một mảng để lưu trữ dữ liệu
    
            while ($row = $result->fetch_assoc()) {
                // Lưu thông tin món ăn
                $data['monan']['id_monan'] = $row['id_monan'];
                $data['monan']['tenmonan'] = $row['tenmonan'];
                $data['monan']['gia'] = $row['gia'];
                $data['monan']['hinhanh'] = $row['hinhanh'];
                $data['monan']['mota'] = $row['mota'];
    
                // Lưu thông tin nguyên liệu từ bảng chitietnguyenlieu
                $data['nguyenlieu'][] = array(
                    'idnguyenlieu' => $row['idnguyenlieu'],
                    'tennguyenlieu' => $row['tennguyenlieu'],
                    'soluongsudung' => $row['soluongsudung'],
                    'donvitinh' => $row['donvitinh'],
                    // Các cột khác của bảng chitietnguyenlieu nếu cần
                );
            }
    
            $p->dongKetNoi($con);
            return $data;
        } else {
            // Xử lý lỗi truy vấn
            echo "Lỗi truy vấn: " . $con->error;
        }
    } else {
        return false;
    }
}    



    function SelectAllMonanbyLoai($cate)
    {
        $p = new KetNoiDB();
        $con;

        if ($p->moKetNoi($con)) {
            $query = "SELECT *
            FROM thucdon
            JOIN chitietthucdon ON thucdon.idthucdon = chitietthucdon.idthucdon
            JOIN monan ON chitietthucdon.id_monan = monan.id_monan
            WHERE monan.id_loaimonan = $cate" ;
            $result = $con->query($query);

            if ($result) {
                $p->dongKetNoi($con);
                return $result;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }


    function selectAllMonAnThucdonbyDate($date)
    {
        $p = new KetNoiDB();
        $con;
        if ($p->moKetNoi($con)) {
            $query = "SELECT * FROM thucdon JOIN chitietthucdon ON thucdon.idthucdon = chitietthucdon.idthucdon 
            JOIN monan ON chitietthucdon.id_monan = monan.id_monan WHERE ngaytao = '$date'";
            $result = $con->query($query);

            if ($result) {
                $p->dongKetNoi($con);
                return $result;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }
    function isTenMonAnExists($tenmonan, $id_monan)
    {
        $p = new KetNoiDB();
        $con;
    
        if ($p->moKetNoi($con)) {
            // Sử dụng prepared statement để tránh SQL injection
            $query = "SELECT COUNT(*) as count FROM monan WHERE tenmonan = ? AND id_monan != ?";
            $stmt = $con->prepare($query);
    
            if ($stmt) {
                // Binds variables to a prepared statement as parameters
                $stmt->bind_param("si", $tenmonan, $id_monan);
                $count = 0;
                // Executes a prepared Query
                $stmt->execute();
    
                // Binds variables to a result set
                $stmt->bind_result($count);
    
                // Fetches the result from a prepared statement into the variables bound by mysqli_stmt_bind_result()
                $stmt->fetch();
    
                // Đóng kết quả và kết nối
                $stmt->close();
                $p->dongKetNoi($con);
    
                // Trả về true nếu có ít nhất một tên món ăn trùng lặp
                return $count > 0;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }
    
    




    function selectAllMonAnThucdon()
    {
        $p = new KetNoiDB();
        $con;

        if ($p->moKetNoi($con)) {
            $query = "SELECT * FROM thucdon JOIN chitietthucdon ON thucdon.idthucdon = chitietthucdon.idthucdon 
            JOIN monan ON chitietthucdon.id_monan = monan.id_monan" ;
            $result = $con->query($query);

            if ($result) {
                $p->dongKetNoi($con);
                return $result;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }

    

    function SelectAllLoaiMonAn()
    {
        $p = new KetNoiDB();
        $con;
    
        if ($p->moKetNoi($con)) {
            $query = "SELECT * FROM loaimonan";
            $result = $con->query($query);
    
            if ($result) {
                $data = array();
    
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
    
                $p->dongKetNoi($con);
                return $data;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }
    function SelectAllNguyenLieu()
    {
        $p = new KetNoiDB();
        $con;
    
        if ($p->moKetNoi($con)) {
            $query = "SELECT * FROM nguyenlieu ";
            $result = $con->query($query);
    
            if ($result) {
                $data = array();
    
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
    
                $p->dongKetNoi($con);
                return $data;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }
    function SelectLoaiMonAn($id_monan)
    {
        $p = new KetNoiDB();
        $con;
    
        if ($p->moKetNoi($con)) {
            $query = "SELECT * FROM monan WHERE id_monan = $id_monan";
            $result = $con->query($query);
    
            if ($result) {
                // Fetch a single row since id_monan should be unique
                $data = $result->fetch_assoc();
                $p->dongKetNoi($con);
                return $data;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }
    
    function selectAllNguyenLieubyIDMonan($id_monan)
{
    $p = new KetNoiDB();
    $con;

    if ($p->moKetNoi($con)) {
        $query = "SELECT * FROM monan 
        INNER JOIN chitietnguyenlieu ON monan.id_monan = chitietnguyenlieu.id_monan 
        INNER JOIN nguyenlieu ON chitietnguyenlieu.idnguyenlieu = nguyenlieu.idnguyenlieu
        WHERE monan.id_monan = $id_monan";

        $result = $con->query($query);

        if ($result) {
            $data = array();

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            $p->dongKetNoi($con);
            return $data;
        } else {
            // Xử lý lỗi truy vấn
            echo "Lỗi truy vấn: " . $con->error;
        }
    } else {
        return false;
    }

    
}

    
    
    
    function selectSearch($search){
        $p = new KetNoiDB();
        $con;
        
        if ($p->moKetNoi($con)) {
            $query = "SELECT * FROM monan where tenmonan LIKE '%$search%' OR gia like '%$search%' ORDER BY gia ASC";
            $result = $con->query($query);

            if ($result) {
                $p->dongKetNoi($con);
                return $result;
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $con->error;
            }
        } else {
            return false;
        }
    }
    function UpdateMonanById($id_monan, $tenmonan, $gia, $mota, $hinhanh, $id_loaimonan)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        // Check if id_loaimonan is not empty
        if (!empty($id_loaimonan)) {
            // Kiểm tra xem id_loaimonan có tồn tại trong bảng loaimonan hay không
            $checkQuery = "SELECT COUNT(*) FROM loaimonan WHERE id_loaimonan = $id_loaimonan";
            $result = mysqli_query($con, $checkQuery);
            $row = mysqli_fetch_array($result);
    
            if ($row[0] > 0) {
                // Nếu tồn tại, thực hiện câu lệnh UPDATE
                $update = "UPDATE monan SET  tenmonan = '$tenmonan', gia = '$gia', mota = '$mota', hinhanh='$hinhanh', id_loaimonan = '$id_loaimonan' WHERE id_monan = $id_monan";
                $kq = mysqli_query($con, $update);
            } else {
                // Nếu không tồn tại, xử lý theo ý của bạn (ví dụ: thông báo lỗi)
                $kq = false;
            }
        } else {
            // Handle the case where id_loaimonan is empty (you can customize this part)
            $kq = false;
        }
    
        $p->dongketnoi($con);
        return $kq;
    }
    
    
    function DeleteNguyenLieuByIdMonAn($id_monan)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
        $delete = "DELETE FROM chitietnguyenlieu WHERE id_monan = $id_monan";
        $kq = mysqli_query($con, $delete);
        $p->dongketnoi($con);
        return $kq;
    }

    function InsertUpdateChiTietNguyenLieuMonAn($slNguyenLieu, $id_monan)
    {
        $p = new KetNoiDB();
        $con = $p->moKetNoi($con);
    
        // Sử dụng prepared statement
        $insert = "INSERT INTO chitietnguyenlieu (`idnguyenlieu`, `id_monan`,  `soluongsudung`) VALUES (?, ?, ?)";
    
        $stmt = mysqli_prepare($con, $insert);
    
        if ($stmt) {
            foreach ($slNguyenLieu as $index => $item) {
                $idnguyenlieu = intval($item['idnguyenlieu']);
                $soluongsudung = intval($item['soluongsudung']);
    
                mysqli_stmt_bind_param($stmt, "iii", $idnguyenlieu, $id_monan, $soluongsudung);
                mysqli_stmt_execute($stmt);
            }
    
            mysqli_stmt_close($stmt);
            $p->dongketnoi($con);
            return true;
        } else {
            // Handle error
            echo "Prepared statement error: " . mysqli_error($con);
            $p->dongketnoi($con);
            return false;
        }
    }
    
    
}
?>
