window.addEventListener('DOMContentLoaded', (event) => {
console.log("loaded");

    const submit = document.getElementById("submit");

    submit.addEventListener("click" , function(eventObj)
    {
        eventObj.preventDefault();

        const person1Name = document.getElementById("person1Name").value
        const person2Name = document.getElementById("person2Name").value
        const shiftDate = document.getElementById("shiftDate").value
        const startTime = document.getElementById("startTime").value
        const endTime = document.getElementById("endTime").value

        
        try {
            const response = await fetch("api/acnt/shifts.php", {
                method: "POST",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(cred)
            })
    
            const rj = await response.json() // was json
            console.log(rj);
            // Do work with the response
            displaySignupError(rj);
            if (rj.hasOwnProperty("error")) {
                console.error("SIGNUP ERROR: " + rj.error)
            } else {
                console.log(rj.response)
            }
            
        } catch (e) {
            console.error("There was a problem", e)
        }
    });

});
