<?php
session_start();
if(isset($_POST['submit'])){
    //nếu có sự kiện click vào nút đăng nhập thì xử lý
    
    $username = $_POST['email'];
    //txtName là tên của input người dùng nhập vào
    
    $password = $_POST['password'];
    //txtPass là tên của input người dùng nhập vào
    
    if($username == 'admin' && $password == '123456'){
        $result = 'Bạn đã đăng nhập thành công';
        $_SESSION['us'] = $username;
    }else{
        $result = 'Người dùng này không tồn tại.';
    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Đăng nhập</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
	<form action="controller.php" method ="post" class="form" id="form-1" enctype="multipart/form-data">
    	<h3 class="heading">ĐĂNG NHẬP</h3>
    	<img alt="Login-heading" src="../images/login-heading.png" >
    	
    	<div class="form-group">
			<i class="fas fa-user icon"></i>
    		<input id="email" name="email" type="text" placeholder="username" class="input-field">
        	<span class="form-message"></span>
    	</div>
    	
    	<div class="form-group">
    		<i class="fa fa-key icon"> </i>
    		<input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="input-field">
    		<span class="form-message"></span>
    	</div>
    	<input type="submit" name ="submit" value="Đăng nhập">
    	
    	<div class="sign">
    		<a href="">Đăng ký</a>
    		<span> - </span>
    		<a href="">Quên mật khẩu</a>
    	</div>
    	<p class="form-message"><?php echo $result?></p>
	</form>
</body>
</html>

