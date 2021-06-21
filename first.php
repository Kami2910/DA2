<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanliduan";
session_start();
$dulieunhan = isset($_SESSION['dulieugui']) ? $_SESSION['dulieugui'] : '';

// tạo connection

$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_POST['PC_MaCongViec'])) {
    $macv = $_POST['PC_MaCongViec'];
    $sql = "SELECT * FROM phancong WHERe PC_MaCongViec = {$macv}";
}
   

// kiểm connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$finish = false;
$sql = "SELECT * FROM thongtincanhan WHERE TTCN__TenDN = '$dulieunhan'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output dữ liệu trên trang
    while ($row = $result->fetch_assoc()) {
        if ($dulieunhan == $row['TTCN__TenDN']) {
            $name = $row['TTCN__TenDN'];
            $MaTTCN = $row['TTCN_MaTTCN'];
            $email = $row['TTCN__Email'];
            $phone = $row['TTCN__Sdt'];
            $sex = $row['TTCN__GioiTinh'];
            if ($sex == 0) {
                $value = "Nữ";
            } else {
                $value = "Nam";
            }
        }
    }
} else {
    echo "0 results";
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trang Cá Nhân</title>
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
    <?php require_once 'edit.php'; ?>
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
                       
                    <h4><?php echo $name ?></h4>
                        <span>Web Designer</span>
                    </div>

                    <nav class="main-nav" role="navigation">
                        <ul class="main-menu">
                            <li><a href="#section1">QUẢN LÝ THÔNG TIN CÁ NHÂN</a></li>
                            <li><a href="#section2">QUẢN LÝ DỰ ÁN</a></li>
                            <li><a href="#section3">CÔNG VIỆC CỦA TÔI</a></li>
                        </ul>
                        <ul>
                            <li>
                                <a href="./taoduan.php">TẠO DỰ ÁN</a>
                            </li>
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
        <!-- SECTION 1  -->
        <section class="section about-me" data-section="section1" style="padding-left: 50px;">
            <div class="container" style="text-align: center;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2 style="color: White;">Thông Tin Cá Nhân</h2>
                            <p style="font-size: 20px;">Bảng Thông Tin Cá Nhân Của Bạn</p>
                            <div class="line-dec"></div>
                        </div>
                    </div>
                    <div class="col-md-10" style="padding-left: 150px;">
                        <div class="right-text">

                            <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%" style="position:relative;top:-50px;">
                                <tr>
                                    <th style="color:#4d4d33; background-color: #ddd;">Tên đăng nhập</th>
                                    <th style="color:#4d4d33;">Email</th>
                                    <th style="color:#4d4d33; background-color: #ddd;">SĐT</th>
                                    <th style="color:#4d4d33;">Giới tính</th>
                                </tr>
                                <tr>
                                    <th><?php echo $name ?></th>
                                    <th><?php echo $email ?></th>
                                    <th><?php echo $phone ?></th>
                                    <th><?php echo $value ?></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-10" style="padding-left: 150px;">
                        <form action="edit.php" method="POST" style=" border-style: solid;  border-radius: 25px;">
                            <p style="font-size:20px ; color:#862d59">CHỈNH SỬA THÔNG TIN CÁ NHÂN CỦA BẠN</p>

                            <div class="form-group" style="display:flex">
                                <input style="margin-right:5px;  " type="hidden" name="TTCN_MaTTCN" value="<?php echo $MaTTCN; ?>">
                                <div style="width:30%"> <label style="color:#4d4d33; ">Tên Đăng Nhập</label> </div>
                                <div style="width:70%"> <input style=" border-radius: 25px;" type="text" name="TTCN_TenDN" value="<?php echo $name; ?>" readonly="readonly"> </div>
                            </div>

                            <div class="form-group" style="display:flex">
                                <div style="width:30%"> <label style="color:#4d4d33;">Email</label> </div>
                                <div style="width:70%"> <input style=" border-radius: 25px;" type="text" name="TTCN_Email" value="<?php echo $email; ?>"></div>
                            </div>

                            <div class="form-group" style="display:flex">
                                <div style="width:30%"> <label style="color:#4d4d33;">SDT</label></div>
                                <div style="width:70%"> <input style=" border-radius: 25px;" type="text" name="TTCN_Sdt" value="<?php echo $phone; ?>"></div>
                            </div>

                            <div class="form-group" style="display:flex">
                                <div style="width:30%"> <label style="color:#4d4d33;">Giới Tính</label></div>
                                <div style="width:70%">
                                    <select style=" border-radius: 25px;" name="TTCN_GioiTinh" value=<?php echo $value; ?>>
                                        <option value="1"> Nam </option>
                                        <option value="0"> Nữ </option>
                                    </select>
                                </div>
                            </div>
                            <div style="text-align: center; "><button type="submit" class="btn btn-danger" name="update">Cập Nhật</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- SECTION 2 -->
        <section class="section my-services" data-section="section2">
            <?php require_once 'createDA.php'; ?>
            <?php
            $mysqli = new mysqli('localhost', 'root', '', 'quanliduan') or die(mysqli_error($mysqli));
            $thanhvien = $mysqli->query("SELECT * FROM thongtincanhan WHERE thongtincanhan.TTCN__TenDN LIKE '$dulieunhan'");

            ?>
            <div class="container">
                <div class="section-heading">
                    <h2>Quản Lý Dự Án</h2>
                    <p style="font-size: 20px;">Các Dự Án Mà Bạn Tham Gia</p>
                    <div class="line-dec"></div>
                    <div class="col-md-10" style="padding-left: 150px; position:relative;top:80px;">
                        <div class="right-text">
                            <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%" style=" border-style: solid;  border-radius: 25px;">
                                <tr>
                                    <th style="color:#4d4d33; background-color: #ddd;">STT</th>
                                    <th style="color:#4d4d33;">Mã Dự Án</th>
                                    <th style="color:#4d4d33; background-color: #ddd;">Tên Dự Án</th>
                                    <th style="color:#4d4d33;">Hạn Chót Dự Án</th>
                                    <th style="color:#4d4d33;background-color: #ddd;">Thao Tác</th>
                                </tr>
                                <?php
                                $STT = 1;
                                $row = mysqli_fetch_array($thanhvien);
                                $mathanhvien = $row['TTCN_MaTTCN'];
                                $duan = $mysqli->query("SELECT * FROM duan join phancong ON duan.DA_MaDuAn = phancong.PC_MaDuAn where PC_MaTTCN = '$mathanhvien'");
                                while ($row1 = mysqli_fetch_array($duan)) {
                                ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="STT" VALUE="<?php echo $row['STT']; ?>">
                                            <?php echo $STT;
                                            ?>
                                        </td>
                                        <td><?php echo $row1['DA_MaDuAn']; ?></td>
                                        <td><?php echo $row1['DA_TenDuAn']; ?></td>
                                        <td><?php echo $row1['DA_HanChotDA']; ?></td>

                                        <td>
                                            <div class="icon-list">
                                                <a href="./first.php?action=<?php echo $row1['PC_MaVaiTro']; ?>&id=<?php echo $row1['DA_MaDuAn'] ?>">Đến dự án</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    $STT++;
                                }

                                ?>
                            </table>
                        </div>
                        <?php
                        if (isset($_GET['action'])) {
                            switch ($_GET['action']) {
                                case 'TN':
                                    $id = $_GET['id'];
                                    echo "<script>
                                                            location.href = './QLDA_TN.php?id=$id';
                                                        </script>";

                                    break;

                                case 'PTN':
                                    $id = $_GET['id'];
                                    echo "<script>
                                                            location.href = './QLDA_PTN.php?id=$id';
                                                        </script>";
                                    break;

                                case 'TV':
                                    $id = $_GET['id'];
                                    echo "<script>
                                                            location.href = './QLDA_TV.php?id=$id';
                                                        </script>";
                                    break;
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <!-- Noi dung quan li du an -->
                </div>
            </div>
        </section>


        <!-- SECTION 3 -->
        <section class="section my-work" data-section="section3" style="padding-left: 100px;">
            <form action="first.php" method="POST">
                <div class="container">
                    <div class="section-heading">
                        <h2>Công Việc</h2>
                        <p style="font-size: 20px;">Công Việc Của Bạn</p>
                        <div class="line-dec"></div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <h4 style="color: #862d59; padding-left: 315px;">Bảng Công Việc</h4>
                            <table class="table table-bordered" id="TTCN" width="100%" cellspacing="100%" style=" border-style: solid;  border-radius: 25px;">
                                <tr>

                                    <th style="color:#4d4d33; background-color: #ddd;">STT</th>
                                    <!-- <th style="color:#4d4d33;">Mã</th> -->
                                    <th style="color:#4d4d33;">Tên Dự Án</th>
                                    <th style="color:#4d4d33; background-color: #ddd;">Tên Công Việc</th>
                                    <th style="color:#4d4d33;">Trạng Thái</th>
                                    <th style="color:#4d4d33; background-color: #ddd;">Mã dự án</th>
                                    <th style="color:#4d4d33;">Thao Tác</th>
                                </tr>
                                <?php

                                $sql = $conn->query("SELECT STT, DA_MaDuAn , DA_TenDuAn ,CV_TenCongViec, PC_TrangThai, PC_MaCongViec, PC_MaTTCN
                                FROM phancong p join duan da on p.PC_MaDuAn = da.DA_MaDuAn 
                                join vaitro v on p.PC_MaVaiTro = v.VT_MaVaiTro
                                join congviec c ON p.PC_MaCongViec = c.CV_MaCongViec 
                                join thongtincanhan tt on p.PC_MaTTCN = tt.TTCN_MaTTCN
                                WHERE TTCN__TenDN='$dulieunhan'");
                                $STT = 1;
                                while ($row = $sql->fetch_assoc()) : ?>

                                    <tr>
                                        <td>
                                            <input type="hidden" name="STT" VALUE="<?php echo $STT ?>">
                                            <?php echo $STT;   ?>
                                        </td>
                                        <!-- <td><?php  echo $row['DA_MaDuAn'];    ?></td> -->
                                        <td><?php echo $row['DA_TenDuAn']; ?></td>
                                        <td><?php echo $row['CV_TenCongViec']; ?></td>
                                        <td><?php 
                                            echo $row['PC_TrangThai'];
                                            ?></td>
                                        <td><?php echo $row['DA_MaDuAn'] ?></td>
                                        <td>
                                            <form name="capnhat" action="" method="post">
                                                <input type="hidden" name="PC_MaCongViec" value="<?php echo $macv; ?>" />
                                                <input type="hidden" name="hientrang" value="1" />
                                                <button style="height: 40px; width: 90px; font-size: 12px; margin-right: 5px; color: #000;" type="submit" name="xong" class="btn btn-success" value="Đã xong">
                                                    <a style="color: #fff" href="./first.php?action=xong&id=<?php echo $row['DA_MaDuAn'];?>&cv=<?php echo $row['PC_MaCongViec']?>&mattcn=<?php echo $row['PC_MaTTCN']?>">Đã xong</a>
                                                </button>
                                            </form>
                                            <?php  $row['STT'];  ?>


                                        </td>

                                        </td>
                                    </tr>
                                <?php
                                    $STT += 1;
                                endwhile

                                ?>
                            <?php   if (isset($_GET['action'])) {
                                    switch ($_GET['action']) {
                                        case 'xong': 
                                            $id = $_GET['id'];
                                            $cv = $_GET['cv'];
                                            $ttcn = $_GET['mattcn'];
                                            require_once './xong.php';
                                            break;
                                        }
                            }
                            ?>
                            </table>
                            <?php
        $hanchot = $conn->query("SELECT * FROM phancong pc join thongtincanhan ttcn on pc.PC_MaTTCN = ttcn.TTCN_MaTTCN WHERE TTCN__TenDN = '$name'");
        while ($rowHC = $hanchot->fetch_assoc()){
            $hanchotcongviec = $rowHC['PC_HanChot'];
            $dateCV = new DateTime($hanchotcongviec);
            $datePre = getdate(); 
            $timeHientai = $datePre['0'];
            $timeCV = $dateCV->getTimestamp();
            if (($timeCV-$timeHientai)<=172800){
                echo "<script> alert ('Có công việc sắp hết thời hạn')</script>";
                break;
        
            }
        }
    ?>            </div>

                    </div>
                </div>
            </form>
        </section>


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
                    $("body, html").animate({
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