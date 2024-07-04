//Thành viên thực hiện
// La Vĩnh Hòa
// Trương Hoàng Duy

window.onload = function () {
  // myCart = JSON.parse(window.localStorage.getItem('myCart'))
  // if (myCart) {
  //   showNoti(myCart);
  // }
}

// Tạo ngày muốn đếm ngược
var countDownDate = new Date("Nov 30, 2025 15:37:25").getTime();

// https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_countdown
// Update the count down every 1 second
var x = setInterval(function () {
  // Lấy thời gian hiện trên máy tính
  var now = new Date().getTime();

  // Tính thời gian còn lại
  var distance = countDownDate - now;


  // Tính số ngày còn lại
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));

  // Tính số giờ còn lại
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

  // Tính số phút còn lại
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

  // Tính số giây còn lại
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in an element with id="demo"
  var countdown = document.querySelector(".promotion-countdown__day-number");
  if (countdown != null) {
    document.querySelector(".promotion-countdown__day-number").textContent = days;
    document.querySelector(".promotion-countdown__hour-number").textContent = hours;
    document.querySelector(".promotion-countdown__min-number").textContent = minutes;
    document.querySelector(".promotion-countdown__sec-number").textContent = seconds;
  }

  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
  }
}, 1000);