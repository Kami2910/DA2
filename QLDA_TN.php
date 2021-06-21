<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanliduan";
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$dulieunhan = isset($_SESSION['dulieugui']) ? $_SESSION['dulieugui'] :''; 
$id = $_GET['id'];
// tạo connection
$conn = new mysqli($servername, $username, $password, $dbname);
// kiểm connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$thongtincongviec = $conn->query("SELECT * FROM phancong p 
                          join congviec c ON p.PC_MaCongViec = c.CV_MaCongViec
                          -- join thongtincanhan t ON p.PC_MaTTCN = t.TTCN_MaTTCN
                          WHERE PC_MaDuAn = '$id'");

$duan = $conn->query("SELECT * FROM duan join phancong on duan.DA_MaDuAn = phancong.PC_MaDuAn WHERE DA_MaDuAn LIKE '$id'");
$ketqua = $duan->fetch_assoc();
$finish =false;
$sql = "SELECT * FROM thongtincanhan WHERE TTCN__TenDN = '$dulieunhan'";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // output dữ liệu trên trang
    while($row = $result->fetch_assoc()) {
      if ($dulieunhan==$row['TTCN__TenDN']){
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
} else {
    echo "0 results";
}

// if (isset($_POST['Xong']))
//   {
//         $finish = true;
//         $STT = $_POST['STT'];
//         $query = $conn->query("SELECT PC_TrangThai FROM phancong WHERE STT = '$STT' ");
//         $rw = $query->fetch_assoc();
//         $Trangthai =  $rw['PC_TrangThai'];

//      if($Trangthai == 'Chưa hoàn tất')
//         {
//           $conn->QUERY("UPDATE phancong SET PC_TrangThai = 'Đang Chờ Duyệt' WHERE STT = '$STT'");
//         }
//   }

if (isset($_POST['update-duan']))
{
  $maduan = $ketqua['DA_MaDuAn'];
  $hanchot = $_POST['hanchot-duan'];
  $update_phancong = $conn->QUERY("UPDATE phancong SET PC_HanChot = '$hanchot'  WHERE PC_MaDuAn = '$maduan' AND PC_MaVaiTro = 'TN'");
  $update_duan = $conn->QUERY("UPDATE `duan` SET `DA_HanChotDA` = '$hanchot' WHERE `duan`.`DA_MaDuAn` = '$maduan'");
  if ($update_duan && $update_phancong) {
    echo "<script> alert('Thành công')</script>";
    echo "<script>
          location.href = './QLDA_TN.php?id=$id';
        </script>";
  }
  else {
    echo "<script> alert('Thất bại')</script>";
    
  }

}
$congviec = $conn->query("SELECT * FROM congviec join phancong on congviec.CV_MaCongViec = phancong.PC_MaCongViec WHERE PC_MaDuAn = '$id'");
// Update cong viec
if (isset($_POST['update-congviec']))
{
  $macongviec = $_POST['macongviec'];
  $maduan = $ketqua['DA_MaDuAn'];
  $hanchotcongviec = $_POST['hanchotcongviec'];
  $hanchotduan = $conn->query("SELECT DA_HanChotDA FROM duan where DA_MaDuAn = '$id'");
  $rowDA = $hanchotduan->fetch_assoc();
  $hanchotduan1 = $rowDA['DA_HanChotDA'];
  // So sánh date công việc với date dự án
  $dateCV = new DateTime($hanchotcongviec);
  $dateDA = new DateTime($hanchotduan1);
  $timeCV = $dateCV->getTimestamp();
  $timeDA = $dateDA->getTimestamp();
  // $datePre = getdate(); lay ngay hien tai
  
  if ($timeCV<=$timeDA){
    $update_congviec = $conn->QUERY("UPDATE phancong SET PC_HanChot = '$hanchotcongviec'  WHERE PC_MaDuAn = '$maduan' AND PC_MaCongViec = '$macongviec'");

    if ($update_congviec) {
      echo "<script> alert('Thành công')</script>";
      echo "<script>
            location.href = './QLDA_TN.php?id=$id';
          </script>";
    }
    
  }
  else {
    echo "<script> alert('Thất bại')</script>";
  }

}

// Xoa du an
if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'xoa': 
      require_once './xoaduan.php';
      break;
  }
}

