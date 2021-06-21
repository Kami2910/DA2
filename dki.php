<?php
$servername = "localhost";
$database = "quanliduan";
$username = "root";
$password = "";
$conn = mysqli_connect("localhost", "root","","quanliduan") or die("Không thể kết nối CSDL");
session_start();

if(isset($_POST['btn-DN']))
{

	if($_POST['username'] == null || $_POST['password'] == null)
	{
		echo "<script> alert ('Vui lòng nhập tài khoản và mật khẩu của bạn') </script>";
	}
	else
	{
	  $username = $_POST['username'];
	  $password = $_POST['password'];
	}  
	if($username && $password)
    { 
        $sql = "SELECT * FROM taikhoan WHERE TK_TenDN = '".$username."' and TK_MatKhau = '".$password."'";
        $query = mysqli_query($conn, $sql);
          	if(mysqli_num_rows($query) == 0)
		  	{
				echo "<script> alert ('Tài khoản hoặc mật khẩu không chính xác. Vui lòng thử lại') </script>";  
			
		  	}   
			 else
			{         
				//  echo"<script> alert ('Đăng nhập thành công')</script>";   
				//  echo"<script> location.replace('index (1).php')</script>";
				session_start();
				$_SESSION['dulieugui'] = $username;
				 header('Location:../DA2/first.php', true,301);
				 die();
				
			}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>ĐĂNG KÍ</title>
	<meta charset = "utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="dnhap_thanh.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <script>
      	  function myFunction() {
	  var x = document.getElementById("MK")
	  var y = document.getElementById("hide1");
	  var z = document.getElementById("hide2");

	if (x.type === "password")
    {
	    x.type = "text";
	    y.style.display = "block";
	    z.style.display = "none";

	   }
	   else{
	    x.type = "password";
	    y.style.display = "none";
	    z.style.display = "block";

   }
}
    </script>
</head>
<body>

	<form action="connectdki.php" method ="POST" class="form" id="form-1">
    	<h3 class="heading">ĐĂNG KÍ</h3>
    	
    	<div class="form-group">
			<i class="fas fa-user icon"></i>
    		<input  name="Ma_TTCN" type="text" placeholder="Mã Thông Tin Cá Nhân" class="input-field">
        	<span class="form-message"></span>
    	</div>
        <div class="form-group">
			<i class="fas fa-user icon"></i>
    		<input  name="Ten_DN" type="text" placeholder="Tên Đăng Nhập" class="input-field">
        	<span class="form-message"></span>
    	</div>
        <div class="form-group">
			<i class="fas fa-user icon"></i>
    		<input  name="Email" type="text" placeholder="Email" class="input-field">
        	<span class="form-message"></span>
    	</div>
        <div class="form-group">
		    <i class="fas fa-user icon"></i>
            <input name="SDT" type="text" placeholder="Số Điện Thoại" class="input-field" maxlength="10">
        	<span class="form-message"></span>
    	</div>
        <div class="form-group">
    		<input name="GioiTinh" type="radio" value="1" checked="checked"> Nam  
			<input name="GioiTinh" type="radio" value="0"> Nữ
        	<span class="form-message"></span>
    	</div>
    	<div class="form-group">
    		<i class="fa fa-key icon"></i>
    		<input name="password" type="password" placeholder="Mật khẩu" class="input-field" >
            <span class="eye" onclick="myFunction()">
        		<i id="hide1" class="fa fa-eye"></i>
        		<i id="hide2" class="fa fa-eye-slash"></i>       		
        	</span>
			</a>
    	</div>
		<div>
			<input type="submit" name ="btn-DK"  value="Đăng kí">
			<a href="index (1)php." title='About'></a>
		</div>

	</form>

</body>
</html>

