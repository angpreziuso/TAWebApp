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

    if ($_SERVER['REQUEST_METHOD'] == 'GET') 
    {

    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // POST A NEW SHIFT SLOT TO THE DB
   
        // POST A NEW SHIFT CHAGE REQ TO THE DB
        $person1 = $input->email;
        $person2 = $input->password;
        $date = $input->role;
        $startTime = $input->email;
        $endTime = $input->password;

        $person1 = strip_tags($person1);
        $person2 = strip_tags($person2);
        $date = strip_tags($date);
        $startTime = strip_tags($startTime);
        $endTime = strip_tags($endTime);

        $person1 = mysqli_real_escape_string($dbLink, $person1); 
        $person2 = mysqli_real_escape_string($dbLink, $person2); 
        $date = mysqli_real_escape_string($dbLink, $date); 
        $startTime = mysqli_real_escape_string($dbLink, $startTime); 
        $endTime = mysqli_real_escape_string($dbLink, $endTime); 
        // POST NEW AVAILABILITY
    }
    if ($_SERVER['REQUEST_METHOD'] == 'UPDATE') {}
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {}

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