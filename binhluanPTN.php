<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanliduan";
session_start();
$dulieunhan = isset($_SESSION['dulieugui']) ? $_SESSION['dulieugui'] :''; 
// tạo connection
$id = $_GET['id'];
$cv = "";
if (isset($_GET['cv'])){
  $cv = $_GET['cv'];
}
$conn = new mysqli($servername, $username, $password, $dbname);
// kiểm connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$mathanhvien = $conn->query("SELECT TTCN_MaTTCN FROM thongtincanhan WHERE TTCN__TenDN = '$dulieunhan'");
$rowtv = $mathanhvien->fetch_assoc();
if (isset($_POST['binhluan'])) {
  $noidung = $_POST['bl'];
  $macongviec = $_GET['cv'];
  $matv = $rowtv['TTCN_MaTTCN'];
  $thembl = $conn->query("INSERT INTO binhluan( BL_NoiDung, BL_MaCongViec, BL_MaThanhVien, BL_MaDuAn) 
                          VALUES ('$noidung','$macongviec','$matv','$id')");
  if ($thembl) {
    echo "<script> alert('Thành công')</script>";
    echo "<script>
          location.href = './QLDA_PTN.php?id=$id';
        </script>";
  }
  else {
    echo "<script> alert('Thất bại')</script>";
  } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tư cách phó trưởng nhóm</title>
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
<?php require_once 'edit.php';?>
  <div id="page-wraper">
    <!-- Sidebar Menu -->
    <div class="responsive-nav">
      <i class="fa fa-bars" id="menu-toggle"></i>
      <div id="menu" class="menu" style="background: #DCDCDC;">
        <i class="fa fa-times" id="menu-close"></i>
        <div class="container">
          <ul class="nospace inline pushright"></ul>
          <div class="image"><a href="#"><img src="assets/images/author-image.jpg" alt=""/></a></div>
            <div class="author-content">
              <h4>Reflux Me</h4>
              <span>Web Designer</span>
            </div>
            <nav class="main-nav" role="navigation">
                <ul class="main-menu">
                  <li><a href="#section1">CHI TIẾT CÔNG VIỆC</a></li>
                  <li><a href="#section2">BÌNH LUẬN</a></li>
                </ul>
            </nav>
        </div>
      </div>
    </div>
                                                               <!-- SECTION 1 -->
    <section class="section about-me" data-section="section1">
      <div class="container">
            <div class="section-heading">
              <h2 style="color: White;" >VICE-LEADER TEAM</h2>
              <div class="line-dec"></div>
            </div>
            <div class="right-text">
              <h4 style="color: yellow; text-align: center;">CHI TIẾT CÔNG VIỆC</h4>
              <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%">
                <tr>
                  <th>STT</th>
                  <th>Tên Công Việc</th>
                  <th>Bình Luận Bởi</th>
                  <th>Vai Trò</th>
                  <th>Thời gian kết thúc</th>
                  <th>Nội dung bình luận</th>
                </tr>
                <tr>
                <?php
                $maduan = $_GET['id'];
                $macv = $_GET['cv'];
                $sql = $conn->query("SELECT BL_MaThanhVien,BL_MaCongViec,TTCN__TenDN,DA_TenDuAn ,VT_TenVaiTro,CV_MaCongViec,CV_TenCongViec, PC_TrangThai,PC_HanChot, BL_NoiDung FROM phancong p 
                join duan da on p.PC_MaDuAn = da.DA_MaDuAn join vaitro v on p.PC_MaVaiTro = v.VT_MaVaiTro 
                join congviec c ON p.PC_MaCongViec = c.CV_MaCongViec 
                join thongtincanhan tt on p.PC_MaTTCN = tt.TTCN_MaTTCN 
                join binhluan bl on da.DA_MaDuAn = bl.BL_MaDuAn
                WHERE PC_MaDuAn = '$maduan' AND TTCN__TenDN = '$dulieunhan' AND BL_MaCongViec = '$macv'");
                $sqli = $conn->query("SELECT CV_TenCongViec FROM congviec WHERE CV_MaCongViec = '$macv'");
                $row1 = $sqli->fetch_assoc();
               
                    $STT = 1;
                    while ($row = $sql->fetch_assoc()):
                        $matv = $row['BL_MaThanhVien'];
                        $sqli2 = $conn->query("SELECT TTCN__TenDN FROM thongtincanhan WHERE TTCN_MaTTCN = '$matv'");
                        $row2 = $sqli2->fetch_assoc();
                        $sqli3 = $conn->query("SELECT VT_TenVaiTro FROM vaitro join phancong on vaitro.VT_MaVaiTro = phancong.PC_MaVaiTro WHERE PC_MaTTCN = '$matv'");
                        $row3 = $sqli3->fetch_assoc();
                ?>
                 <td>
                    <input type="hidden" name="STT" VALUE="<?php echo $STT?>">
                    <?php echo $STT;?>
                  </td>
                  <th><?php echo $row1['CV_TenCongViec']?></th>
                  <th><?php echo $row2['TTCN__TenDN']?></th>
                  <th><?php echo $row3['VT_TenVaiTro']?></th>
                  <th><?php echo $row['PC_HanChot']?></th>
                  <th><?php echo $row['BL_NoiDung']?></th>
                </tr>
              <?php $STT+=1;
                    endwhile?>
              </table>
            </div>
      </div>
    </section>
                                                                <!-- SECTION 2 -->
    <section class="section my-services" data-section="section2">
      <div class="container">
        <div class="section-heading">
           <h2>BÌNH LUẬN</h2>
           <p>Viết Bình Luận Của Bạn</p>
           <div class="line-dec"></div>
        </div>
        <form action="" method="POST" style="border-style: solid; border-radius: 25px; border-size:500px;width:450px ;position:relative;top:-20px; position:relative;left:230px;"> 
              <p style ="font-size:20px ; color:yellow"></p>
                <?php 
                $congviec = $conn->query("SELECT * FROM congviec WHERE CV_MaCongViec = '$cv'");
                $rowCV = $congviec->fetch_assoc();
                ?>
                <div class="form-group" style="display:flex">
                  <div style= " color:#4d4d33; width:30% ;position:relative;left:10px;"> <label>Tên Công Việc</label></div>
                  <div style= " width:70%;position:relative;left:30px;" > <input disabled style =" border-radius: 25px;" type="text" name="tencv" value = "<?php echo $rowCV['CV_TenCongViec']?>"></div>
                </div>

                <div class="form-group" style="display:flex">
                  <div style= "color:#4d4d33;width:30%;position:relative;left:10px;">  <label>Bình Luận</label></div>
                  <div style= "width:70%;position:relative;left:30px;">  <input style =" border-radius: 25px;" type="text" name="bl" value =""></div>
                </div>

                <div style="text-align: center;position:relative;left:30px;"><button style =" border-radius: 25px;"  type="submit" class="btn btn-danger" name="binhluan">Bình luận</button></div>
        </form>
      </div>
    </section>
                                                                <!-- SECTION 3 -->
    
    </form>
  </div>

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
        $(".section").each(function() {
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

      $(".main-menu").on("click", "a", function(e) {
        e.preventDefault();
        showSection($(this).attr("href"), true);
      });

      $(window).scroll(function() {
        checkSection();
      });
    </script>
</body>

</html>
