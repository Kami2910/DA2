<?php
   include 'config.php';
   if( isset($_POST['submit']) && $_POST["usernamr"] != '' && $_POST["password"] != '' && $_POST["fullname"] != '' && $_POST["email"] != '' && $_POST["phonenumber"] != '' && $_POST["sex"] != ''  )
   {
       //Thực hiện xử lý khi người dùng ấn nút submit và điền đầy đủ thông tin 
       $username = $_POST["username"];
       $password = $_POST["password"];
       $repassword = $_POST["repassword"];
       $fullname = $_POST["fullname"];
       $email = $_POST["email"];
       $phonenumber = $_POST["phonenumber"];
       $sex = $_POST["gender"];
       $level = 0;
       
       if( $password != $repassword){
           header("location:dky.php");
       }
       $sql = "SELECT * FORM user WHERE username='$username'";
       $old = mysqli_query($conn,$sql);
       $password = md5($password);
       if( mysqli_num_rows($old) > 0 ){
           header("location:dky.php");
       }
       $sql = "INSERT INTO user  ( username,password,fullname,email,phonenumber,sex,level) VALUES ('$username','$password','$fullname','$email','$phonenumber','$sex','$level') ";
       mysqli_query($conn,$sql);
       echo "Đã đăng ký thành công";
   }else {
       header("location:dky.php");
   }
?>