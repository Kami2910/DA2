<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanliduan";
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);
$dulieunhan = isset($_SESSION['dulieugui']) ? $_SESSION['dulieugui'] : '';
$id = $_GET['id'];
$cv = $_GET['cv'];
$vt = $_GET['vt'];
$thongtincanhan = $conn->query("SELECT * FROM thongtincanhan WHERE TTCN__TenDN NOT LIKE '$dulieunhan'");
$vaitro = $conn->query("SELECT * FROM `vaitro` WHERE `VT_MaVaiTro` NOT LIKE 'TN'");
if(isset($_POST['phancong'])) {
  $mathanhvien = $_POST['thanhvien'];
  $vaitro = $_POST['vaitro'];
  $phancong = $conn->query("UPDATE `phancong` SET `PC_MaTTCN`='$mathanhvien',`PC_MaVaiTro`='$vaitro' WHERE `PC_MaDuAn` = '$id' AND `PC_MaCongViec` = '$cv'");
  if ($phancong) {
    echo "<script> alert('Thành công')</script>";
    if ($vt == "PTN") {
      echo "<script>
          location.href = './QLDA_PTN.php?id=$id';
        </script>";
    }
    else {
      echo "<script>
          location.href = './QLDA_TN.php?id=$id';
        </script>";
    }
    
  }
  else {
    echo "<script> alert('Thất bại')</script>";
    
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PHÂN CÔNG</title>
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
                  <li><a href="#section1">GIAO VIỆC</a></li>
                  
                </ul>
            </nav>
        </div>
      </div>
    </div>
                                                               <!-- SECTION 1 -->
    <section class="section about-me" data-section="section1">
      <div class="container">
            <div class="section-heading">
              <h2 style="color: White;" >PHÂN CÔNG</h2>
              <div class="line-dec"></div>
            </div>
            <div class="right-text">
              
              <form action="" method="POST" style=" border-style: solid; border-size:500px;width:500px;position:relative;left:230px; border-radius: 25px;">
                <p style ="font-size:20px ; color:yellow"></p>

                  <div class="form-group" style="display:flex">
                    <div style= "width:30%"> <label>Tên Thành Viên</label> </div>
                    <div style= "width:70%"> 
                    <select style =" border-radius: 25px; width: 190px;" name="thanhvien" id="" class="form-control" required="required">
                      <?php foreach ($thongtincanhan as $key => $value) {?>
                      
                        <option  value="<?php echo $value['TTCN_MaTTCN']?>"><?php echo $value['TTCN__TenDN']?></option>
                      <?php }?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group" style="display:flex">
                    <div style= "width:30%"> <label>Vai Trò</label> </div>
                  <select style =" border-radius: 25px; width: 190px;" name="vaitro" id="" class="form-control" required="required">  
                    <?php foreach ($vaitro as $key => $value) {?>
                      
                        <option  value="<?php echo $value['VT_MaVaiTro']?>"><?php echo $value['VT_TenVaiTro']?></option>
                      <?php }?>
                    </select>
                  </div>

                 <div style="text-align: center;"><button style =" border-radius: 25px;" type="submit" class="btn btn-info" name="phancong">Phân Công</button></div>

              </form>  
            </div>
      </div>
    </section>
                                             
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