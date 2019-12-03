 <?php 

require_once "../connect.php"; 



// query("DELETE FROM CLEF_USER");
$rows_affected = 0;

if(isset($_POST["signup-submit"])) // The user actually hit the sign up button
{
    echo "hello";

    $email = $_POST["email"];
    $role = $_POST["role"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $password = $_POST["password"];

    echo "Here ".$email;


    add_user_to_system($email, $password, $firstName, $lastName, $role);

}


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




//Name of signup submit button = signup-submit



