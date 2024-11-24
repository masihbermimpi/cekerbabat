<?php
session_start();
include 'config.php';

$custom_style = isset($_SESSION['custom_style']) ? $_SESSION['custom_style'] : false;

if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);

  $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $user['role']; // Set 'role' based on user data
    header("Location: index.php");
    
    exit();
  } else {
    echo "<script>alert('Username atau password salah!');</script>";
    echo "<script>document.querySelector('.log').style.display = 'flex';</script>";
  }
}

$json = file_get_contents('script/menu.json');

$array = json_decode($json, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ceker Babat</title>
  <link rel="stylesheet" href="asset/style/style.css" />
  <?php if ($custom_style) : ?>
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
        <li><a href="">Home</a></li>
        <?php if (isset($_SESSION['username'])) : ?>
          <?php if ($_SESSION['role'] === 'admin') : ?>
            <li><a href="laporan.php">Laporan</a></li>
          <?php else : ?>
            <li><a href="#menu">Menu</a></li>
          <?php endif; ?>
        <?php else : ?>
          <li><a href="#">Menu</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['username'])) : ?>
          <?php if ($_SESSION['role'] === 'admin') : ?>
            <li><a href="orderAdmin.php">Order</a></li>
          <?php else : ?>
            <li><a href="order.php">Order</a></li>
          <?php endif; ?>
        <?php else : ?>
          <li><a href="#" id="menuOrder">Order</a></li>
        <?php endif; ?>
      </ul>
      <?php if (isset($_SESSION['username'])) : ?>
        <button id="loginbtn" class="login"><?php echo $_SESSION['username']; ?></button>
      <?php else : ?>
        <button id="loginbtn" class="login">Login</button>
      <?php endif; ?>
    </header>
    <main>
      <img src="asset/img/chicken.png" alt="" />
      <div class="quote">
        <p>Pesona</p>
        <p>Ceker<span class="kuning">Babat</span></p>
        <p>Since 2024</p>
      </div>
    </main>
    <div class="bestseller">
      <p>Best Seller</p>
      <div class="best">
        <div class="bestchild">
          <img src="asset/img/ceker.jpeg" alt="" />
          <div>
            <p>Ceker Andalan</p>
            <p>Lorem ipsum dolor sit amet, consectetur</p>
            <div>
              <p>10 K</p>
              <?php if (isset($_SESSION['username'])) : ?>
                <button class="login order">Order</button>
              <?php else : ?>
                <button class="login beforeLogin">Order</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="bestchild">
          <img src="asset/img/teh.jpeg" alt="" />
          <div>
            <p>Es Teh</p>
            <p>Lorem ipsum dolor sit amet, consectetur</p>
            <div>
              <p>3 K</p>
              <?php if (isset($_SESSION['username'])) : ?>
                <button class="login order">Order</button>
              <?php else : ?>
                <button class="login beforeLogin">Order</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p id="menu" class="title">Menu</p>
    <div class="menu">
      <div class="menu1">
        <div class="menus">
          <img src="asset/img/ceker.jpeg" alt="" />
          <div>
            <p><?php echo $array['food']['1']['nama']; ?></p>
            <p>Lorem ipsum dolor sit amet, consectetur</p>
            <div>
              <p>10 K</p>
              <?php if (isset($_SESSION['username'])) : ?>
                <button class="login order">Order</button>
              <?php else : ?>
                <button class="login beforeLogin">Order</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="menus">
          <img src="asset/img/ceker3.jpeg" alt="" />
          <div class="closest">
            <p>Rica Ceker</p>
            <p>Lorem ipsum dolor sit amet, consectetur</p>
            <div>
              <p>12 K</p>
              <?php if (isset($_SESSION['username'])) : ?>
                <button class="login order">Order</button>
              <?php else : ?>
                <button class="login beforeLogin">Order</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="menus">
          <img src="asset/img/seblak.jpeg" alt="" />
          <div>
            <p>Seblak Ceker</p>
            <p>Lorem ipsum dolor sit amet, consectetur</p>
            <div>
              <p>12 K</p>
              <?php if (isset($_SESSION['username'])) : ?>
                <button class="login order">Order</button>
              <?php else : ?>
                <button class="login beforeLogin">Order</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="menu1">
        <div class="menus">
          <img src="asset/img/teh.jpeg" alt="" />
          <div>
            <p>Es Teh</p>
            <p>Lorem ipsum dolor sit amet, consectetur</p>
            <div>
              <p>3 K</p>
              <?php if (isset($_SESSION['username'])) : ?>
                <button class="login order">Order</button>
              <?php else : ?>
                <button class="login beforeLogin">Order</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="menus">
          <img src="asset/img/esjeruk.jpeg" alt="" />
          <div>
            <p>Es Jeruk</p>
            <p>Lorem ipsum dolor sit amet, consectetur</p>
            <div>
              <p>4 K</p>
              <?php if (isset($_SESSION['username'])) : ?>
                <button class="login order">Order</button>
              <?php else : ?>
                <button class="login beforeLogin">Order</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="menus">
          <img src="asset/img/kopi.jpeg" alt="" />
          <div>
            <p>Es Kopi</p>
            <p>Lorem ipsum dolor sit amet, consectetur</p>
            <div>
              <p>4 K</p>
              <?php if (isset($_SESSION['username'])) : ?>
                <button class="login order">Order</button>
              <?php else : ?>
                <button class="login beforeLogin">Order</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <p>Copyright &copy; Emrido</p>
    </footer>
    <div class="popup">
      <div class="modal">
        <p class="name">Ceker Andalan</p>
        <p class="price">10 K</p>
        <div class="jumlah">

          <p id="jumlah">Jumlah : 1
          </p>
          <div class="minplus">
            <button class="min login">-</button>
            <button class="plus login">+</button>
          </div>
        </div>
        <p class="total"></p>
        <div class="confirmation">
          <button class="cancel">Cancel</button>
          <button class="confirm">Confirm</button>
        </div>
      </div>
    </div>
    <div class="log">
      <form action="" method="post">
        <button class="close">X</button>
        <p>Welcome back !</p>
        <div class="input">
          <label for="username">Username</label>
          <input name="username" type="text">
        </div>
        <div class="input">
          <label for="password">Password</label>
          <input name="password" type="password">
        </div>
        <input class="login" type="submit" value="Login">
      </form>
    </div>
  </div>
  <script src="script/script.js?v=1"></script>
</body>

</html>

</html>

</html>