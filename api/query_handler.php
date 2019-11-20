<?php
    session_start();
    $dbLink = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($dbLink, 'clefDB');

    function query($query){
        global $dbLink;
        $result = mysqli_query($dbLink, $query) or die();
        return $result;
    }

    $table = isset($_GET['table']) ? $_GET['table'] : null;
    
    if ($table != null) {
        
        $result = query("SELECT * FROM " . $table);
        // $stmt = $dbLink->prepare($q);
        // echo mysqli_error($dbLink);
        // $stmt->bind_param("s", $table);
        // $stmt->execute();
        // $result = $statment->get_result();
        
        $topics = array();
        if ($result != null) {
            while ($topic = $result->fetch_assoc()) {
                $topics[] = $topic;
            }
            echo json_encode($topics);
            // echo $topics;
        } else {
            echo null;
        }   
    }

?>