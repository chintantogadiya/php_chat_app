const searchBar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button"),
userList = document.querySelector(".users .user-list");

searchBtn.onclick = () =>{
    searchBar.classList.toggle("active");
    searchBtn.classList.toggle("active");
    searchBar.focus();
    searchBar.value = "";
}
/*
    In same file ,ajax is running two lines.One for users list and onother one is when we search the user.So it override and now we will stop users list ajax when user is about searching.
 */
searchBar.onkeyup = () =>{
    // getting user search value
    let searchTerm = searchBar.value;
    // adding an active class when user start searching and only run the setinterval ajax if there is no active class
    if(searchTerm != ""){
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }
    
    // let's start AJAX
    let xhr = new XMLHttpRequest(); //creating XML object
    
    xhr.open("POST", "php/back-search.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                userList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // sending user search term to php file with ajax
    xhr.send("searchTerm=" + searchTerm);
};

setInterval(() =>{
   // let's start AJAX
    let xhr = new XMLHttpRequest(); //creating XML object
    // now we will use GET method because we need to receive data not to send
    xhr.open("GET", "php/back-users.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){
                    // if an active class not contain in searchbar than add this data
                    userList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
},500); // this function will running after every 500ms