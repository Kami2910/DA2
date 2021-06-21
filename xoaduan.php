<?php
      $id = $_GET['id'];
      $xoapc = mysqli_query ($conn, "DELETE FROM phancong WHERE PC_MaDuAn = '$id'");
     $xoada = mysqli_query ($conn, "DELETE FROM duan WHERE DA_MaDuAn = '$id'");
      if ($xoapc && $xoada){
        echo "<script> alert ('Xóa thành công') </script>";
        echo "<script>
        location.href = './first.php';
        </script>";
      }
      else {
        echo "<script> alert ('Xóa thất bại') </script>";
        echo "<script>
        location.href = './first.php';
        </script>";
      }
?>