document.addEventListener("DOMContentLoaded", function () {
  if (window.location.hash) {
    window.location = window.location.href.split("#")[0];
  }
  const login = document.querySelector(".log");
  const loginBtn = document.querySelector("#loginbtn");
  const close = document.querySelector(".close");
  const popup = document.querySelector(".popup");

  loginBtn.addEventListener("click", function () {
    login.style.display = "flex"; // Menampilkan class .log saat tombol login diklik
  });
  close.addEventListener("click", function (event) {
    event.preventDefault();
    login.style.display = "none"; // Menampilkan class .log saat tombol login diklik
  });

  const order = document.querySelectorAll(".order");

  const cancel = document.querySelector(".cancel");
  const confirm = document.querySelector(".confirm");

  let menuOrder = document.querySelector("#menuOrder");

  if (menuOrder) {
      document
        .querySelector("#menuOrder")
        .addEventListener("click", function () {
          alert("Login Terkebih Dahulu !");
        });
  }

  let beforeLogin = document.querySelectorAll(".beforeLogin");
  if (beforeLogin) {
    document.querySelectorAll(".beforeLogin").forEach((element) => {
      element.addEventListener("click", function () {
        alert("Login Terlebih Dahulu !");
      });
    });
  }

  let jumlah = 1;

  cancel.addEventListener("click", function () {
    popup.style.display = "none";
    jumlah = 1;
    document.getElementById("jumlah").innerText = "Jumlah : " + jumlah;
  });

  document.querySelector(".plus").addEventListener("click", function () {
    jumlah++;
    document.querySelector(".total").innerHTML =
      "Total : " + jumlah * (parseInt(window.harga) * 1000);

    fetch("script/menu.json")
      .then((response) => response.json())
      .then((data) => {
        // Ubah nilai "jumlah"
        data.jumlah = jumlah; // Misalnya, ubah menjadi 5

        // Kirim kembali data yang telah diubah ke server
        fetch("script/menu.json", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        });
        document.getElementById("jumlah").innerText = "Jumlah : " + jumlah;
      });
  });
  document.querySelector(".min").addEventListener("click", function () {
    if (jumlah > 1) {
      jumlah--;
      document.querySelector(".total").innerHTML =
        "Total : " + jumlah * (parseInt(window.harga) * 1000);

      fetch("script/menu.json")
        .then((response) => response.json())
        .then((data) => {
          // Ubah nilai "jumlah"
          data.jumlah = jumlah; // Misalnya, ubah menjadi 5

          // Kirim kembali data yang telah diubah ke server
          fetch("script/menu.json", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          });
          document.getElementById("jumlah").innerText = "Jumlah : " + jumlah;
        });
    }
  });

  document.querySelectorAll(".order").forEach((button) => {
    button.addEventListener("click", function () {
      popup.style.display = "flex";

      let nama = this.parentNode.parentNode.querySelector("p").innerText;
      let harga = this.parentNode.querySelector("div p").textContent;
      document.querySelector(".total").innerHTML =
        "Total : " + parseInt(harga) * 1000;
      // Simpan nilai nama ke variabel yang dapat diakses di luar event ini
      window.nama = nama;
      window.harga = harga;

      document.querySelector(".name").innerHTML = nama;
      document.querySelector(".price").innerHTML = harga;
    });
  });

  var confirmButton = document.querySelector(".confirm");

  confirmButton.addEventListener("click", function () {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "handleOrder.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        console.log("Confirm button clicked and handled successfully");
        console.log(xhr.responseText); // Menampilkan respons dari server
      } else {
        console.log("Error handling Confirm button click");
      }
    };

    // Kirim variabel nama dan jumlah ke server
    var data =
      "action=confirm&nama=" +
      encodeURIComponent(window.nama) +
      "&jumlah=" +
      jumlah;
    xhr.send(data);
    jumlah = 1;
    document.getElementById("jumlah").innerText = "Jumlah : " + jumlah;

    popup.style.display = "none";
  });
});
