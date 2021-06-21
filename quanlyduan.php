<meta charset="utf-8" />
<?php 
    include './connect_db.php';
    $username =  $_SESSION['user']['TK_TenDN'];
    $count = 1;
    $thanhvien = mysqli_query($conn, "SELECT TV_MaDuAn FROM thanhvien join thongtincanhan on thanhvien.tv_MaTTCN = thongtincanhan.TTCN_MaTTCN WHERE thongtincanhan.TTCN__TenDN LIKE '$username'");
    $action ="";
//     while ($row = mysqli_fetch_array($thanhvien)){
//         $maduan = $row['TV_MaDuAn'];
//         $duan = mysqli_query($conn, "SELECT * FROM duan WHERE DA_MaDuAn LIKE '$maduan' ORDER BY `DA_TenDuAn` ASC");
//         while ($row1 = mysqli_fetch_array($duan)){
//             $count = 1;
            
//         }
//     }
    
    
    $hienthicongviec = mysqli_query($conn, "SELECT * FROM congviec");
    
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleMain.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body>
 		<div id="container">
            <!-- Left-side-bar -->
            <?php include '../div/left-side-bar.php'; ?>
            <!-- top-nav -->
            <?php include '../div/header.php'; 
            ?>
            
            <div class="content content-quanlycongviec content1">
            	<div id="box-content">
                    <div class="logan">
                        <h3>Quản lý dự án</h3>
                    </div>
                <?php  if (!isset($_GET['action'])){?>
                   
                   <div class="table-quanlyduan">
                        <table border="1" width="80%" class="table1" cellpadding="50px" cellspacing= "0">
                            <tr class="height-table">
                                <th>STT</th>
                                <th >Mã dự án</th>
                                <th>Tên dự án</th>
                                <th>Thời gian kết thúc</th>
                                <th>Hành động</th>
                            </tr>
                            <tr class="height-table">
                                <?php
                                while ($row = mysqli_fetch_array($thanhvien)){
                                    $maduan = $row['TV_MaDuAn'];
                                    $duan = mysqli_query($conn, "SELECT * FROM duan WHERE DA_MaDuAn LIKE '$maduan' ORDER BY `DA_TenDuAn` ASC");
                                    while ($row1 = mysqli_fetch_array($duan)){           
             					?>
                                <td class="row-table"><?php echo $count?></td>
                                <td class="row-table"><?php echo $row1['DA_MaDuAn']?></td>
                                <td class="row-table"><?php echo $row1['DA_TenDuAn']?></td>
                                <td class="row-table"><?php echo $row1['DA_HanChotDA']?></td>
                                <td>
                             	
                                    <div class="icon-list">
                                        <a href="./quanlyduan.php?action=<?php echo $row1['DA_MaDuAn'] ?>">Đến dự án</a>
                                    </div>
                                </td>
                            </tr>
                            <?php 
             					  
                            $count+=1;  }
                                }
                                  ?>
                        </table>
                   </div> 
                <?php } else {?>
                	<!-- Bảng quản lý dự án-->
                	<div class="table-quanlyduan">
                        <table border="1" width="80%" class="table1" cellpadding="50px" cellspacing= "0">
                            <tr class="height-table">
                                <th>STT</th>
                                <th >Mã dự án</th>
                                <th>Tên dự án</th>
                                <th>Thời gian kết thúc</th>
                                <th>Hành động</th>
                            </tr>
                            <tr class="height-table">
                                <?php
                                while ($row = mysqli_fetch_array($thanhvien)){
                                    $maduan = $row['TV_MaDuAn'];
                                    $duan = mysqli_query($conn, "SELECT * FROM duan WHERE DA_MaDuAn LIKE '$maduan' ORDER BY `DA_TenDuAn` ASC");
                                    while ($row1 = mysqli_fetch_array($duan)){ 
             					?>
                                <td class="row-table"><?php echo $count?></td>
                                <td class="row-table"><?php echo $row1['DA_MaDuAn']?></td>
                                <td class="row-table"><?php echo $row1['DA_TenDuAn']?></td>
                                <td class="row-table"><?php echo $row1['DA_HanChotDA']?></td>
                                <td>
                             	
                                    <div class="icon-list">
                                        <a href="./quanlyduan.php?action=<?php echo $row1['DA_MaDuAn'] ?>">Đến dự án</a>
                                    </div>
                                </td>
                            </tr>
                            <?php 
             					  
                            $count+=1;  }
                                }
                                  ?>
                        </table>
                   </div> 
                   <!-- Bảng phân công -->
                   <div class="table-phancong">
                        <table border="1" width="80%" class="table1" cellpadding="50px" cellspacing= "0">
                            <tr class="height-table">
                                <th>Tên công việc</th>
                                <th>Tên thành viên</th>
                                <th>Vai trò</th>
                                <th>Thời gian kết thúc</th>
                                <th>Trạng thái</th>
                            </tr>
                            <tr>
                            	<?php 
                            	$thanhvien1 = mysqli_query($conn, "SELECT TV_MaThanhVien FROM thanhvien join thongtincanhan on thanhvien.tv_MaTTCN = thongtincanhan.TTCN_MaTTCN WHERE thongtincanhan.TTCN__TenDN LIKE '$username'");
                            	
                            	while($query = mysqli_fetch_array($thanhvien1)){
                            	    $mathanhvien = $query['TV_MaThanhVien'];
                            	    $getDA =isset($_GET['action'])?$_GET['action']:"";
                            	    $hienthiduan = mysqli_query($conn,"SELECT * FROM phancong join congviec on phancong.PC_MaCongViec = congviec.CV_MaCongViec WHERE PC_MaDuAn LIKE '$getDA' AND PC_MaThanhVien LIKE '$mathanhvien' ORDER BY `PC_MaDuAn` ASC");
                            	   while ($row2 = mysqli_fetch_array($hienthiduan)) {
                                	    $hoten = $row2['PC_MaThanhVien'];
                                	    $user = mysqli_query($conn, "SELECT TTCN_HoTen FROM thanhvien join thongtincanhan on thanhvien.tv_MaTTCN = thongtincanhan.TTCN_MaTTCN WHERE TV_MaThanhVien LIKE '$hoten'");
                            	       while ($row3 = mysqli_fetch_array($user)){  
                            	?>
                                <td class="row-table"><?php echo $row2['CV_TenCongViec']?></td>
                                <td class="row-table"><?php echo $row3['TTCN_HoTen']?></td>
                                <td class="row-table"><?php echo $row2['PC_MaVaiTro']?></td>
                                <td class="row-table"><?php echo $row2['PC_HanChot']?></td>
								<td class="row-table"><?php echo $row2['PC_TrangThai']?></td>
								<td class="row-table">
									<form method="post" class="buttom-check">
										<button type="submit"></button>
									</form>
								</td>
                                
                            </tr>
                            <?php }}}?>
                        </table>
                    </div>
                    <!-- Binh luan -->
                    <div class="binhluan">
                        <form method="POST" action="" class="form-binhluan">
                            <div class="logo-binhluan">
                                <label>Chọn công việc</label>
                                <select name="macongviec" id="" class="form-control1" required="required">
                                <?php foreach ($hienthicongviec as $key => $value) {?>
                                    <option value="<?php echo $value['CV_MaCongViec']?>"><?php echo $value['CV_TenCongViec']?></option>
                                <?php }?>
                                </select>
                            </div>
                            <div class="avatar-binhluan">
                                <img alt="" src="https://appapi.workplus.vn/images_default/avatar.png">
                                <input id="" name="BL_NoiDung" type="text" placeholder="Viết bình luận" class="text-binhluan">
                                <button type="submit-binhluan" name="submit-binhluan" class="btn-binhluan">
                                  <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                    
                   <?php }?>
                   <?php 
                       $BL_MaThanhVien ="";
                       $BL_MaDuAn = "";
                       if(isset($_POST['submit-binhluan'])) {
                           $BL_NoiDung = $_POST['BL_NoiDung'];
                           $BL_MaCongViec = $_POST['macongviec'];
                           $BL_MaThanhVien = $hoten;
                           $BL_MaDuAn = $_GET['action'];
                           $connect = mysqli_query($conn, "INSERT INTO binhluan (BL_NoiDung, BL_MaCongViec, BL_MaThanhVien, BL_MaDuAn)
                               VALUES ('$BL_NoiDung','$BL_MaCongViec','$BL_MaThanhVien','$BL_MaDuAn')");
                           if ($connect){
                               echo "<script> alert('Thêm thành công')</script>";
                           }
                           else {
                               echo "<script> alert('Lỗi')</script>";
                               
                           }
                       }
                   ?>
                </div>
            </div>
        </div>   
</body>
</html>

