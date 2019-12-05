<?php
require "../connect.php";

$resp["role"] = "none";

session_start();
if (!isset($_SESSION["role"])) {
    $resp["error"] = "ERROR: roleID not set";
} else {
    $resp["role"] = $_SESSION["role"];
}
echo json_encode($resp);
?>