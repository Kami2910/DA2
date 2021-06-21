<?php
$conn = mysqli_connect("localhost", "root","","quanliduan") or die("Không thể kết nối CSDL") ;
$update = false;
$MaDA ='';
$TenDA ='';
$HanChotDA ='';
if (isset($GET['luu']))
{
    $update = true;
    $id = $GET['save'];
    $result = $conn->query("SELECT * FROM duan WHERE DA_MaDuAn = '$id'") or die ($conn->error);
    if (mysqli_num_rows($result) > 0)
    {
        $rows = $result->fetch_assoc();
        $MaDA = $rows['DA_MaDuAn'];
        $TenDA = $rows['DA_TenDuAn'];
        $HanChotDA = $rows['DA_HanChotDA'];
    }
}
    if (isset($_POST['save']))
        {
       $Edit_MaDA = $_POST['DA_MaDuAn'];
       $Edit_TenDA = $_POST['DA_TenDuAn'];
       $Edit_HanChotDA =  $_POST['DA_HanChotDA'];

       $conn->query("UPDATE duan SET DA_MaDuAn= '$Edit_MaDA', DA_TenDuAn= '$Edit_TenDA', DA_HanChotDA = '$Edit_HanChotDA' WHERE DA_MaDuAn ='$Edit_MaDA'")or die ($conn->error);
       header('location: thongtinduan.php');
    }   
?>