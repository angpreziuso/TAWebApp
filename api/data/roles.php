
<?php

// TODO put in connect.php
function query($query){
    global $dbLink;
    $result = mysqli_query($dbLink, $query) or die();
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

$dbLink = mysqli_connect('localhost', 'root', '');
mysqli_select_db($dbLink, 'CLEF');

// Find out which chunk of data the site is asking for
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo query("SELECT RoleID, RoleName FROM Role");
}
?>