// Them cong viec
if (isset($_POST['themcv'])) {
  $tenCV = $_POST['tencv'];
  $maCV = $_POST['macv'];
  $themhanchot = $_POST['themhanchot'];
  $hanchotduan = $conn->query("SELECT DA_HanChotDA FROM duan where DA_MaDuAn = '$id'");
  $rowDA = $hanchotduan->fetch_assoc();
  $hanchotduan1 = $rowDA['DA_HanChotDA'];
  $dateCV = new DateTime($themhanchot);
  $dateDA = new DateTime($hanchotduan1);
  $timeCV = $dateCV->getTimestamp();
  $timeDA = $dateDA->getTimestamp();
  if($timeCV<=$timeDA) {
    $themcongviec = $conn->query("INSERT INTO `congviec`(`CV_MaCongViec`, `CV_TenCongViec`) VALUES ('$maCV','$tenCV')");
    $themcongviec2 = $conn->query("INSERT INTO phancong(PC_MaDuAn, PC_MaCongViec, PC_TrangThai, PC_HanChot)
                                   VALUES ('$id','$maCV','Chua hoan tat','$themhanchot')");
    if ($themcongviec && $themcongviec2) {
      echo "<script> alert('Thành công')</script>";
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
  <title>TƯ CÁCH TRƯỞNG NHÓM</title>
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
          <div class="image"><a href="#"><img src="assets/images/author-image.jpg" alt=""/></a></div>
            <div class="author-content">
            <h4><?php echo $name ?></h4>
              <span>Web Designer</span>
            </div>
            <nav class="main-nav" role="navigation">
                <ul class="main-menu">
                  <li><a href="#section1">GIAO VIỆC</a></li>
                  <li><a href="#section2">THAY ĐỔI HẠN CHÓT DỰ ÁN</a></li>
                  <li><a href="#section3">DUYỆT CÔNG VIỆC</a></li>
                  <li><a href="#section4">THAY ĐỔI HẠN CHÓT CÔNG VIỆC</a></li>
                  <li><a href="#section5">BÌNH LUẬN</a></li>
                </ul>

                <ul class="nospace inline pushright">
                  <li><a href="./QLDA_TN.php?id=<?php echo $_GET['id']?>&action=xoa&vt=<?php echo "TN"?>">XÓA DỰ ÁN</a></li>
              </ul>
                <ul class="nospace inline pushright">
                  <li><a href="./first.php">TRANG CHỦ</a></li>
                </ul>
            </nav>
        </div>
      </div>
    </div>
                                                               <!-- SECTION 1 -->
    <section class="section about-me" data-section="section1">
      <div class="container">
            <div class="section-heading">
              <h2 style="color: White;" >LEADER TEAM</h2>
              <p style="font-size: 20px;">Giao Việc Cho Các Thành Viên</p>
              <div class="line-dec"></div>
            </div>
            <div class="right-text">
              <h4 style="color: yellow; text-align: center;">Giao việc</h4>
              
              <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%">
                <tr>
                  <th>Tên Công Việc</th>
                  <th>Mã Công Việc</th>
                  <th>Tên Thành Viên</th>
                  <th>Vai Trò</th>
                  <th>Hạn Chót</th>
                  <th>Thao Tác</th>
                </tr>
                <tr>
                <?php while($rowCV = $thongtincongviec->fetch_assoc()){
                  $mattcn = $rowCV['PC_MaTTCN'];
                  $thongtincanhan = $conn->query("SELECT TTCN__TenDN FROM thongtincanhan WHERE TTCN_MaTTCN = '$mattcn'");
                  $rowTTCN = $thongtincanhan->fetch_assoc();
                ?>
                  
                  <th><?php echo $rowCV['CV_TenCongViec']?></th>
                  <th><?php echo $rowCV['CV_MaCongViec']?></th>
                  <th><?php 
                    if(mysqli_num_rows($thongtincanhan)>0) {
                      echo $rowTTCN['TTCN__TenDN'];
                    }
                  ?></th>
                  <th><?php echo $rowCV['PC_MaVaiTro']?></th>
                  <th><?php echo $rowCV['PC_HanChot']?></th>
                  <th><a href="./phancong.php?id=<?php echo $_GET['id']?>&cv=<?php echo $rowCV['CV_MaCongViec'] ?>&vt=<?php echo "PTN" ?>">Phân Công</a></th>
                </tr>
                <?php } ?>
              </table>
              <form action="" method="POST" style="border-style: solid; border-radius: 25px; border-size:500px;width:450px ;position:relative;top:20px; position:relative;left:230px;">
                <p style ="font-size:20px ; color:yellow"></p>

                  <div class="form-group" style="display:flex">
                    <div style= "width:30%"> <label>Tên công việc</label> </div>
                    <div style= "width:70%"> <input  type="text" name="tencv" placeholder="Nhập tên công việc"> </div>
                  </div>

                  <div class="form-group" style="display:flex">
                    <div style= "width:30%"> <label>Mã công việc</label> </div>
                    <div style= "width:70%"> <input type="text" name="macv" value ="" placeholder="Nhập mã công việc"></div>
                  </div>


                  <div class="form-group" style="display:flex">
                    <div style= "width:30%">  <label>Hạn chót</label></div>
                    <div style= "width:70%">  <input type="date" name="themhanchot" value ="" ></div>
                  </div>
                 <div style="text-align: center;"><button type="submit" class="btn btn-info" name="themcv">Thêm Công Việc</button></div>

              </form>  
            </div>
      </div>
    </section>
                                                                <!-- SECTION 2 -->
    <section class="section my-services" data-section="section2">
      <div class="container">
        <div class="section-heading">
           <h2>THAY ĐỔI HẠN CHÓT DỰ ÁN</h2>
           <div class="line-dec"></div>
        </div>      
        <form action="" method="POST" style="border-style: solid; border-radius: 25px; border-size:500px;width:450px ;position:relative;top:-20px; position:relative;left:230px;"> 
              <p style ="font-size:20px ; color:yellow"></p>

                <div class="form-group" style="display:flex">
                  <div style= " color:#4d4d33; width:30% ;position:relative;left:10px;"> <label>Tên Dự Án</label></div>
                  <div style= " width:70%;position:relative;left:30px;" > <input disabled style =" border-radius: 25px;" type="text" name="ten-duan" value = "<?php echo $ketqua['DA_TenDuAn'];?>" ></div>
                </div>

                <div class="form-group" style="display:flex">
                  <div style= "color:#4d4d33;width:30%;position:relative;left:10px;">  <label>Đặt Lại Hạn Chót</label></div>
                  <div style= "width:70%;position:relative;left:30px;">  <input style =" border-radius: 25px;" type="date" name="hanchot-duan" value ="<?php echo $ketqua['DA_HanChotDA'];?>"></div>
                </div>

                <div style="text-align: center;position:relative;left:30px;"><button style =" border-radius: 25px;"  type="submit" class="btn btn-danger" name="update-duan">Cập Nhật</button></div>
        </form>
      </div>
    </section>
                                                                <!-- SECTION 3 -->
                                                                <section class="section my-work" data-section="section3">
      <div class="container">
      <div class="section-heading">
             <h2>PHÊ DUYỆT CÁC CÔNG VIỆC</h2>
             <p style="font-size: 20px;">Các Công Việc Trong Dự Án Cần Phê Duyệt</p>
            <div class="line-dec"></div>
            <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%" style=" position:relative;top:50px;  ">
                <tr>
                  <th style="color:#4d4d33; background-color: #ddd;">Tên Thành Viên</th>
                  <th style="color:#4d4d33;">Tên Công Việc</th>
                  <th style="color:#4d4d33; background-color: #ddd;">Trạng thái</th>
                  <th style="color:#4d4d33;">Thao Tác</th>
                </tr>
                <tr>
                <?php $duyetcv = $conn->query("SELECT CV_TenCongViec, PC_TrangThai, PC_MaCongViec, PC_MaTTCN, TTCN__TenDN, DA_MaDuAn FROM phancong p 
                                              join duan da on p.PC_MaDuAn = da.DA_MaDuAn 
                                              join vaitro v on p.PC_MaVaiTro = v.VT_MaVaiTro 
                                              join congviec c ON p.PC_MaCongViec = c.CV_MaCongViec 
                                              join thongtincanhan tt on p.PC_MaTTCN = tt.TTCN_MaTTCN WHERE PC_TrangThai = 'Đang chờ duyệt' AND PC_MaDuAn = '$id'");
                while ($rowcv = $duyetcv->fetch_assoc()) {
                ?>
                  <th><?php echo $rowcv['TTCN__TenDN']?></th>
                  <th><?php echo $rowcv['CV_TenCongViec']?></th>
                  <th><?php echo "Đang chờ duyệt"?></th>
                  <th><button style="height: 40px; width: 90px; font-size: 12px; margin-right: 5px; color: #000;" type="submit" name="xong" class="btn btn-success" value="Đã xong">
                        <a style="color: #fff" href="./QLDA_TN.php?action=xong&id=<?php echo $rowcv['DA_MaDuAn'];?>&cv=<?php echo $rowcv['PC_MaCongViec']?>&mattcn=<?php echo $rowcv['PC_MaTTCN']?>">Đã xong</a>
                      </button>
                    </th>
                </tr>
                <?php  }?>
              </table>
              <?php   if (isset($_GET['action'])) {
                        switch ($_GET['action']) {
                            case 'xong': 
                                $id = $_GET['id'];
                                $cv = $_GET['cv'];
                                $ttcn = $_GET['mattcn'];
                                require_once './duyetcv.php';
                                break;
                            }
                      }
                      ?>
        </div>
      </div>
    </section>
                                                                 <!-- SECTION 4 -->
    <section class="section contact-me" data-section="section4">
      <div class="container">
        <div class="section-heading">
             <h2>THAY ĐỔI HẠN CHÓT CÔNG VIỆC</h2>
             <p style="font-size: 20px;">Hạn Chót Công Việc Không Được Vượt Quá Hạn Chót Dự Án </p>
            <div class="line-dec"></div>
            </div>
            <form action="hanchotcv.php?id=<?php echo $_GET['id']?>" method="POST" style="border-style: solid; border-radius: 25px; border-size:500px;width:450px ;position:relative;top:-20px; position:relative;left:230px;"> 
              <p style ="font-size:20px ; color:yellow"></p>
                <div class="form-group" style="display:flex">
                  <div style= " color:#4d4d33; width:30% ;position:relative;left:10px;"> <label>Tên Công Việc</label></div>
                  <div style= " width:70%;position:relative;left:30px;" > 
                    <select style =" border-radius: 25px; width: 190px;" name="macongviec" id="" class="form-control" required="required">
                      <?php while($rowmcv = $congviec ->fetch_assoc()) {?>
                        <option  value="<?php echo $rowmcv['CV_MaCongViec']?>"><?php echo $rowmcv['CV_TenCongViec']?></option>
                        
                        <?php
                        $cv = $rowmcv['CV_MaCongViec'];
                        } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group" style="display:flex">
                  <div style= "color:#4d4d33;width:30%;position:relative;left:10px;">  <label>Đặt Lại Hạn Chót</label></div>
                    <div style= "width:70%;position:relative;left:30px;">  
                    <?php 
                      $congviec1 = $conn->query("SELECT * FROM phancong WHERE PC_MaCongViec = '$cv' AND PC_MaDuAn = '$id'");
                      $congviec2 = $congviec1->fetch_assoc();
                    ?>
                      <input style =" border-radius: 25px;" type="date" name="hanchotcongviec" value ="<?php echo $congviec2['PC_HanChot']?>">
                    </div>
                </div>
               
                <div style="text-align: center;position:relative;left:30px;"><button style =" border-radius: 25px;"  type="submit" class="btn btn-danger" name="update-congviec">Cập Nhật</button></div>
        </form>
        
      </div>
    </section>
                                                                <!-- SECTION 5 -->
    <section class="section about-me" data-section="section5">  
      <div class="container">
            <div class="section-heading">
              <h2 style="color: White;" >BÌNH LUẬN</h2>
              
              <div class="line-dec"></div>
            </div>
            <div class="right-text">
              <h4 style="color: yellow; text-align: center;">CHI TIẾT BÌNH LUẬN</h4>
              <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%">
                <tr>
                  <th>STT</th>
                  <th>Tên Công Việc</th>
                  <th>Tên Thành Viên</th>
                  <th>Vai Trò</th>
                  <th>Thời gian kết thúc</th>
                  <th>Thao Tác</th>
                </tr>
                <tr>
                <?php
                $maduan = $_GET['id'];
                $sql = $conn->query("SELECT TTCN__TenDN,DA_TenDuAn ,VT_TenVaiTro,CV_MaCongViec,CV_TenCongViec, PC_TrangThai,PC_HanChot FROM phancong p 
                join duan da on p.PC_MaDuAn = da.DA_MaDuAn 
                join vaitro v on p.PC_MaVaiTro = v.VT_MaVaiTro 
                join congviec c ON p.PC_MaCongViec = c.CV_MaCongViec 
                join thongtincanhan tt on p.PC_MaTTCN = tt.TTCN_MaTTCN 
                WHERE PC_MaDuAn = '$maduan'");
                    $STT = 1;
                    while ($row = $sql->fetch_assoc()):
                ?>
                 <td>
                    <input type="hidden" name="STT" VALUE="<?php echo $STT?>">
                    <?php echo $STT;?>
                  </td>
                  <th><?php echo $row['CV_TenCongViec']?></th>
                  <th><?php echo $row['TTCN__TenDN']?></th>
                  <th><?php echo $row['VT_TenVaiTro']?></th>
                  <th><?php echo $row['PC_HanChot']?></th>
                  <th><a href="./binhluanTN.php?id=<?php echo $_GET['id']?>&cv=<?php echo $row['CV_MaCongViec'] ?>">Bình luận</a></th>
                </tr>
              <?php $STT+=1;
                    endwhile?>
              </table>
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