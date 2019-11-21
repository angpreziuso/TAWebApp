

function login(cred) {
    // Check the format of the incoming login request
    if (!(cred.has("email") && cred.has("password") && cred.has("role"))) {
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
        console.log("response", response)
        const rj = await response.json()
        // Do work with the response
    } catch (e) {
        console.error("e", e)
    }
}
// Example code
/*

const newQuestion = async eventObj => {
    eventObj.preventDefault();
    const authorId = document.getElementById("author").value
    const questionContent = document.getElementById("content").value
    try {
        const response = await fetch("api/v1/questions/new.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                content: questionContent,
                author: authorId
            })
        })
        console.log("response", response)
        const rj = await response.json()
        addLocalQuestion(rj.qid, rj.author, rj.content)
    } catch (e) {
        console.error("e", e)
    }
}

*/
