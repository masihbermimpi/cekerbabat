<?php
// Ambil orderId dari data POST
include("config.php");

$data = json_decode(file_get_contents('php://input'), true);

// Mengakses nilai orderId
$orderId = $data['orderId'];
    // Lakukan koneksi ke database (koneksi harus sudah dibuat sebelumnya)

    // Jalankan perintah SQL UPDATE
    $sql = "UPDATE `order` SET `status`='done' WHERE id = '$orderId'";
    if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Sukses mengupdate status order!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
