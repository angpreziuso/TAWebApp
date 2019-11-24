<?php
require "../connect.php";

// query("DELETE FROM CLEF_USER");
$rows_affected = 0;


/**
 * Function utilizes three peices: 
 *      1. Insert user into clef_user table
 *      2. grab the generated user id
 *      3. insert the user into the user_role table
 */
function add_user_to_system($email, $password, $firstName, $lastName, $role) {
    global $rows_affected;
    global $dbLink;
    // role is not a string
    $username = mysqli_real_escape_string($dbLink, $email); 
    $password = mysqli_real_escape_string($dbLink, $password); 
    $firstName = mysqli_real_escape_string($dbLink, $firstName); 
    $lastName = mysqli_real_escape_string($dbLink, $lastName); 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO CLEF_USER (UserEmail, Password, FirstName, LastName) VALUES (?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($dbLink, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $email, $hashedPassword, $firstName, $lastName); 

    if(!$stmt) {
        printf("Malformed statement\n");
        exit();
    }

    $rows_affected += mysqli_stmt_execute($stmt);

    // user should be in the table now. Get the generated user id

    $sql = "SELECT userID FROM CLEF_USER WHERE UserEmail=?";
    $stmt = mysqli_prepare($dbLink, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($results)) {
        $userID = $row["userID"];
    } else {
        printf("Error inserting new user to the database\n");
        exit();
    }

    // add the role information

    $sql = "INSERT INTO USER_ROLE (UserID, RoleID, StartDate) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($dbLink, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $userID, $role);
    $rows_affected += mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
}

// TODO make this into a post response?
define("STU", 1);
define("TA", 2);
define("PROF", 3);
define("ADMIN", 4);

// Add all of us as administrators
add_user_to_system("moorena@dukes.jmu.edu", "n-password", "Nathan", "Moore", ADMIN);
add_user_to_system("preziual@dukes.jmu.edu", "a-password", "Angela", "Preziuso", ADMIN);
add_user_to_system("parrbt@dukes.jmu.edu", "b-password", "Brandon", "Parr", ADMIN);
add_user_to_system("ehrlicjd@dukes.jmu.edu", "j-password", "Josh", "Ehrlich", ADMIN);

// Lets add Nathan as a student as well.. 
add_user_to_system("moorena@dukes.jmu.edu", "n-password", "Nathan", "Moore", STU);

// Angie as a TA..
add_user_to_system("preziual@dukes.jmu.edu", "a-password", "Angela", "Preziuso",TA);

// and Josh as a professor. 
add_user_to_system("ehrlicjd@dukes.jmu.edu", "j-password", "Josh", "Ehrlich", PROF);



?>