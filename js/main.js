


/* index.html  functions */
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

/* forum.html  functions */
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
    loadRoles()
}

// Loads role data into the table on document load
async function loadRoles()  {
    try {
        const response = await fetch("api/data/roles.php", {
            method: "GET",
            headers: {
                'Content-Type': 'application/json'
            },
        })
        const roles = await response.json()

        roles.forEach(function(role){
            // `<option value=\"${role.RoleID}\">${role.RoleName}</option>`
            var opt = document.createElement('option')
            opt.appendChild( document.createTextNode(role.RoleName));
            opt.value = role.RoleID;
            console.log(opt)
            document.getElementById("roleOptions").appendChild(opt)
        })
    } catch (e) {
        console.error("e", e)
    }
}