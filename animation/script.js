let c = document.getElementById("MyCanvas");
let ctx = c.getContext("2d");
ctx.beginPath();
ctx.arc(150, 75, 70, 0, 2 * Math.PI);
ctx.stroke();

document.getElementById("btn").onclick = function () {
    myFunction()
};


function myFunction() {
    document.getElementById("myMenu").classList.toggle("show");
}



document.getElementById("myLocation").onclick = getLocation;



let x = document.getElementById("myLocation");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
        "<br>Longitude: " + position.coords.longitude;
}

let w = window.innerWidth
|| document.documentElement.clientWidth
|| document.body.clientWidth;

let h = window.innerHeight
|| document.documentElement.clientHeight
|| document.body.clientHeight;













