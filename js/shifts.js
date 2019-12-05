window.addEventListener('DOMContentLoaded', (event) => {

var submit = document.getElementById("submit");

var list1 = document.getElementById("ListOfTAs1").value;
var list2 = document.getElementById("ListOfTAs2").value;

submit.addEventListener("click", function(){
    fetchShift();
})

console.log(list1)

TA1 = {
    "ta1": list1
}

TA2 = {
    "ta2": list2
}

request = {
    "origin" : "CHANGE_REQ",
    "a" : TA1,
    "b" : TA2
}

async function fetchShift()
{

    console.log(JSON.stringify(request))
    try {
        const response = await fetch("api/data/shifts.php", {
            method: "POST",
            credentials: "same-origin",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(request)
        })

        const rj = await response.json() // was json
        if (rj.hasOwnProperty("error")) {
            console.error("Shift change error: " + rj.error)
        } else {
            console.log(rj.response)
        }
        
    } catch (e) {
        console.error("There was a problem", e)
    }
}
});


async function shift_demo() {
    const response = await fetch("api/data/shifts.php", {
        method: "GET",
        credentials: "same-origin",
        origin: "shift_demo",
        headers: {
            'Content-Type': 'application/json'
        }
    })

    const rj = await response.json()
    console.log(rj);
}
