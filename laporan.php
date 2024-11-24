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
    <link rel="stylesheet" href="asset/style/order.css" />
    <link rel="stylesheet" href="asset/style/style.css" />

    <?php if ($custom_style) : ?>
        <link rel="stylesheet" href="asset/style/order.css" />
        <link rel="stylesheet" href="asset/style/style.css" />
    <?php endif; ?>
    <link rel="icon" type="image/png" href="asset/img/icon.ico" />
    <style>
        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">
                <p>Ceker</p>
                <p class="kuning">Babat</p>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="order.php">Order</a></li>
            </ul>
            <button class="login"><a href="print.php" target="_blank">Cetak Laporan</a></button>
        </header>
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
        <footer>
            <p>Copyright &copy; Emrido</p>
        </footer>
    </div>
    <script src="script/order.js"></script>
</body>

</html>