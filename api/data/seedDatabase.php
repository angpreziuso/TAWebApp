<?php
/*
-- Seeding the database with DEVELOPERS

INSERT INTO CLEF_USER (UserEmail, Password, FirstName, LastName) 
VALUES (
    "moorena@dukes.jmu.edu",
    Password("n-password"),
    "Nathan",
    "Moore"
);

INSERT INTO CLEF_USER (UserEmail, Password, FirstName, LastName) 
VALUES (
    "preziual@dukes.jmu.edu",
    password("a-password"),
    "Angela",
    "Preziuso"
);

INSERT INTO CLEF_USER (UserEmail, Password, FirstName, LastName) 
VALUES (
    "parrbt@dukes.jmu.edu",
    password("b-password"),
    "Brandon",
    "Parr"
);

INSERT INTO CLEF_USER (UserEmail, Password, FirstName, LastName) 
VALUES (
    "ehrlicjd@dukes.jmu.edu",
    Password("j-password"),
    "Josh",
    "Ehrlich"
);


INSERT INTO CLEF_USER (UserEmail, Password, FirstName, LastName) 
VALUES (
    "securboid@dukes.jmu.edu",
    Password("m-password"),
    "Mr.",
    "Security"
);
-- using NOW() ...
-- This may result in an error telling you to upgrade mysql. I think I found a 
-- workaround for this error by 
--  $ sudo /Applications/xampp/xamppfiles/bin/mysql_upgrade -u root

-- This may be different depending on your install path.


-- Theses numbers correspond to which developer and role we have, this would normally 
-- be done in some kind of script but for this specific purpose it is enough
INSERT INTO USER_ROLE (UserID, RoleID, StartDate) VALUES (1, 4, NOW());
INSERT INTO USER_ROLE (UserID, RoleID, StartDate) VALUES (2, 4, NOW());
INSERT INTO USER_ROLE (UserID, RoleID, StartDate) VALUES (3, 4, NOW());
INSERT INTO USER_ROLE (UserID, RoleID, StartDate) VALUES (4, 4, NOW());

-- Lets add Nathan as a student as well.. 
INSERT INTO USER_ROLE (UserID, RoleID, StartDate) VALUES (1, 1, NOW());

-- Angie as a TA..
INSERT INTO USER_ROLE (UserID, RoleID, StartDate) VALUES (2, 2, NOW());

-- and Josh as a professor. 
INSERT INTO USER_ROLE (UserID, RoleID, StartDate) VALUES (4, 3, NOW());

-- adding mr security as a student
INSERT INTO USER_ROLE (UserID, RoleID, StartDate) VALUES (5, 1, NOW());

-- (example queries)
-- ------------------------ SHOW ALL ACTIVE ROLES IN THE SYSTEM ----------------------
SELECT FirstName, RoleName, StartDate, UserEmail 
FROM USER_ROLE 
    INNER JOIN Clef_User ON clef_user.UserID = USER_ROLE.UserID 
    INNER JOIN Role ON Role.RoleID = USER_ROLE.RoleID
WHERE USER_ROLE.EndDate IS NULL;
-- ------------------------------------------------------------------------------------

-- ------------------------- SELECT ALL STUDENTS IN THE SYSTEM ------------------------
SELECT FirstName, RoleName, StartDate, UserEmail 
FROM USER_ROLE 
    INNER JOIN Clef_User ON clef_user.UserID = USER_ROLE.UserID 
    INNER JOIN Role ON Role.RoleID = USER_ROLE.RoleID
WHERE USER_ROLE.RoleID = 1;
-- ------------------------------------------------------------------------------------

*/

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