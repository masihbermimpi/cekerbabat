<?php
session_start();
include 'config.php';
$custom_style = isset($_SESSION['custom_style']) ? $_SESSION['custom_style'] : false;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order</title>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        @page {
            size: auto;
            margin: 0mm;
        }
    </style>
    <link rel="stylesheet" href="asset/style/order.css" />
    <link rel="stylesheet" href="asset/style/style.css" />

    <?php if ($custom_style) : ?>
        <link rel="stylesheet" href="asset/style/order.css" />
        <link rel="stylesheet" href="asset/style/style.css" />
    <?php endif; ?>
    <link rel="icon" type="image/png" href="asset/img/icon.ico" />
</head>

<body>
    <div class="container">
        <p class="title">Laporan Penjualan</p>
        <table border="1">
            <tr>
                <th>Jumlah Pesanan</th>
                <th>Total Pendapatan</th>
            </tr>
            <?php
            $sql = "SELECT COUNT(*) AS pesanan, SUM(total) AS total FROM `order`";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $row['pesanan'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <div class="cetak">

        </div>
        <p class="title">
            Pesanan Masuk
        </p>
        <table border="1">
            <tr>
                <th>Nama</th>
                <th>Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
            <?php
            $sql = "SELECT * FROM `order`";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $row['user'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['harga'] . "</td>";
                echo "<td>" . $row['jumlah'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <p class="title"></p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.print();
setTimeout(function(){
    console.log('ppp');
},0)
        })
    </script>
</body>

</html>