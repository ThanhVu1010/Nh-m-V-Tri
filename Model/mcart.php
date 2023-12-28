<?php
include_once("ketnoi.php");

class modelCart
{
    private $p;
    private $con;

    public function __construct()
    {
        $this->p = new KetNoiDB();
        $this->con = null;
    }

    private function openConnection()
    {
        if ($this->p->moKetNoi($this->con)) {
            return true;
        } else {
            trigger_error("Lỗi kết nối: " . $this->con->connect_error, E_USER_ERROR);
            return false;
        }
    }

    private function closeConnection()
    {
        if ($this->con != null) {
            $this->p->dongKetNoi($this->con);
        }
    }

    public function SelectAllCart($idTK)
    {
        if ($this->openConnection()) {
            $query = "SELECT * FROM chitietgiohang JOIN monan ON chitietgiohang.id_monan = monan.id_monan 
                JOIN taikhoan ON chitietgiohang.idtaikhoan = taikhoan.idtaikhoan
                WHERE taikhoan.idtaikhoan = '$idTK'";
            $result = $this->con->query($query);

            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                trigger_error("Lỗi truy vấn: " . $this->con->error, E_USER_ERROR);
                return false;
            }
        } else {
            return false;
        }
    }

    public function SelectCart()
    {
        if ($this->openConnection()) {
            $query = "SELECT * FROM chitietgiohang ";
            $result = $this->con->query($query);

            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                trigger_error("Lỗi truy vấn: " . $this->con->error, E_USER_ERROR);
                return false;
            }
        } else {
            return false;
        }
    }
    public function SelectAllCartByIdTaiKhoan($idTK)
    {
        if ($this->openConnection()) {
            $query = "SELECT * FROM chitietgiohang  
                INNER JOIN taikhoan ON chitietgiohang.idtaikhoan = taikhoan.idtaikhoan 
                INNER JOIN monan ON chitietgiohang.id_monan = monan.id_monan 
                WHERE taikhoan.idtaikhoan = $idTK";
            $result = $this->con->query($query);

            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                trigger_error("Lỗi truy vấn: " . $this->con->error, E_USER_ERROR);
                return false;
            }
        } else {
            return false;
        }
    }

    public function SelectAllCartByIdTaiKhoanAndDate($idtaikhoan, $ngaylenmon)
    {
        if ($this->openConnection()) {
            $query = "SELECT * FROM chitietgiohang  
                INNER JOIN taikhoan ON chitietgiohang.idtaikhoan = taikhoan.idtaikhoan 
                INNER JOIN monan ON chitietgiohang.id_monan = monan.id_monan 
                WHERE taikhoan.idtaikhoan = $idtaikhoan AND chitietgiohang.ngaylenmon = '$ngaylenmon'";
            $result = $this->con->query($query);

            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                trigger_error("Lỗi truy vấn: " . $this->con->error, E_USER_ERROR);
                return false;
            }
        } else {
            return false;
        }
    }

    public function SelectAllDetailCartAndDate($idtaikhoan, $ngaylenmon)
    {
        if ($this->openConnection()) {
            $query = "SELECT * FROM chitietgiohang WHERE idtaikhoan = $idtaikhoan AND ngaylenmon ='$ngaylenmon'";
            $result = $this->con->query($query);

            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                trigger_error("Lỗi truy vấn: " . $this->con->error, E_USER_ERROR);
                return false;
            }
        } else {
            return false;
        }
    }

    public function SelectIdTKChitietgiohang($idtaikhoan)
{
    if ($this->openConnection()) {
        $query = "SELECT * FROM chitietgiohang WHERE idtaikhoan = $idtaikhoan";

        $result = $this->con->query($query);
        if ($result) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $this->closeConnection();
            return $rows;
        } else {
            trigger_error("Lỗi truy vấn: " . $this->con->error, E_USER_ERROR);
            return false;
        }
    } else {
        return false;
    }
}


    public function CreateCart($idgiohang, $ngaydat, $tongtien)
    {
        if ($this->openConnection()) {
            $insert = "INSERT INTO giohang (idgiohang, ngaydat, tongtien) 
                VALUES ('$idgiohang', '$ngaydat', '$tongtien')";
            $result = $this->con->query($insert);

            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                error_log("Lỗi truy vấn: " . $this->con->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function Createchitietgiohang($idgiohang, $idtaikhoan, $id_monan, $soluong, $ngaylenmon, $ngaydat)
    {
        if ($this->openConnection()) {
            $insert = "INSERT INTO chitietgiohang (idgiohang, ngaylenmon, ngaydat, idtaikhoan, id_monan, soluong) 
                VALUES ('$idgiohang', '$ngaylenmon', '$ngaydat', '$idtaikhoan', '$id_monan', '$soluong')";
            $result = $this->con->query($insert);

            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                error_log("Lỗi truy vấn: " . $this->con->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function Updatechitietgiohang($id_monan, $soluong, $ngaylenmon)
    {
        if ($this->openConnection()) {
            $update = "UPDATE chitietgiohang SET soluong = $soluong WHERE id_monan = $id_monan AND ngaylenmon = '$ngaylenmon'";
            $result = $this->con->query($update);
            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                error_log("Lỗi truy vấn: " . $this->con->error);
                return false;
            }
        } else {
            return false;
        }
    }

    function DeleteMonan($id_monan){
        if ($this->openConnection()) {
            $delete = "DELETE FROM chitietgiohang WHERE id_monan= '$id_monan'";
            $result = $this->con->query($delete);
            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                error_log("Lỗi truy vấn: " . $this->con->error);
                return false;
            }
        } else {
            return false;
        }
    }
    

    function DeleteCartByidTKAndNgay($idtaikhoan, $ngaylenmon){
        if ($this->openConnection()) {
            $delete = "DELETE FROM chitietgiohang WHERE idtaikhoan = '$idtaikhoan' and ngaylenmon = '$ngaylenmon'";
            $result = $this->con->query($delete);
            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                error_log("Lỗi truy vấn: " . $this->con->error);
                return false;
            }
        } else {
            return false;
        }
    }

    function DeleteGioHang($idgiohang){
        if ($this->openConnection()) {
            $delete = "DELETE FROM chitietgiohang WHERE idgiohang= '$idgiohang'";
            $result = $this->con->query($delete);
            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                error_log("Lỗi truy vấn: " . $this->con->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function DeleteMonanCartDate($today)
    {
        if ($this->openConnection()) {
            $query = "DELETE FROM chitietgiohang WHERE ngaylenmon <= '$today'";
            $result = $this->con->query($query);
            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                trigger_error("Lỗi truy vấn: " . $this->con->error, E_USER_ERROR);
                return false;
            }
        } else {
            return false;
        }
    }

    public function DeleteDuplicate()
    {
        if ($this->openConnection()) {
            $query = "DELETE c1 FROM chitietgiohang c1 JOIN chitietgiohang c2 
                ON c1.id_monan = c2.id_monan AND c1.ngaylenmon = c2.ngaylenmon 
                WHERE c1.ngaydat < c2.ngaydat";
            $result = $this->con->query($query);
            if ($result) {
                $this->closeConnection();
                return $result;
            } else {
                trigger_error("Lỗi truy vấn: " . $this->con->error, E_USER_ERROR);
                return false;
            }
        } else {
            return false;
        }
    }
}
?>