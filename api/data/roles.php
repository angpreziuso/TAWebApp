
<?php

require "../connect.php";

// Find out which chunk of data the site is asking for
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo query("SELECT RoleID, RoleName FROM ROLE");
}

?>