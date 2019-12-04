window.addEventListener('DOMContentLoaded', (event) => {
console.log("loaded");

    const submit = document.getElementById("submit");

    submit.addEventListener("click" , async function(eventObj)
    {
        eventObj.preventDefault();

        const person1Name = document.getElementById("person1Name").value
        const person2Name = document.getElementById("person2Name").value
        const shiftDate = document.getElementById("shiftDate").value
        const startTime = document.getElementById("startTime").value
        const endTime = document.getElementById("endTime").value

        input = {
            origin: "CHANGE_REQ",
            person1: person1Name,
            person2: person2Name,
            shiftDate: shiftDate,
            startTime: startTime,
            endTime: endTime
        }

        if (!(input.hasOwnProperty("person1") && input.hasOwnProperty("person2") && input.hasOwnProperty("shiftDate") 
            && input.hasOwnProperty("startTime") && input.hasOwnProperty("endTime"))) 
        {
            
                console.error("The incoming credentials were malformed and the login request was unable to be completed.");         
                return false; 
        }
        
        try {
            const response = await fetch("api/data/shifts.php", {
                method: "POST",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(input)
            })
    
            const rj = await response.json() // was json
            console.log(rj);
            // Do work with the response
            // displayLoginError(rj);
            // if (rj.hasOwnProperty("error")) {
            //     console.error("SIGNUP ERROR: " + rj.error)
            // } else {
            //     console.log(rj.response)
            // }
            
        } catch (e) {
            console.error("There was a problem", e)
        }
    });


    // function displayLoginError(res) {
    //     var msg = document.getElementById("loginResponseMsg");
    //     if(res.hasOwnProperty("error")) {
    //         msg.style.display = "block";
    //         msg.style.color = "red";
    //         msg.innerHTML = res.error;
    //     } else {
    //         msg.style.display = "block";
    //         msg.style.color = "green";
    //         msg.innerHTML = res.response;
    //     }
    // }

});
