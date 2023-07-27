// JS for Administrator and Staff

function updateClock(){
    var now = new Date();
    var dname = now.getDay(),
        mo = now.getMonth(),
        dnum = now.getDate(),
        yr = now.getFullYear(),
        hour = now.getHours(),
        min = now.getMinutes(),
        sec = now.getSeconds(),
        pe = "AM";

        if(hour >= 12){
          pe = "PM";
        }
        if(hour == 0){
          hour = 12;
        }
        if(hour > 12){
          hour = hour - 12;
        }

        Number.prototype.pad = function(digits){
          for(var n = this.toString(); n.length < digits; n = 0 + n);
          return n;
        }

        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var ids = ["month", "daynum", "year", "hour", "minutes", "period", "dayname"];
        var values = [months[mo], dnum.pad(2), yr, hour.pad(2), min.pad(2), pe, week[dname]];
        for(var i = 0; i < ids.length; i++)
        document.getElementById(ids[i]).firstChild.nodeValue = values[i];
}

// Real time clock
function initClock(){
    updateClock();
    window.setInterval("updateClock()", 1);
}

// Tooltip
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

// Show and Hide Password
var state1 = false;
let hide1 = document.querySelector("#show1");

function toggle1() {
  if (state1) {
    document.getElementById("current_password").setAttribute("type", "password");
    hide1.style.color = "#D0CECE";
    hide1.classList.replace("la-eye-slash", "la-eye");
    state1 = false;
  }

  else {
    document.getElementById("current_password").setAttribute("type", "text");
    hide1.style.color = "#1976D2";
    hide1.classList.replace("la-eye", "la-eye-slash");
    state1 = true;
  }
}

var state2 = false;
let hide2 = document.querySelector("#show2");

function toggle2() {
  if (state2) {
    document.getElementById("new_password").setAttribute("type", "password");
    hide2.style.color = "#D0CECE";
    hide2.classList.replace("la-eye-slash", "la-eye");
    state2 = false;
  }

  else {
    document.getElementById("new_password").setAttribute("type", "text");
    hide2.style.color = "#1976D2";
    hide2.classList.replace("la-eye", "la-eye-slash");
    state2 = true;
  }
}

var state3 = false;
let hide3 = document.querySelector("#show3");

function toggle3() {
  if (state3) {
    document.getElementById("confirm_password").setAttribute("type", "password");
    hide3.style.color = "#D0CECE";
    hide3.classList.replace("la-eye-slash", "la-eye");
    state3 = false;
  }

  else {
    document.getElementById("confirm_password").setAttribute("type", "text");
    hide3.style.color = "#1976D2";
    hide3.classList.replace("la-eye", "la-eye-slash");
    state3 = true;
  }
}