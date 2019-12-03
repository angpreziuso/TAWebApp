const login = async eventObj => {
    eventObj.preventDefault()
    const email = document.getElementById("loginEmailField").value
    const password = document.getElementById("loginPasswordField").value
    const role = document.getElementById("loginRoleOptions").value

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

    console.log("Error?");

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
        
        if (rj.hasOwnProperty("error")) {
            console.error("AUTHENTICATION ERROR: " + rj.error)
        } else {
            console.log(rj.response)
        }
        
    } catch (e) {
        console.error("There was a problem", e)
    }
} 