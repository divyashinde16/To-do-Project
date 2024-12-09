// script for dark and light theme button

const body = document.querySelector("body"),
modeToggle = body.querySelector(".mode-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode === "dark"){
    body.classList.toggle("dark");
} 

modeToggle.addEventListener("click", () => {
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});


// end 


// script for collapse sidebar 

sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");


let getStatus = localStorage.getItem("status");
if(getStatus && getStatus === "close"){
    sidebar.classList.toggle("close");
} 

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
});


// end