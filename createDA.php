<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanliduan";

$dulieunhan = isset($_SESSION['dulieugui']) ? $_SESSION['dulieugui'] :''; 
// tạo connection

$conn = mysqli_connect($servername, $username, $password, $dbname) or die ("Không thể kết nối CSDL");
// kiểm connection
$thanhvien = mysqli_query($conn, "SELECT * FROM thanhvien join thongtincanhan on thanhvien.tv_MaTTCN = thongtincanhan.TTCN_MaTTCN WHERE `TTCN__TenDN` LIKE '$dulieunhan' ORDER BY `TTCN_MaTTCN` ASC");
    $row2 = mysqli_fetch_array($thanhvien);
if (isset($_POST['save'])){
    $MaDA = $_POST['DA_MaDuAn'];
    $TenDA = $_POST ['DA_TenDuAn'];
    $Hanchot = $_POST['DA_HanChotDA'];

    $result =  $conn->query("SELECT *from duan where DA_MaDuAn='$MaDA'");
    
    if(mysqli_num_rows($result)!=0)
    {
        echo "<script> alert ('Mã dự án đã tồn tại ') </script>";
        echo"<script> location.replace('taoduan.php')</script>";
    }
    else
    {
        if($MaDA && $TenDA && $Hanchot){
            $thanhvien = mysqli_query($conn, "SELECT * FROM thanhvien join thongtincanhan on thanhvien.tv_MaTTCN = thongtincanhan.TTCN_MaTTCN WHERE `TTCN__TenDN` LIKE '$dulieunhan' ORDER BY `TTCN_MaTTCN` ASC");
            $row2 = mysqli_fetch_array($thanhvien);
            $mathanhvien = $row2['TV_MaThanhVien'];
            $conn->query("INSERT INTO duan(DA_MaDuAn, DA_TenDuAn, DA_HanChotDA) VALUES ('$MaDA','$TenDA','$Hanchot')") or die ($conn->error);
            $connect = $conn->query("INSERT INTO phancong (PC_MaDuAn , PC_MaThanhVien, PC_MaCongViec, PC_TrangThai, PC_MaVaiTro, PC_HanChot ) VALUES ('$MaDA','$mathanhvien','Tạo dự án','Chưa hoàn thành','TN','$Hanchot')");

                echo "<script> alert ('Thêm thành công') </script>";
                // echo"<script> location.replace('taoduan.php')</script>";
                echo '<pre>';
                  print_r($connect);
                echo '</pre>';
        }
        else {
            echo "<script> alert ('Vui lòng nhập đủ các thông tin') </script>";
            echo"<script> location.replace('taoduan.php')</script>";
        }
    }
    
   
        
}
?>