<?php
include_once("ketnoi.php");

class modellogin
{
    function selectLogin()
    {
        $p = new KetNoiDB();
        $con;

        if ($p->moKetNoi($con)) {
            $query = "SELECT * FROM taikhoan INNER JOIN `vaitro` ON taikhoan.vaitro = vaitro.idvaitro";
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
}
?>
