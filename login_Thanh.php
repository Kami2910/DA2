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
				 $_SESSION['username'] = $username;
				 header('Location:../DA2/index.php', true,301);
				 die();
				
			}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Đăng nhập</title>
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
	<form action="" method ="POST" class="form" id="form-1" enctype="multipart/form-data">
    	<h3 class="heading">ĐĂNG NHẬP</h3>
    	<img alt="Login-heading" src="images/login-heading.png" >
    	
    	<div class="form-group">
			<i class="fas fa-user icon"></i>
    		<input id="email" name="username" type="text" placeholder="username" class="input-field">
        	<span class="form-message"></span>
    	</div>
    	
    	<div class="form-group">
    		<i class="fa fa-key icon"> </i>
    		<input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="input-field">
    		<!-- <span class="form-message"></span> -->
        <span class="eye" onclick=" myFunction()">
        		<i id="hide1" class="fa fa-eye"></i>
        		<i id="hide2" class="fa fa-eye-slash"></i>       		
        	</span>
        	</a>
    	</div>
			<div>
		<input type="submit" name ="btn-DN"  value="Đăng nhập">
		<a href="index (1)php." title='About'></a>
			</div>
    	<div class="sign">
    		<a href="dki_vy.html">Đăng ký</a>
    	</div>
	</form>
</body>
</html>

