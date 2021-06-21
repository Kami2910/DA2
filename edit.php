<?php
$conn = mysqli_connect("localhost", "root","","quanliduan") or die("Không thể kết nối CSDL") ;
$update = false;
$DN ='';
$Email='';
$SDT='';
$gioitinh='';
$id ='';

if (isset($GET['Sua']))
{
    $update = true;
    $id = $GET['Sua'];
    $result = $conn->query("SELECT * FROM thongtincanhan WHERE TTCN_MaTTCN = '$id'") or die ($mysql->error);
    if (mysqli_num_rows($result) > 0)
    {
        $rows = $result->fetch_assoc();
        $DN = $rows['TTCN__TenDN'];
        $Email = $rows['TTCN__Email'];
        $SDT = $rows['TTCN__Sdt'];
        $gioitinh = $rows['TTCN__GioiTinh'];   
    }
}
    if (isset($_POST['update']))
        {
       $Edit_DN = $_POST['TTCN_TenDN'];
       $Edit_Email = $_POST['TTCN_Email'];
       $Edit_SDT =  $_POST['TTCN_Sdt'];
       $Edit_gioitinh = $_POST['TTCN_GioiTinh'];
       $Edit_ID = $_POST['TTCN_MaTTCN'];
       $conn->query("UPDATE thongtincanhan SET TTCN__Email= '$Edit_Email', TTCN__Sdt= '$Edit_SDT', TTCN__GioiTinh = $Edit_gioitinh WHERE TTCN_MaTTCN ='$Edit_ID'")or die ($mysql->error);
       header('location: first.php');
    }   
?>