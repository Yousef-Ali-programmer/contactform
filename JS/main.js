(function validation() {
  "use strict";
  //USER NAME
  let userName = document.getElementById("contact-input-name");
  let userNum = document.getElementById("contact-input-number");
  let nameError = document.getElementById("name-error");
  let numError = document.getElementById("num-error");

  userName.onblur = function () {
    if (userName.value <= 3 || userName >= 30) {
      nameError.classList.add("show-error");
    }
  };
    
    userName.onfocus = function () { nameError.classList.remove('show-error') }

  userNum.onblur = function () {
    if (userNum.value.split("")[0] != '+') {
      numError.classList.add("show-error");
    }
  };
    userNum.onfocus = function () { numError.classList.remove('show-error') }

})();
