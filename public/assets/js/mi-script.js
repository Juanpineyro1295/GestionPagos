function password_show_hide() {
  var password = document.getElementById("password");
  var show_eye = document.getElementById("show_eye");
  var hide_eye = document.getElementById("hide_eye");
  show_eye.classList.remove("d-none");
  if (password.type === "password") {
    password.type = "text";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";  
  } else {
    password.type = "password";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  }
}

function password_show_hide2() {
  var password = document.getElementById("pass");
  var show_eye = document.getElementById("show_eye2");
  var hide_eye = document.getElementById("hide_eye2");
  show_eye.classList.remove("d-none");
  if (password.type === "password") {
    password.type = "text";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";  
  } else {
    password.type = "password";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  }
}