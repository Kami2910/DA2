
<?php
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Chi Tiết Dự Án & Phân Công</title>
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
          <ul class="nospace inline pushright">
          </ul>
          <div class="image">
            <a href="#"><img src="assets/images/hi.png" alt="" /></a>
          </div>
          <div class="author-content">
            <h4>Reflux Me</h4>
            <span>Web Designer</span>
          </div>
          <nav class="main-nav" role="navigation">
           
            <ul class="nospace inline pushright">
          </ul>
          </nav>
        </div>
      </div>
    </div>
<!--update Dự Án lỗi--> 
<?php
                    $ma = $_GET['da_id'];
                    $sql = $conn -> query("SELECT *
                    FROM duan da
                    WHERE da.DA_MaDuAn ='$ma'");
                    while ($row = $sql -> fetch_assoc()):
                    ?>

<section style="color:red; font-weight:bold; font-size: 20px; text-align:center;"><?=isset($alert)?$alert:""?></section>
    <section class="section about-me" data-section="section1">
    <div class="section-heading">
          <h2>Dự Án</h2>
          <div class="line-dec"></div>
        </div>
               <div class="row justify-content-center">
               
    	<form action="editDA.php" method="POST" style="border-style: solid; border-radius: 25px; border-size:500px;width:500px ;position:relative;top:-20px;">
      
      <h4 style="color:white;position:relative;left:210px;"  >Dự Án</h4>
                            <table class="table table-bordered" id="DUAN" width="100%" cellspacing="100%">
                                <tr>
                                    <th  style="color:#4d4d33;">Mã Dự Án </th>
                                    <th  style="color:#4d4d33;">Tên Dự Án</th>
                                    <th  style="color:#4d4d33;">Hạn Chót</th>
                                </tr>
                                <tr>
                                    <th><?php echo $_GET['da_id']?></th>
                                    <th><?php echo $row['DA_TenDuAn']?></th>
                                    <th><?php echo $row['DA_HanChotDA']?></th>
                                </tr>
                            </table>
			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Mã Dự Án</label> </div>
				  <div style= "width:70%"> <input type="text" name="DA_MaDuAn" class="form-control" placeholder ="Nhập vào mã dự án của bạn" value="<?php echo $_GET["da_id"] ?>" readonly="readonly" style =" border-radius: 25px;" ></div>
			  </div>

			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Tên Dự Án</label> </div>
				  <div style= "width:70%"> <input type="text" name="DA_TenDuAn" class="form-control" placeholder ="Nhập vào tên dự án của bạn" value="<?php echo $row['DA_TenDuAn'];?>" style =" border-radius: 25px;"></div>
			  </div>
			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Hạn Chót</label> </div>
				  <div style= "width:70%"> <input type="date" name="DA_HanChotDA" class="form-control" value ="<?php echo $row['DA_HanChotDA']?>"style =" border-radius: 25px;"></div> 
			  </div>
<!-- NÚT CHỈNH SỬA -->
  			 <div style="text-align: center;"><button  type="submit" class="btn btn-danger" name="save" style =" border-radius: 25px; , color:#4d4d33;">Chỉnh Sửa Dự Án</button></div>
    	</form>
      </div>
    </section>
<?php endwhile?>

    <section class="section contact-me" data-section="section4">
      <div class="container">
        <div class="section-heading">
          <h2>Công Việc Trong Dự Án</h2>
          <div class="line-dec"></div>
        </div>
        <div class="row">
          <div class="right-content">
            <div class="container">
              
              <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%" style="position:relative;left:160px; position:relative;top:-30px; ">
                <tr>
                  <th style="color:#4d4d33;  background-color: #ddd;">STT</th>
                  <th style="color:#4d4d33; ">Tên Công Việc</th>
                  <th style="color:#4d4d33; background-color: #ddd;">Trạng Thái</th>
                  <th style="color:#4d4d33;  ">Vai Trò</th>
                </tr>
                <?php
                    $STT = 1;
                    $sql = $conn -> query("SELECT da.DA_TenDuAn, cv.CV_TenCongViec, pc.PC_TrangThai, vt.VT_TenVaiTro
                    FROM thongtincanhan tt, thanhvien tv, phancong pc, congviec cv, vaitro vt, duan da
                    WHERE tt.TTCN_MaTTCN = tv.TV_MaTTCN 
                        AND tv.TV_MaThanhVien = pc.PC_MaThanhVien 
                        AND pc.PC_MaCongViec = cv.CV_MaCongViec 
                        AND pc.PC_MaVaiTro = vt.VT_MaVaiTro 
                        AND da.DA_MaDuAn = pc.PC_MaDuAn AND tt.TTCN__TenDN = '$dulieunhan'");
                    
                    while ($row = $sql -> fetch_assoc()):?>
            
                    <tr>
                      <td><?php echo $STT++;?></td>
                      <td><?php echo $row['CV_TenCongViec'];?></td>
                      <td><?php echo $row['PC_TrangThai'];?></td>
                      <td><?php echo $row['VT_TenVaiTro'];?></td>
                    </tr>
                    <?php endwhile?>
              </table>
            </div>
          </div>
        </div>
    
        <div class="row justify-content-center">
        <!-- THÊM CÔNG VIỆC        -->
    	<form action="createCV.php" method="POST" style="border-style: solid; border-radius: 25px; border-size:500px;width:500px">
  
			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Mã Công Việc</label> </div>
				  <div style= "width:70%"> <input type="text" name="CV_MaCongViec" class="form-control" placeholder ="Nhập vào mã cv của bạn" value="" style =" border-radius: 25px;"></div>
			  </div>

			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Tên Công Việc</label> </div>
				  <div style= "width:70%"> <input type="text" name="CV_TenCongViec" class="form-control" placeholder ="Nhập vào tên cv của bạn" value="" style =" border-radius: 25px;"></div>
			  </div>
			 
<!-- NÚT THÊM -->
  			 <div style="text-align: center;"><button  type="submit" class="btn btn-danger" name="themcv" style =" border-radius: 25px;">Thêm Công Việc</button></div>
    	</form>

        <?php
            if(isset($_POST['themcv'])){
                $MaCV = $_POST['CV_MaCongViec'];
                $TenCV = $_POST ['CV_TenCongViec'];
            
                $MaDA =  $_GET["da_id"];
                    if($MaCV && $TenCV){
                        $conn->query("INSERT INTO congviec(CV_MaCongViec, CV_TenCongViec) VALUES ('$MaCV','$TenCV')") or die ($conn->error);       
                        $conn->query("INSERT INTO phancong(PC_MaDuAn, PC_MaThanhVien, PC_MaCongViec, PC_MaVaiTro, PC_HanChot) VALUES ('$MaDA','','$MaCV','','')") or die ($conn->error);     
                    }
                    else {
                        echo "<script> alert ('Vui lòng nhập đủ các thông tin') </script>";
                        echo"<script> location.replace('thongtinduan.php')</script>";
                    }

            }

        ?>
      </div>

      </div>
    </section>
                                               <!-- SECTION 3 -->
    <section class="section my-work" data-section="section3">
    <div class="container">
        <div class="section-heading">
          <h2>PHÂN CÔNG</h2>
          <p>phần này cô nói cô chỉ, bảng này t để tạm, ko liên quan tới, còn bạn bà mà có biết thì nhờ chỉ làm giùm luôn củm được hihi</p>
          <div class="line-dec"></div>
        </div>
        <div class="row">
          <div class="right-content">
            <div class="container">
              
              <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%" style="position:relative;left:160px; position:relative;top:-30px; ">
                <tr>
                  <th style="color:#4d4d33;  background-color: #ddd;">STT</th>
                  <th style="color:#4d4d33; ">Tên Dự Án</th>
                  <th style="color:#4d4d33;  background-color: #ddd;">Tên Công Việc</th>
                  <th style="color:#4d4d33;">Trạng Thái</th>
                  <th style="color:#4d4d33;  background-color: #ddd;">Vai Trò</th>
                </tr>
                <?php
                    $STT = 1;
                    $sql = $conn -> query("SELECT da.DA_TenDuAn, cv.CV_TenCongViec, pc.PC_TrangThai, vt.VT_TenVaiTro
                    FROM thongtincanhan tt, thanhvien tv, phancong pc, congviec cv, vaitro vt, duan da
                    WHERE tt.TTCN_MaTTCN = tv.TV_MaTTCN 
                        AND tv.TV_MaThanhVien = pc.PC_MaThanhVien 
                        AND pc.PC_MaCongViec = cv.CV_MaCongViec 
                        AND pc.PC_MaVaiTro = vt.VT_MaVaiTro 
                        AND da.DA_MaDuAn = pc.PC_MaDuAn AND tt.TTCN__TenDN = '$dulieunhan'");
                    
                    while ($row = $sql -> fetch_assoc()):?>
            
                    <tr>
                      <td><?php echo $STT++;?></td>
                      <td><?php echo $row['DA_TenDuAn'];?></td>
                      <td><?php echo $row['CV_TenCongViec'];?></td>
                      <td><?php echo $row['PC_TrangThai'];?></td>
                      <td><?php echo $row['VT_TenVaiTro'];?></td>
                    </tr>
                    <?php endwhile?>
              </table>
            </div>
          </div>
        </div>
    
        <div class="row justify-content-center">
        <!-- THÊM CÔNG VIỆC        -->
    	<form action="createCV.php" method="POST" style="border-style: solid; border-radius: 25px; border-size:500px;width:500px">
  
			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Mã Công Việc</label> </div>
				  <div style= "width:70%"> <input type="text" name="CV_MaCongViec" class="form-control" placeholder ="Nhập vào mã cv của bạn" value="" style =" border-radius: 25px;"></div>
			  </div>

			  <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Tên Công Việc</label> </div>
				  <div style= "width:70%"> <input type="text" name="CV_TenCongViec" class="form-control" placeholder ="Nhập vào tên cv của bạn" value="" style =" border-radius: 25px;"></div>
			  </div>

        <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Tên Thành Viên</label> </div>
				  <div style= "width:70%"> <input type="" name="CV_TenCongViec" class="form-control" placeholder ="Nhập vào tên tv" value="" style =" border-radius: 25px;"></div>
			  </div>

        <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Hạn Chót</label> </div>
				  <div style= "width:70%"> <input type="date" name="CV_TenCongViec" class="form-control" placeholder ="Nhập vào hạn chót" value="" style =" border-radius: 25px;"></div>
			  </div>
			  
        <div class="form-group" style="display:flex">
				  <div style= "width:30%"> <label style="color:#4d4d33;">Vai Trò</label> </div>
				  <div style= "width:70%"> <input type="text" name="CV_TenCongViec" class="form-control" placeholder ="Nhập vào hạn chót" value="" style =" border-radius: 25px;"></div>
			  </div>
<!-- NÚT THÊM -->
  			 <div style="text-align: center;"><button  type="submit" class="btn btn-danger" name="themcv" style =" border-radius: 25px;">Thêm Công Việc</button></div>
    	</form>

        <?php
            if(isset($_POST['themcv'])){
                $MaCV = $_POST['CV_MaCongViec'];
                $TenCV = $_POST ['CV_TenCongViec'];
            
                $MaDA =  $_GET["da_id"];
                    if($MaCV && $TenCV){
                        $conn->query("INSERT INTO congviec(CV_MaCongViec, CV_TenCongViec) VALUES ('$MaCV','$TenCV')") or die ($conn->error);       
                        $conn->query("INSERT INTO phancong(PC_MaDuAn, PC_MaThanhVien, PC_MaCongViec, PC_MaVaiTro, PC_HanChot) VALUES ('$MaDA','','$MaCV','','')") or die ($conn->error);     
                    }
                    else {
                        echo "<script> alert ('Vui lòng nhập đủ các thông tin') </script>";
                        echo"<script> location.replace('thongtinduan.php')</script>";
                    }

            }

        ?>
      </div>

      </div>
    </section>

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