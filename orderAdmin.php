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
                <li><a href="laporan.php">Laporan</a></li>
            </ul>
            <button class="login"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Login'; ?></button>
        </header>
        <p class="title">Konfirmasi Pesanan</p>
        <div class="table">
            <table border="1">
                <tr>
                    <th>Nama</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Acc</th>
                </tr>
                <?php
                $sql = "SELECT * FROM `order` where status = 'waiting'";
                $query = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>" . $row['user'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['harga'] . "</td>";
                    echo "<td>" . $row['jumlah'] . "</td>";
                    echo "<td>" . $row['total'] . "</td>";
                    echo "<td><button class='login' onclick='confirmOrder(" . $row['id'] . ")'>Confirm</button></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <footer>
            <p>Copyright &copy; Emrido</p>
        </footer>
    </div>
    </div>
    <script>
        function confirmOrder(orderId) {
            console.log(orderId);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "confirmOrder.php", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            };
            var data = JSON.stringify({
                orderId: orderId
            });
            xhr.send(data);
            window.location.reload()
        }
    </script>
    <!-- <script src="script/order.js"></script> -->
</body>

</html>