<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanliduan";
$conn = new mysqli($servername, $username, $password, $dbname);
    $getDA = $_GET['id'];
    $getCV = $_GET['cv'];
    $mattcn = $_GET['mattcn'];
    $query = $conn->query("SELECT PC_TrangThai FROM phancong WHERE PC_MaDuAn = '$getDA' AND PC_MaTTCN = '$mattcn' AND PC_MaCongViec = '$getCV'");
    $rw = $query->fetch_assoc();
    $Trangthai = $rw['PC_TrangThai'];
    if($Trangthai == 'Đang chờ duyệt')
    {
        $conn->QUERY("UPDATE phancong SET PC_TrangThai = 'Đã hoàn thành' WHERE PC_MaDuAn = '$getDA' AND PC_MaTTCN = '$mattcn' AND PC_MaCongViec = '$getCV'");
        echo "<script> alert('Cập nhật công việc thành công ')</script>";
        echo "<script>
            location.href = './QLDA_TN.php?id=$getDA';
          </script>";
    }
    else {
        echo "<script> alert('Cập nhật công việc thất bại')</script>";
        echo "<script>
            location.href = './QLDA_TN.php?id=$getDA';
          </script>";
    }