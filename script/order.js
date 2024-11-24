document.querySelector(".bayar").addEventListener("click", function (event) {});

function bayar(orderId) {
  fetch("bayar.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ orderId: orderId }),
  });
  window.location.reload();
}

function confirmOrder(orderId) {
  console.log(orderId);
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "confirmOrder.php", true);
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);
    }
  };
  var data = JSON.stringify({ orderId: orderId });
  xhr.send(data);
}
