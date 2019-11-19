
//document.getElementById("id01").onload = function() {
//    document.getElementById('id01').style.display='none'
//};

function toggle_login() {
    var x = document.getElementById('id01');

    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function toggle_signup() {
    var x = document.getElementById('id02');

    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
