<?php
// Ambil orderId dari data POST
include("config.php");

$data = json_decode(file_get_contents('php://input'), true);

// Mengakses nilai orderId
$orderId = $data['orderId'];
// Lakukan koneksi ke database (koneksi harus sudah dibuat sebelumnya)

$sql = "UPDATE `order` SET `status`='waiting' WHERE id = '$orderId'";
if (mysqli_query($conn, $sql)) {
    header("Location: order.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}
