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
        <li><a href="index.php#menu">Menu</a></li>
        <li><a href="order.php">Order</a></li>
      </ul>
      <button class="login"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Login'; ?></button>
    </header>
    <div class="order">

      <div class="inorder">
        <p class="title">In Order</p>
        <?php
        $user = $_SESSION['username'];
        $sql = "SELECT * from `order` where status = 'inorder' and user = '$user'";
        $hasil = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($hasil)) {
          echo '<div class="waitorder">
  <div class="data">
    <p>' . $data["nama"] . '</p>
    <p>' . $data["harga"] / 1000 . ' K</p>
    <p>Jumlah : ' . $data["jumlah"] . '</p>
    <p>Total : ' . $data["total"] . '</p>
  </div>
  <a class="bayar" onclick="bayar(' . $data["id"] . ')">Bayar</a>
</div>';
        }
        
        ?>
        <!-- <div class="waitorder">
          <div class="data">
            <p>Es Teh</p>
            <p>3 K</p>
            <p>Jumlah : 3</p>
            <p>Total : 9000</p>
          </div>
          <button class="login">Process</button>
        </div> -->
      </div>
      <div class="done">
        <p class="title">Done</p>
        <?php
        $user = $_SESSION['username'];
        $sql2 = "SELECT * from `order` where status = 'done' and user = '$user'";
        $hasil2 = mysqli_query($conn, $sql2);
        while ($data2 = mysqli_fetch_assoc($hasil2)) {
          echo '<div class="doneorder">
  <div class="data">
    <p>' . $data2["nama"] . '</p>
    <p>' . $data2["harga"] / 1000 . ' K</p>
    <p>Jumlah : ' . $data2["jumlah"] . '</p>
    <p>Total : ' . $data2["total"] . '</p>
  </div>
  <button class="login">Nota</button>
</div>';
        }
        ?>
        <!-- <div class="doneorder">
          <div class="data">
            <p>Es Teh</p>
            <p>3 K</p>
            <p>Jumlah : 3</p>
            <p>Total : 9000</p>
          </div>
          <button class="login">Done</button> -->
        <!-- </div> -->
        <!-- <div class="doneorder">
          <div class="data">
            <p>Es Teh</p>
            <p>3 K</p>
            <p>Jumlah : 3</p>
            <p>Total : 9000</p>
          </div>
          <button class="login">Done</button>
        </div>
        <div class="doneorder">
          <div class="data">
            <p>Es Teh</p>
            <p>3 K</p>
            <p>Jumlah : 3</p>
            <p>Total : 9000</p>
          </div>
          <button class="login">Done</button>
        </div> -->
      </div>
    </div>
    <footer>
      <p>Copyright &copy; Emrido</p>
    </footer>

    <div class="payment">
      <div class="pay">
        <div class="infoPayment">
          <img class="qris" src="asset/img/qr.svg" alt="">
          <p>Rp. 99000</p>
        </div>

        <button class="login">Bayar</button>
      </div>
    </div>
  </div>
  </div>
  <script src="script/order.js"></script>
</body>

</html>