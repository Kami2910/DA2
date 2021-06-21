<?php
$servername = "localhost";
$database = "quanliduan";
$username = "root";
$password = "";
$conn = mysqli_connect("localhost", "root","","quanliduan") or die("KhÃƒÂ´ng thÃ¡Â»Æ’ kÃ¡ÂºÂ¿t nÃ¡Â»â€˜i CSDL");
session_start();

    $username = $_SESSION['username'];
    $sql = "SELECT * FROM thongtincanhan";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==0)
    {
       
    }
    else {
        while ($row = mysqli_fetch_array($result))
        {
            if ($username==$row[1]){
                $index = $row[0];
                $name = $row[1];
                $email = $row[2];
                $phone = $row[3];
                $sex = $row[4];
                if ($sex==0){
                    $value = "Nữ";
                }
                else {
                    $value = "Nam";
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link
      href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900"
      rel="stylesheet"
    />

    <title>ABOUT</title>
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
        <div id="menu" class="menu" style="background: #2BAEDB">
          <i class="fa fa-times" id="menu-close"></i>
          <div class="container">
            <div class="image">
            <div class="fl_left">
          <ul class="nospace inline pushright">
            <li>
            <button type="submit" id="form-submit" class="button" >
                        <a href="logout.php">ĐĂNG XUẤT</a>
            </li>
            
          </ul>
        </div >
              <a href="#"><img src="https://images.unsplash.com/photo-1572177812156-58036aae439c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80" alt="" /></a>
            </div>
            <div class="author-content">
              <h4 style="color: white;">About</h4>
              <span><?php echo $name?></span>
            </div>
            <nav class="main-nav" role="navigation">
              <ul class="main-menu">
                <li><a href="#section1">Quản Lý Thông Tin Cá Nhân</a></li>
                <li><a href="#section2">Quản Lý Dự Án</a></li>
                <li><a href="#section3">Tạo Dự Án</a></li>
                <li><a href="#section4">Công Việc Của Tôi</a></li>
              </ul>
              
            </nav>
            
           
          </div>
        </div>
      </div>

      <section class="section about-me" data-section="section1">
        <div class="container">
          <div class="section-heading">
            <h2 style="color: White;" >About Me</h2>
            <p style="font-size: 20px;">Contact me </p>
            
          </div>
          <!-- <div class="left-image-post"> -->
            <div class="row">
              <!-- <div class="col-md-6">
                <div class="left-image">
                  <img src="assets/images/left-image.jpg" alt="" />
                </div>
              </div> -->
              <div class="col-md-6">
                 <div class="right-text">
                  <h4 style="color: yellow;" >Bảng Thông Tin Cá Nhân</h4>
                <table class="table table-bordered" id="TTCN" width ="100%" cellspacing="100%">
                  <tr>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Giới tính</th>
                  </tr>
                  <tr>
                    <th><?php echo $name?></th>
                    <th><?php echo $email?></th>
                    <th><?php echo $phone?></th>
                    <th><?php echo $value?></th>
                  </tr>
                </table>
                  <div class="white-button">
                    <a href="#">Sửa</a>
                     <a href="#">Lưu</a>
                  </div>
                </div>
               
              </div>
            </div>
            
          <!-- </div> -->
          <!-- <div class="right-image-post"> -->
           
            </div>
          <!-- </div> -->
        </div>
        </section>

        <section class="section contact-me" data-section="section4">
        <div class="container">
          <div class="section-heading">
            <h2 style="color: White;" >About Me</h2>
            <p style="font-size: 20px;">Contact me </p>
            
          </div>
          <!-- <div class="left-image-post"> -->
            <div class="row">
              <!-- <div class="col-md-6">
                <div class="left-image">
                  <img src="assets/images/left-image.jpg" alt="" />
                </div>
              </div> -->
              <div class="col-md-6">
                 <div class="right-text">
                  <h4 style="color: yellow;" >Bảng Thông Tin Cá Nhân</h4>
                <table class="table table-bordered" id="TTCN" width ="100%" cellspacing="100%">
                  <tr>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Giới tính</th>
                  </tr>
                  <tr>
                    <th><?php echo $name?></th>
                    <th><?php echo $email?></th>
                    <th><?php echo $phone?></th>
                    <th><?php echo $value?></th>
                  </tr>
                </table>
                  <div class="white-button">
                    <a href="#">Sửa</a>
                     <a href="#">Lưu</a>
                  </div>
                </div>
               
              </div>
            </div>
            
          <!-- </div> -->
          <!-- <div class="right-image-post"> -->
           
            </div>
          <!-- </div> -->
        </div>
        </section>
     
              
    
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