


<?php
    require_once "../connect.php"; 
    session_start();
    $resp["response"] = "none";

    // either find a way to make the check work or remove check
    if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {  
        echo json_encode($_SESSION); // bad practice?
        exit();
    }
?>