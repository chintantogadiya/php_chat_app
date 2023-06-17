const password = document.querySelector(".form input[type = 'password']"),
toggleBtn = document.querySelector(".form .field i");

toggleBtn.onclick = () => {
    if(password.type == "password"){
        password.setAttribute("type", "text");
        toggleBtn.classList.add("active");

    }
    else {
        password.type = "password";
        toggleBtn.classList.remove("active");
    }
}