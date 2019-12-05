//require_once "../connect.php"; 

/* index.html  functions */
function toggleLogin() {
    var x = document.getElementById('id01');

    if (x.style.display === "none" || x.style.display == '') {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function toggleSignup() {
    var x = document.getElementById('id02');

    if (x.style.display === "none" || x.style.display == '') {
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
    loadLoginRoles()
}

async function populateTAShifts() {
    try {
        const response = await fetch("api/data/shifts.php", {
            method: "GET",
            headers: {
                'Content-Type': 'response/json'
            },
        })
        const shifts = await response.json()
        shifts.forEach(function(shift) {
                var list1 = document.getElementById("ListOfTAs1");
                var list2 = document.getElementById("ListOfTAs2");
               
                var beginTime = shift["BeginTime"];
                var endTime = shift["EndTime"];
               
                var TAOption = shift["FirstName"] + " " + shift["LastName"] + ", " + shift["ShiftDay"] + ", " + beginTime.substring(1,2) + " - " + endTime.substring(1,2) 
                list1.appendChild(genTAList(TAOption));
                list2.appendChild(genTAList(TAOption));
           
        })
    } catch (e) {
        console.error("e", e)
    }
}

// Dealing with pass by reference bs
function genTAList(shift) {
    var opt = document.createElement('option')
    opt.appendChild(document.createTextNode(shift));
    opt.value = shift;
    return opt
}

// Dealing with pass by reference bs
function genRoleOption(role) {
    var opt = document.createElement('option')
    opt.appendChild(document.createTextNode(role.RoleName));
    opt.value = role.RoleID;
    return opt
}


async function getSession() {
    try {
        const response = await fetch("api/data/sessions.php", {
            method: "GET",
            headers: {
                'Content-Type': 'response/json'
            },
        })
        const session = await response.json()
        return session
    } catch (e) {
        console.error("e", e)
    }
}
// Loads role data into the table on document load
async function loadLoginRoles() {
    try {
        const response = await fetch("api/data/roles.php", {
            method: "GET",
            headers: {
                'Content-Type': 'response/json'
            },
        })
        const roles = await response.json()
            // console.log(roles);
        roles.forEach(function(role) {
            document.getElementById("loginRoleOptions").appendChild(genRoleOption(role))
            document.getElementById("signupRoleOptions").appendChild(genRoleOption(role))
        })
    } catch (e) {
        console.error("e", e)
    }
}