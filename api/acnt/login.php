<?php

 require_once "../connect.php"; 

//ClefUser --> UserID, UserEmail, Password, FirstName, LastName
//UserRole --> UserID RoleID, StartTime, EndTime

session_start();

$resp["response"] = "Nothing has been done yet";

// THIS CHECK MAKES THINGS BREAK
// either find a way to make the check work or remove check
if(isset($_POST["login-submit"]))
{ 
    $input = file_get_contents('php://input');
    $cred = json_decode($input);
    $email = $cred->email;
    $password = $cred->password;
    $roleID = $cred->role;

    if(empty($email)) //Is the username Empty?
    {
        $email_err = "Please enter username.";
        exit();
    } 

    if(empty($password))
    {
        $password_err = "Please enter your password.";
        exit();
    } 

        
    $username = strip_tags($email);
    $password = strip_tags($password);

    $username = mysqli_real_escape_string($dbLink, $email); 
    $password = mysqli_real_escape_string($dbLink, $password); 

    $sql = "SELECT * FROM CLEF_USER INNER JOIN USER_ROLE ON CLEF_USER.userID = USER_ROLE.userID WHERE UserEmail=? AND USER_ROLE.roleID=?"; 

    $stmt = mysqli_prepare($dbLink, $sql);
    mysqli_stmt_bind_param($stmt, "si", $email, $roleID); 
    
    if(!$stmt)
    {
        header("Location: ../../index.html?error=SQLError ");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $results =  mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($results))
    {
        $pwdCheck = password_verify($password, $row["Password"]); // In the DB password is uppercase
        
        if($pwdCheck)
        {
            session_start();
            $_SESSION["userEmail"] = $row["UserEmail"];
            $_SESSION["userID"] = $row["userID"];
            header("Location: ../../forum.html?loggedin");
            $resp["firstName"] = $row["firstName"];
            echo "yuh yeet";
            exit();
        }
        else
        {
            header("Location: ./index.html?error=badPassword");
        }
    }
    else
    {
        header("Location: ./index.html?error=invalidUser");
    }
    
    
    mysqli_stmt_close($stmt);
} else {
    // Remember that the frontend is expecting a response in JSON. 
    // setting this field in the resp assoc array and echo json_encode($resp)
    // will, for login at least, give us a way to view the behaviour of this script
    $resp["response"] = "Dear Nathan, fuck you. Sincerely, PHP.";
    echo json_encode($resp);
}

?>