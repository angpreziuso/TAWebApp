<?php

require_once "databaseHandler.php";

//ClefUser --> UserID, UserEmail, Password, FirstName, LastName
//UserRole --> UserID RoleID, StartTime, EndTime

 session_start();

$loggingIn = trim($_POST["login"]); //When the user hits the login button
$username = trim($_POST["username"]);
$password = trim($_POST["password"]);
$roleID = trim($_POST["role"]);


if($loggingIn)
{
    $username = strip_tags($username);
    $password = strip_tags($password);

    $username = mysqli_real_escape_string($username); 
    $password = mysqli_real_escape_string($password); 


    if(empty($username)) //Is the username Empty?
    {
        $username_err = "Please enter username.";
    } 

    if(empty($password))
    {
        $password_err = "Please enter your password.";
    } 

}

if(isset($loggingIn))
{
        $sqlUsername = "SELECT * FROM CLEF_USER WHERE username=? LIMIT 1"; // IDK if this is correct
        $stmt = mysqli_stmt_init($connection);

        if($stmt = mysqli_prepare($connection, $stmt))
        {
            mysqli_bind_param($stmt, "s", $username);
            
            if(mysqli_stmt_execute($stmt))
            {
                $results =  mysqli_stmt_store_result($stmt);
                echo $results;
            }
            


            if($row = mysqli_fetch_assoc($results))
            {
                $pwdCheck = password_verify($password, $row["password"]);
                
                if($pwdCheck == false)
                {
                    header("Location: ./index.html?error=invalidPassword");
                }
                else
                {
                    //session_start();
                    $_SESSION["userEmail"] = $row["email"];
                    $_SESSION["userUID"] = $row["userID"];

                    header("Location: ./index.html?loggedin");
                    exit();
                }
            }
            else
            {
                header("Location: ./index.html?error=invalidUser");
            }
        }
    
}
?>
