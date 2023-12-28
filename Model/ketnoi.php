<?php
class KetNoiDB
{
    function moKetNoi(& $con)
    {
        $con = new mysqli("localhost", "root", "", "bepan_votri");

        if ($con->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $con->connect_error);
        }

        $con->set_charset("utf8");
        return $con;
    }

    function dongKetNoi($con)
    {
        $con->close();
    }
}
?>
