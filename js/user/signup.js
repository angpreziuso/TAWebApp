const signup = async eventObj => {
    eventObj.preventDefault()
    const fname = document.getElementById("signupFirstNameField").value
    const lname = document.getElementById("signupLastNameField").value
    const email = document.getElementById("signupEmailField").value
    const password = document.getElementById("signupPasswordField").value
    const role = document.getElementById("signupRoleOptions").value

    cred = {
        origin: "signup-submit",
        role: role,
        firstName: fname,
        lastName: lname,
        email: email,
        password: password
    }

    if (!(cred.hasOwnProperty("email") 
            && cred.hasOwnProperty("password") 
            && cred.hasOwnProperty("role")
            && cred.hasOwnProperty("firstName")
            && cred.hasOwnProperty("lastName"))) {
        console.error("The incoming credentials were malformed and the login request was unable to be completed.");
        return false; 
    }

    try {
        const response = await fetch("api/acnt/signup.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cred)
        })

        const rj = await response.json() // was json
        console.log(rj);
        // Do work with the response
        displaySignupError(rj)
        if (rj.hasOwnProperty("error")) {
            console.error("SIGNUP ERROR: " + rj.error)
        } else {
            console.log(rj.response)
        }
        
    } catch (e) {
        console.error("There was a problem", e)
    }
} 


function displaySignupError(res) {
    var msg = document.getElementById("signupResponseMsg");
    if(res.hasOwnProperty("error")) {
        msg.style.display = "block";
        msg.innerHTML = res.error;
    } else {
        msg.style.display = "none";
    }
}