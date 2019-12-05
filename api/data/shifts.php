<?php
    require_once "../connect.php"; 

    session_start();
    $resp["response"] = "none";

    $input = file_get_contents('php://input');
    $input = json_decode($input);

    //echo $input;

    // This aint gonna work 
    // if (!verify_use($input)) {
    //     $resp["error"] = "You do not have permission to access this data";
    //     echo json_encode($resp);
    //     exit();
    // }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        // clef_user.userid, clef_user.firstName, clef_user.lastName, shift.shiftDay, shift.beginTime, shift.endTime, courseID
        echo query("SELECT CLEF_USER.UserID, CLEF_USER.FirstName, CLEF_USER.LastName, SHIFT.ShiftDay, SHIFT.BeginTime, SHIFT.EndTime, courseID, scheduled FROM SHIFT_DUTY INNER JOIN SHIFT ON (SHIFT_DUTY.ShiftID = SHIFT.ShiftID) INNER JOIN CLEF_USER ON (SHIFT_DUTY.UserID = CLEF_USER.UserID)");
        exit();
        // $stmt = mysqli_prepare($dbLink, $sql);
        // mysqli_stmt_execute($stmt);
        // $results =  mysqli_stmt_get_result($stmt);
        // $resp = mysqli_fetch_assoc($results);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $resp["error"] = "api/data/shifts.php ->".$_SERVER["REQUEST_METHOD"].": NOT IMPLEMENTED";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'UPDATE') {
        $resp["error"] = "api/data/shifts.php ->".$_SERVER["REQUEST_METHOD"].": NOT IMPLEMENTED";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        $resp["error"] = "api/data/shifts.php ->".$_SERVER["REQUEST_METHOD"].": NOT IMPLEMENTED";
    }

    echo json_encode($resp);

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