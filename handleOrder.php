<?php
session_start();
include("config.php");

$json = file_get_contents('script/menu.json');
$array = json_decode($json, true);

$action = $_POST['action'];

if ($action === 'confirm') {
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah']; // Mengambil nilai jumlah dari data yang dikirim

    $sql = "select * from menu where nama = '$nama'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nama = $row['nama'];
            $harga = $row['harga'];
        }

        $total = $jumlah * $harga; // Menggunakan nilai jumlah yang diterima
        $user = $_SESSION['username'];
        // Insert into the order table
        $status = 'inorder';
        $insertSql = "INSERT INTO `order` (nama, harga, jumlah, total, status, user) VALUES ('$nama', '$harga', '$jumlah', '$total', '$status', '$user')";
        $conn->query($insertSql);
    } else {
        echo 'No results found';
    }
} else {
    echo 'Fail';
}
