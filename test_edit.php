
<?php
$conn = mysqli_connect("localhost", "root","","quanliduan") or die("Không thể kết nối CSDL") ;
session_start();

    $username = $_SESSION['username'];
    $sql = "SELECT * FROM thongtincanhan WHERE TTCN__TenDN = '$username'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==0)
    {
       
    }
    else {
        while ($row = mysqli_fetch_assoc($result))
        {
            if ($username==$row['TTCN__TenDN']){
                $name = $row['TTCN__TenDN'];
                $MaTTCN = $row['TTCN_MaTTCN'];
                $email = $row['TTCN__Email'];
                $phone = $row['TTCN__Sdt'];
                $sex = $row['TTCN__GioiTinh'];
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
<html lang="en">

<head>
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
      <div id="menu" class="menu" style="background: #2BAEDB">
        <i class="fa fa-times" id="menu-close"></i>
        <div class="container">
          <ul class="nospace inline pushright">
          </ul>
          <div class="image">
            <a href="#"><img src="assets/images/author-image.jpg" alt="" /></a>
          </div>
          <div class="author-content">
            <h4>Reflux Me</h4>
            <span>Web Designer</span>
          </div>
          <nav class="main-nav" role="navigation">
            <ul class="main-menu">
              <li><a href="#section1">QUẢN LÝ THÔNG TIN CÁ NHÂN</a></li>
              <li><a href="#section2">QUẢN LÝ DỰ ÁN</a></li>
              <li><a href="#section3">TẠO DỰ ÁN</a></li>
              <li><a href="#section4">CÔNG VIỆC CỦA TÔI</a></li>
            </ul>
            <ul class="nospace inline pushright">
            <li>
                        <a href="logout.php">ĐĂNG XUẤT</a>
            </li>
            
          </ul>
          </nav>
        </div>
      </div>
    </div>

    <section class="section about-me" data-section="section1">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="section-heading">
              <h2 style="color: White;" >About Me</h2>
              <p style="font-size: 20px;">Contact me </p>
              <div class="line-dec"></div>
            </div>
                            <div class="right-text">
                                <h4 style="color: yellow;">Bảng Thông Tin Cá Nhân</h4>
                                <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%">
                                    <tr>
                                    <th>Tên đăng nhập</th>
                                    <th>Email</th>
                                    <th>SĐT</th>
                                    <th>Giới tính</th>
                                  
                                    </tr>
                                    <tr>
                                    <th><?php echo $name;?></th>
                                    <th><?php echo $email;?></th>
                                    <th><?php echo $phone;?></th>
                                    <th><?php echo $value;?></th>
                                    
                                    </tr>
                                </table>
                            </div>
                    </form>
                </div>        
          </div>
        </div>
      </div>
<!--From chỉnh sửa !-->

<?php 
// $mysqli = new mysqli('localhost','root','','quanliduan') or die(mysqli_error($mysqli));
// $result = $mysqli->query("SELECT * FROM thongtincanhan") or die($mysqli->error);
 ?>

<form action="edit.php" method="POST" style="margin:500px" >
<h5>CHỈNH SỬA THÔNG TIN CÁ NHÂN CỦA BẠN</h5>
  <div class="form-group">
  <input type = "hidden" name = "TTCN_MaTTCN" value = "<?php echo $MaTTCN; ?>">
    <label>Tên Đăng Nhập</label>
    <input type="text" name="TTCN_TenDN" value = "<?php echo $name;?>" readonly="readonly">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="TTCN_Email" value ="<?php echo $email;?>">
  </div>
  <div class="form-group">
    <label>SDT</label>
    <input type="text" name="TTCN_Sdt" value ="<?php echo $phone;?>">
  </div>
  <div class="form-group">
    <label>Giới Tính</label>
    <select name = "TTCN_GioiTinh" value = <?php echo $value; ?>> 
      <option value = "1"> Nam </option>
      <option value = "0"> Nữ </option>
    </select>
    
  </div>
  <div>
  <button type="submit" class="btn btn-info" name="update">Cập Nhật</button>
  </div>
</form>

    </section>

    <section class="section my-services" data-section="section2">
      <div class="container">
        <div class="section-heading">
          <h2>What I’m good at?</h2>
          <div class="line-dec"></div>
          <span>Curabitur leo felis, rutrum vitae varius eu, malesuada a tortor.
            Vestibulum congue leo et tellus aliquam, eu viverra nulla semper.
            Nullam eu faucibus diam. Donec eget massa ante.</span>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="service-item">
              <div class="first-service-icon service-icon"></div>
              <h4>HTML5 &amp; CSS3</h4>
              <p>
                Phasellus non convallis dolor. Integer tempor hendrerit arcu
                at bibendum. Sed ac ante non metus vehicula congue quis eget
                eros.
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="service-item">
              <div class="second-service-icon service-icon"></div>
              <h4>Creative Ideas</h4>
              <p>
                Proin lacus massa, eleifend sed fermentum in, dignissim vel
                metus. Nunc accumsan leo nec felis porttitor, ultricies
                faucibus purus mollis.
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="service-item">
              <div class="third-service-icon service-icon"></div>
              <h4>Easy Customize</h4>
              <p>
                Integer suscipit condimentum aliquet. Nam quis risus metus.
                Nullam faucibus quam eget arcu pretium tincidunt. Nam libero
                dui.
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="service-item">
              <div class="fourth-service-icon service-icon"></div>
              <h4>Admin Dashboard</h4>
              <p>
                Vivamus et dui a massa venenatis fringilla. Proin lacus massa,
                eleifend sed fermentum in, dignissim vel metus. Nunc accumsan
                leo nec felis porttitor.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section my-work" data-section="section3">
      <div class="container">
        <div class="section-heading">
          <h2>My Work</h2>
          <div class="line-dec"></div>
          <span>Aenean sollicitudin ex mauris, lobortis lobortis diam euismod sit
            amet. Duis ac elit vulputate, lobortis arcu quis, vehicula
            mauris.</span>
        </div>
        <div class="row">
          <div class="isotope-wrapper">
            <form class="isotope-toolbar">
              <label><input type="radio" data-type="*" checked="" name="isotope-filter" />
                <span>all</span></label>
              <label><input type="radio" data-type="people" name="isotope-filter" />
                <span>people</span></label>
              <label><input type="radio" data-type="nature" name="isotope-filter" />
                <span>nature</span></label>
              <label><input type="radio" data-type="animals" name="isotope-filter" />
                <span>animals</span></label>
            </form>
            <div class="isotope-box">
              <div class="isotope-item" data-type="nature">
                <figure class="snip1321">
                  <img src="assets/images/portfolio-01.jpg" alt="sq-sample26" />
                  <figcaption>
                    <a href="assets/images/portfolio-01.jpg" data-lightbox="image-1" data-title="Caption"><i
                        class="fa fa-search"></i></a>
                    <h4>First Title</h4>
                    <span>free to use our template</span>
                  </figcaption>
                </figure>
              </div>

              <div class="isotope-item" data-type="people">
                <figure class="snip1321">
                  <img src="assets/images/portfolio-02.jpg" alt="sq-sample26" />
                  <figcaption>
                    <a href="assets/images/portfolio-02.jpg" data-lightbox="image-1" data-title="Caption"><i
                        class="fa fa-search"></i></a>
                    <h4>Second Title</h4>
                    <span>please tell your friends</span>
                  </figcaption>
                </figure>
              </div>

              <div class="isotope-item" data-type="animals">
                <figure class="snip1321">
                  <img src="assets/images/portfolio-03.jpg" alt="sq-sample26" />
                  <figcaption>
                    <a href="assets/images/portfolio-03.jpg" data-lightbox="image-1" data-title="Caption"><i
                        class="fa fa-search"></i></a>
                    <h4>Item Third</h4>
                    <span>customize anything</span>
                  </figcaption>
                </figure>
              </div>

              <div class="isotope-item" data-type="people">
                <figure class="snip1321">
                  <img src="assets/images/portfolio-04.jpg" alt="sq-sample26" />
                  <figcaption>
                    <a href="assets/images/portfolio-04.jpg" data-lightbox="image-1" data-title="Caption"><i
                        class="fa fa-search"></i></a>
                    <h4>Item Fourth</h4>
                    <span>Re-distribution not allowed</span>
                  </figcaption>
                </figure>
              </div>

              <div class="isotope-item" data-type="nature">
                <figure class="snip1321">
                  <img src="assets/images/portfolio-05.jpg" alt="sq-sample26" />
                  <figcaption>
                    <a href="assets/images/portfolio-05.jpg" data-lightbox="image-1" data-title="Caption"><i
                        class="fa fa-search"></i></a>
                    <h4>Fifth Awesome</h4>
                    <span>Ut sollicitudin risus</span>
                  </figcaption>
                </figure>
              </div>

              <div class="isotope-item" data-type="animals">
                <figure class="snip1321">
                  <img src="assets/images/portfolio-06.jpg" alt="sq-sample26" />
                  <figcaption>
                    <a href="assets/images/portfolio-06.jpg" data-lightbox="image-1" data-title="Caption"><i
                        class="fa fa-search"></i></a>
                    <h4>Awesome Sixth</h4>
                    <span>Donec eget massa ante</span>
                  </figcaption>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section contact-me" data-section="section4">
      <div class="container">
        <div class="section-heading">
          <h2>Contact Me</h2>
          <div class="line-dec"></div>
        </div>
        <div class="row">
          <div class="right-content">
            <div class="container">
              <h4 style="color: yellow;">Bảng Công Việc</h4>
              <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%">
                <tr>
                  <th>STT</th>
                  <th>Tên Dự Án</th>
                  <th>Tên Công Việc</th>
                  <th>Trạng Thái</th>
                  <th>Vai Trò</th>
                </tr>
                <?php
                    $STT = 1;
                    $sql = $conn -> query("SELECT da.DA_TenDuAn, cv.CV_TenCongViec, pc.PC_TrangThai, vt.VT_TenVaiTro
                    FROM thongtincanhan tt, thanhvien tv, phancong pc, congviec cv, vaitro vt, duan da
                    WHERE tt.TTCN_MaTTCN = tv.TV_MaTTCN 
                        AND tv.TV_MaThanhVien = pc.PC_MaThanhVien 
                        AND pc.PC_MaCongViec = cv.CV_MaCongViec 
                        AND pc.PC_MaVaiTro = vt.VT_MaVaiTro 
                        AND da.DA_MaDuAn = pc.PC_MaDuAn AND tt.TTCN__TenDN = '$username'");
                    
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