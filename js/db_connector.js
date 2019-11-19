const more = async () => {
    const visitsResponse = await fetch("visits.php", {
        credentials: "same-origin"
    })
    const jsonResponse = await visitsResponse.json()
    document.getElementById("visit-count").innerHTML = jsonResponse.visits
}


const get = async(str) => {
    const response = await fetch(str, {
        credentials: "same-origin"
    })
    const res_json = await response.json()
    return res_json
}

function db_demo() {
    console.log("Calling the database..")
    const result = get("php/query_handler.php?table=Topic")
    console.log(result)
}