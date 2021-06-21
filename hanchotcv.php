<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanliduan";
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$conn = new mysqli($servername, $username, $password, $dbname);
// kiểm connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $macv = $_POST['macongviec'];
    $id = $_GET['id'];
    // Update cong viec
if (isset($_POST['update-congviec']))
{
  $hanchotcongviec = $_POST['hanchotcongviec'];
  $hanchotduan = $conn->query("SELECT DA_HanChotDA FROM duan where DA_MaDuAn = '$id'");
  $rowDA = $hanchotduan->fetch_assoc();
  $hanchotduan1 = $rowDA['DA_HanChotDA'];
  // So sánh date công việc với date dự án
  $dateCV = new DateTime($hanchotcongviec);
  $dateDA = new DateTime($hanchotduan1);
  $timeCV = $dateCV->getTimestamp();
  $timeDA = $dateDA->getTimestamp();
  // $datePre = getdate(); lay ngay hien tai
  
  if ($timeCV<=$timeDA){
    $update_congviec = $conn->QUERY("UPDATE phancong SET PC_HanChot = '$hanchotcongviec'  WHERE PC_MaDuAn = '$id' AND PC_MaCongViec = '$macv'");

    if ($update_congviec) {
      echo "<script> alert('Thành công')</script>";
      echo "<script>
            location.href = './QLDA_TN.php?id=$id';
          </script>";
    }
    
  }
  else {
    echo "<script> alert('Thất bại')</script>";
    echo "<script>
            location.href = './QLDA_TN.php?id=$id';
          </script>";
  }

}

?>