const logout = async eventObj => {
    try {
        const response = await fetch("api/acnt/logout.php")
    } catch (e) {
        console.error("There was a problem", e)
    }
}