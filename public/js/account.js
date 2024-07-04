//Thành viên thực hiện
// Nguyễn Hồ Thanh Bền
// La Vĩnh Hòa
// Trương Hoàng Duy

var emailInput = document.querySelector(".emailInput");
var passInput = document.querySelector(".passInput");
var rePassInput = document.querySelector(".rePassInput");

var btnRegister = document.querySelector(".btn-register");

var account = {
    regexEmail: new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}'),
    checkRegister: true,
    handleEmail: function () {
        var check = this.emailValidation();
        var error = document.querySelector("#checkEmail");
        // var emailInput = document.querySelector(".emailInput");
        if (check) {
            error.textContent = ''
            emailInput.style.border = '1px solid green'

        } else {
            error.textContent = 'Email không hợp lệ !'
            emailInput.style.border = '1px solid red'
            checkRegister = false;
        }
        if (emailInput.value == '') {
            error.textContent = ''
            emailInput.style.border = '1px solid #ced4da'

        }
    },
    handlePass: function () {
        var check = this.passValidation();
        var error = document.querySelector("#checkPass");
        if (check) {
            error.textContent = ''
            passInput.style.border = '1px solid green'
            checkRegister = true;

        } else {
            error.textContent = 'Mật khẩu phải dài hơn 6 ký tự !'
            passInput.style.border = '1px solid red'
            checkRegister = false;
        }
        if (passInput.value == '') {
            error.textContent = ''
            passInput.style.border = '1px solid #ced4da'
        }
    },
    handleRePass: function () {
        var check = this.rePassValidation();
        var error = document.querySelector("#checkRePass");
        if (check) {
            error.textContent = ''
            rePassInput.style.border = '1px solid green'
            checkRegister = true;

        } else {
            error.textContent = 'Mật khẩu nhập lại không khớp !'
            rePassInput.style.border = '1px solid red'
            checkRegister = false;
        }
        if (rePassInput.value == '') {
            error.textContent = ''
            rePassInput.style.border = '1px solid #ced4da'

        }
    },
    emailValidation: function () {
        if (this.regexEmail.test(emailInput.value)) {
            return true;
        }
        return false;
    },
    passValidation: function () {
        var passValue = passInput.value;
        if (passValue.length < 6) {
            return false;
        } else {
            return true;
        }
    },
    rePassValidation: function () {
        var passValue = passInput.value;
        var rePassValue = rePassInput.value;
        if (rePassValue === passValue) {
            return true;
        } else {
            return false;
        }
    },
    handleRegister: function () {
        if (checkRegister) {
            alert("Đăng ký thành công !");
        } else {
            alert("Đã xảy ra lỗi !")
        }
    },
    handleEvent: function () {
        const _this = this;
        emailInput.onkeyup = function () {
            _this.handleEmail();
        }
        passInput.onkeyup = function () {
            _this.handlePass();
        }
        rePassInput.onkeyup = function () {
            _this.handleRePass();
        }
        btnRegister.onclick = function () {
            _this.handleRegister();
        }
    },
    start: function () {
        this.handleEvent();
    }
}

account.start();