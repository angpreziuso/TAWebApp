<?php
    session_start();
    $dbLink = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($dbLink, 'clefDB');

    function query($query){
        global $dbLink;
        $result = mysqli_query($dbLink, $query) or die(mysqli_error($dbLink));
        return $result;
    }

    $table = isset($_GET['table']) ? $_GET['table'] : null;
    
    if ($table != null) {
        $result = query("SELECT * FROM " . $table);
        $topics = array();
        if ($result != null) {
            while ($topic = $result->fetch_assoc()) {
                $topics[] = $topic;
            }
            echo json_encode($topics);
        } else {
            echo null;
        }   
    }

?>