<?php 
$servername = "localhost";
$database = "quanliduan";
$username = "root";
$password = "";
$conn = mysqli_connect("localhost", "root","","quanliduan") or die("Không thể kết nối CSDL");
session_start();
?>

<?php 
if (isset($_POST['btn-DK']))
{
    $Ma_TTCN=$_POST['Ma_TTCN'];
    $Ten_DN=$_POST['Ten_DN'];
    $Email=$_POST['Email'];
    $SDT=$_POST['SDT'];
    $GioiTinh=$_POST['GioiTinh'];
    $password=$_POST['password'];

   
    $result =  $conn->query("SELECT * from thongtincanhan where TTCN_MaTTCN = '$Ma_TTCN' ");
   
       if(mysqli_num_rows($result)!=0)
        {
         echo"<script> alert ('Mã thông tin cá nhân đã tồn tại.Vui lòng nhập lại mã')</script>";
         echo"<script> location.replace('dki.php')</script>";
        }
        else
        { 
            if(isset($Ma_TTCN) && isset($Ten_DN) && isset($Email) && isset($SDT) && isset($GioiTinh) && isset($password))
            {
              $insert="INSERT INTO taikhoan(TK_TenDN ,TK_MatKhau) VALUE ('$Ten_DN','$password')";
              $query=mysqli_query($conn,$insert) or die (mysqli_error($conn));  

            $conn->query("INSERT INTO thongtincanhan(TTCN_MaTTCN,TTCN__TenDN,TTCN__Email,TTCN__Sdt,TTCN__GioiTinh,TTCN__MK) VALUE ('$Ma_TTCN','$Ten_DN','$Email','$SDT',$GioiTinh,'$password')") or die ($conn->error);
            
                  echo"<script> alert('Đăng kí thành công')</script>";
                  echo"<script> location.replace('login_Thanh.php')</script>";
             }
            else
             {
                echo"<script> alert ('Vui lòng nhập đầy đủ thông tin')</script>";
                echo"<script> location.replace('dki.php')</script>";
            }
       }     
}
?>