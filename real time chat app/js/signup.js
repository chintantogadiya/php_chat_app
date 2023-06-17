const form = document.querySelector(".signup form"),
submitBtn = form.querySelector(".submit input"),
errorText = form.querySelector(".form form .errorText");

form.onsubmit = (e) =>{
    e.preventDefault(); // preventing form from submitting
}

submitBtn.onclick = () =>{
    // let's start AJAX
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST","php/back-signup.php",true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "users.php";
                }else{
                    console.log(data);
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    } 
    // we have to send form data throughajax to php
    let formData = new FormData(form); //creating formData object
    xhr.send(formData); //sending the form data to php
}