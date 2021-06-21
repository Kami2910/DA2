<?php 
$conn = new mysqli('localhost', 'root', '', 'quanliduan') or die (mysqli_error($conn));

if (isset($_POST['themcv'])){
    $MaCV = $_POST['CV_MaCongViec'];
    $TenCV = $_POST ['CV_TenCongViec'];
    $result =$conn->query("SELECT * FROM congviec WHERE CV_MaCongViec='$MaCV'");
    if(mysqli_num_rows($result)!=0)
    {
        echo "<script> alert ('Mã công việc đã tồn tại') </script>";
        echo"<script> location.replace('thongtinduan.php')</script>";
    }
    else
    {

        if($MaCV && $TenCV){
            $conn->query("INSERT INTO congviec(CV_MaCongViec, CV_TenCongViec) VALUES ('$MaCV','$TenCV')") or die ($conn->error);

                echo "<script> alert ('Thêm thành công') </script>";
                echo "<script> location.replace('thongtinduan.php')</script>";
        
        }
        else {
            echo "<script> alert ('Vui lòng nhập đủ các thông tin') </script>";
            echo "<script> location.replace('thongtinduan.php')</script>";
        }

    }
    

        
}
?>