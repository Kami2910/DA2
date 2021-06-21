
<?php
//thanh làm
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanliduan";
session_start();
$dulieunhan = isset($_SESSION['dulieugui']) ? $_SESSION['dulieugui'] :''; 
// tạo connection

$conn = new mysqli($servername, $username, $password, $dbname);
// kiểm connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$duan = mysqli_query($conn, "SELECT * FROM duan");
$congviec = mysqli_query($conn, "SELECT * FROM `congviec` WHERE `CV_TenCongViec` LIKE 'Tạo dự án' ORDER BY `CV_MaCongViec` ASC");
$vaitro = mysqli_query($conn, "SELECT * FROM `vaitro` WHERE `VT_MaVaiTro` LIKE 'TN' ORDER BY `VT_MaVaiTro` ASC");
$thanhvien = mysqli_query($conn, "SELECT * FROM thongtincanhan WHERE `TTCN__TenDN` LIKE '$dulieunhan' ORDER BY `TTCN_MaTTCN` ASC");
$row = mysqli_fetch_array($thanhvien);
$cv = mysqli_fetch_array($congviec);
if(isset($_POST['save'])) {
    $maduan = $_POST['DA_MaDuAn'];
    $tenduan = $_POST['DA_TenDuAn'];
    $hanchot = $_POST['DA_HanChotDA'];
    $mathanhvien = $row['TTCN_MaTTCN'];
    $trangthai = "Chua hoan tat";
    $role = "TN";

    $sql = "INSERT INTO duan (DA_MaDuAn , DA_TenDuAn , DA_HanChotDA ) VALUES ('$maduan','$tenduan','$hanchot')";
    $sqli = "INSERT INTO phancong (PC_MaDuAn , PC_MaTTCN , PC_TrangThai, PC_MaVaiTro, PC_HanChot ) 
              VALUES ('$maduan','$mathanhvien','$trangthai','$role','$hanchot')";
    if($maduan!="" && $tenduan!="" && $hanchot!=""){
      $sql = "INSERT INTO duan (DA_MaDuAn , DA_TenDuAn , DA_HanChotDA ) VALUES ('$maduan','$tenduan','$hanchot')";
      
      
      $connect1 = mysqli_query($conn,$sql);
      if ($connect1){
        $sqli = "INSERT INTO phancong (PC_MaDuAn , PC_MaTTCN , PC_TrangThai, PC_MaVaiTro, PC_HanChot )
                VALUES ('$maduan','$mathanhvien','$trangthai','$role','$hanchot')";
        $connect2 = mysqli_query($conn,$sqli);
        echo "<script> alert('Thêm thành công')</script>";
        echo "<script>
                location.replace('taoduan.php');
              </script>";
      }
      else {
        echo "<script> alert ('Mã dự án đã tồn tại') </script>";
        echo"<script> location.replace('taoduan.php')</script>";
  //       else {
  //         echo "<script> alert('Đã tồn tại dự án này')</script>";     
  // }  
      } 
    }
    else {
      echo "<script> alert('Vui lòng nhập đủ các thông tin')</script>";
      echo "<script>
              location.replace('taoduan.php');
            </script>";
    }
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Tạo Dự Án</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet" />
  <!--
Reflux Template
https://templatemo.com/tm-531-reflux
-->
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css" />
  <link rel="stylesheet" href="assets/css/templatemo-style.css" />
  <link rel="stylesheet" href="assets/css/owl.css" />
  <link rel="stylesheet" href="assets/css/lightbox.css" />
</head>

<body>

  <div id="page-wraper">
    <!-- Sidebar Menu -->
    <div class="responsive-nav">
      <i class="fa fa-bars" id="menu-toggle"></i>
      <div id="menu" class="menu" style="background: #DCDCDC;">
        <i class="fa fa-times" id="menu-close"></i>
        <div class="container">
          <ul class="nospace inline pushright"></ul>
          <div class="image">
            <a href="#"><img src="assets/images/hi.png" alt="" /></a>
          </div>
          <div class="author-content">
          <h4><?php echo $dulieunhan ?></h4>
            <span>Web Designer</span>
          </div>
            <nav class="main-nav" role="navigation">
              <ul class="nospace inline pushright">
                <li>
                <a href="./first.php">Trang Chủ</a>
                </li>
              </ul>
            </nav>
        </div>
      </div>
    </div>
<!--Tạo Dự Án -->
<section style="color:red; font-weight:bold; font-size: 20px; text-align:center;"><?=isset($alert)?$alert:""?></section>
    <section class="section about-me" data-section="section1">
    	    	 	<h2 class="row justify-content-center" style="color: white;" >CÁC DỰ ÁN HIỆN TẠI</h2>
               <?php require_once 'createDA.php';?>
               <?php
                $mysqli = new mysqli('localhost','root','','quanliduan') or die (mysqli_error($mysqli));

                $result = $mysqli->query("SELECT * FROM duan") or die ($mysqli->error);
                ?>
                <div class ="row justify-content-center">
                <table class ="table">
                  <thead>
                    <tr> 
                      <th style="color:#4d4d33;">Mã Dự Án</th>
                      <th style="color:#4d4d33;">Tên Dự Án</th>
                      <th style="color:#4d4d33;">Hạn Chót Dự Án</th>
                    </tr>
                  </thead>
                  <?php 
                  while ($row = $result->fetch_assoc()): 
                  ?>
                  <tr>
                    <td><?php echo $row['DA_MaDuAn']?></td>
                    <td><?php echo $row['DA_TenDuAn']?></td>
                    <td><?php echo $row['DA_HanChotDA']?></td>
                  </tr>
                        <?php endwhile;?>
                </table>
                </div>
                <?php
              
                function pre_r($array){
                  echo '<pre>';
                  print_r($array);
                  echo '</pre>';
                }
                ?>
               <div class="row justify-content-center">
               
    	<form action="" method="POST" style="border-style: solid; border-radius: 25px; border-size:500px;width:500px">
  
			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Mã Dự Án</label> </div>
				  <div style= "width:70%"> <input type="text" name="DA_MaDuAn" class="form-control" placeholder ="Nhập vào mã dự án của bạn" style =" border-radius: 25px;"></div>
			  </div>

			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Tên Dự Án</label> </div>
				  <div style= "width:70%"> <input type="text" name="DA_TenDuAn" class="form-control" placeholder ="Nhập vào tên dự án của bạn" style =" border-radius: 25px;"></div>
			  </div>
			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Hạn Chót</label> </div>
				  <div style= "width:70%"> <input type="date" name="DA_HanChotDA" class="form-control" value =""style =" border-radius: 25px;"></div>
			  </div>
<!-- NÚT THÊM -->
  			 <div style="text-align: center;"><button  type="submit" class="btn btn-danger" name="save" style =" border-radius: 25px;">Tạo Dự Án</button></div>
    	</form>
      </div>
    </section>

    <section class="section my-services" data-section="section2"></section>

    <section class="section my-work" data-section="section3"></section>

    <section class="section contact-me" data-section="section4"></section>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/lightbox.js"></script>
  <script src="assets/js/custom.js"></script>
  <script>
    //according to loftblog tut
    $(".main-menu li:first").addClass("active");

    var showSection = function showSection(section, isAnimate) {
      var direction = section.replace(/#/, ""),
        reqSection = $(".section").filter(
          '[data-section="' + direction + '"]'
        ),
        reqSectionPos = reqSection.offset().top - 0;

      if (isAnimate) {
        $("body, html").animate(
          {
            scrollTop: reqSectionPos
          },
          800
        );
      } else {
        $("body, html").scrollTop(reqSectionPos);
      }
    };

    var checkSection = function checkSection() {
      $(".section").each(function () {
        var $this = $(this),
          topEdge = $this.offset().top - 80,
          bottomEdge = topEdge + $this.height(),
          wScroll = $(window).scrollTop();
        if (topEdge < wScroll && bottomEdge > wScroll) {
          var currentId = $this.data("section"),
            reqLink = $("a").filter("[href*=\\#" + currentId + "]");
          reqLink
            .closest("li")
            .addClass("active")
            .siblings()
            .removeClass("active");
        }
      });
    };

    $(".main-menu").on("click", "a", function (e) {
      e.preventDefault();
      showSection($(this).attr("href"), true);
    });

    $(window).scroll(function () {
      checkSection();
    });
  </script>
</body>

</html>