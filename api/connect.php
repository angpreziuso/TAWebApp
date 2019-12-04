<?php

$dbLink = mysqli_connect('127.0.0.1', 'root', '', "CLEF");
mysqli_select_db($dbLink, 'CLEF');
if(!$dbLink) {
    die("Connection Failed: ".mysqli_connect_error());
}

define("STU", 1);
define("TA", 2);
define("PROF", 3);
define("ADMIN", 4);

function query($query){
    global $dbLink;
    $result = mysqli_query($dbLink, $query) or die(mysqli_error($dbLink));
    $topics = array();
    if ($result != null) {
        while ($topic = $result->fetch_assoc()) {
            $topics[] = $topic;
        }
        return json_encode($topics);
    } else {
        return null;
    }
}

?>