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
        }
        
    } catch (e) {
        console.error("There was a problem", e)
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