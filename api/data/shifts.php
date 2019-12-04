<?php
    require_once "../connect.php"; 

    session_start();
    $resp["response"] = "none";

    $input = file_get_contents('php://input');
    $input = json_decode($input);
    if (!verify_use($input)) {
        $resp["error"] = "You do not have permission to access this data";
        echo json_encode($resp);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $resp["error"] = "api/data/shifts.php ->" . $_SERVER["REQUEST_METHOD"].": NOT IMPLEMENTED";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // POST A NEW SHIFT SLOT TO THE DB

        // POST A NEW SHIFT CHAGE REQ TO THE DB

        // POST NEW AVAILABILITY
        $resp["error"] = "api/data/shifts.php ->" . $_SERVER["REQUEST_METHOD"]. ": NOT IMPLEMENTED";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'UPDATE') {
        $resp["error"] = "api/data/shifts.php ->" . $_SERVER["REQUEST_METHOD"].": NOT IMPLEMENTED";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        $resp["error"] = "api/data/shifts.php ->" . $_SERVER["REQUEST_METHOD"].": NOT IMPLEMENTED";
    }

    function verify_use($input) {
        // ADMIN can preform all tasks. 
        if ($_SESSION["role"] == ADMIN) {
            return true; 
        }

        if($_SESSION["role"] == TA) {
            // only be able to POST SHIFT_CHANGE_REQ
            if ($input["origin"] == "CHANGE_REQ") {
                return true;
            }
        }

        return false;
    }

?>