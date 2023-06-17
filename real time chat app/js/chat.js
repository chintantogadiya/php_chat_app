const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault(); //preventing form from dubmitting
};

// when we try to scroll up it won't let you to do it because ajax is calling after every 500ms so it automatically scrolled to the bottom
chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
};

sendBtn.onclick = () => {
    // let's start AJAX
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = ""; //once message inserted into database then leave blank inputField
                scrollToBottom();//for scrolling
            }
        }
    }
    // we have to send form data throughajax to php
    let formData = new FormData(form); //creating formData object
    xhr.send(formData); //sending the form data to php
};

setInterval(() => {
    // let's start AJAX
    let xhr = new XMLHttpRequest(); //creating XML object
    // now we will use GET method because we need to receive data not to send
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;  
                if(!chatBox.classList.contains("active")){//if active class not contains in chatboxthe scroll to bottom
                    scrollToBottom();//for scrolling
                }
            }
        }
    }

    // we have to send form data throughajax to php
    let formData = new FormData(form); //creating formData object
    xhr.send(formData); //sending the form data to php
}, 500); // this function will running after every 500ms

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;    
}