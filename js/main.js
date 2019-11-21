/* index.html functions */
function toggleLogin() {
    var x = document.getElementById('id01');

    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function toggleSignup() {
    var x = document.getElementById('id02');

    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

/* forum.html functions */
function getSelectedValue() {
    varSelectedValue = document.getElementById("classes").value
    document.getElementById("className").innerHTML = varSelectedValue;
}

function toggleCateogry() {
    var x = document.getElementById("dropdown1");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function toggleDiscussion() {
    var x = document.getElementById('modalDiscussionPresent')
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function toggleQuestion() {
    var x = document.getElementById('modalQuestionPresent')
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function populateData() {
    
}