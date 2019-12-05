const login = async eventObj => {
    eventObj.preventDefault()
    const email = document.getElementById("loginEmailField").value
    const password = document.getElementById("loginPasswordField").value
    const role = document.getElementById("loginRoleOptions").value

    console.log(email);
    console.log(password);
    console.log(role);

    cred = {
        origin: "login-submit",
        role: role,
        email: email,
        password: password
    }

    if (!(cred.hasOwnProperty("email") && cred.hasOwnProperty("password") && cred.hasOwnProperty("role"))) {
        console.error("The incoming credentials were malformed and the login request was unable to be completed.");
        return false; 
    }

    try {
        const response = await fetch("api/acnt/login.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cred)
        })

        const rj = await response.json() // was json
        console.log(rj);
        // Do work with the response
        displayLoginError(rj)
        if (rj.hasOwnProperty("error")) {
            console.error("AUTHENTICATION ERROR: " + rj.error)
        } else {
            console.log(rj.response)
            toggleLogin()
            determineHome(rj.role)
        }
        
    } catch (e) {
        console.error("There was a problem", e)
    }
}


const determineHome = async (role) => {

    switch (role) {
        case 1:
            var x = document.getElementById("index");
            x.style.display = "block";
            var x = document.getElementById("TA");
            x.style.display = "none";
            var x = document.getElementById("admin");
            x.style.display = "none";
            break;
        case 2:
            var x = document.getElementById("nav");
            x.style.display = "block";
            var x = document.getElementById("index");
            x.style.display = "none";
            var x = document.getElementById("TA");
            x.style.display = "block";
            var x = document.getElementById("admin");
            x.style.display = "none";
            break;
        case 3:
            var x = document.getElementById("index");
            x.style.display = "block";
            var x = document.getElementById("TA");
            x.style.display = "none";
            var x = document.getElementById("admin");
            x.style.display = "none";
            break;
        case 4:
            var x = document.getElementById("nav");
            x.style.display = "block";
            var x = document.getElementById("index");
            x.style.display = "none";
            var x = document.getElementById("TA");
            x.style.display = "none";
            var x = document.getElementById("admin");
            x.style.display = "block";
            break;
        default:
            console.error("Unable to find role")
    }
}

function toggleLogin() {
    var x = document.getElementById('id01');

    if (x.style.display === "none" || x.style.display == '') {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function displayLoginError(res) {
    var msg = document.getElementById("loginResponseMsg");
    if(res.hasOwnProperty("error")) {
        msg.style.display = "block";
        msg.style.color = "red";
        msg.innerHTML = res.error;
    } else {
        msg.style.display = "block";
        msg.style.color = "green";
        msg.innerHTML = res.response;
    }
}