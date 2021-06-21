<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanliduan";
 
// tạo connection
$conn = new mysqli($servername, $username, $password, $dbname);
// kiểm connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
$sql = "SELECT * FROM thongtincanhan WHERE TTCN__TenDN = 'Ngocyen'";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // output dữ liệu trên trang
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["TTCN__Email"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>