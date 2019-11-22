<?php

 require_once "../connect.php"; 

//ClefUser --> UserID, UserEmail, Password, FirstName, LastName
//UserRole --> UserID RoleID, StartTime, EndTime

 session_start();

if(isset($_POST["login-submit"]))
{ 
    //echo "hello";
    // $loggingIn = trim($_POST["login"]); //When the user hits the login button
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $roleID = trim($_POST["role"]);
    
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
    
        $username = mysqli_real_escape_string($email); 
        $password = mysqli_real_escape_string($password); 

        $sql = "SELECT * FROM CLEF_USER WHERE UserEmail=?;"; 
        $stmt = mysqli_stmt_init($dbLink);

    
        if(!mysqli_prepare($stmt, $sql))
        {
            header("Location: ../../index.html?error=SQLError ");
            exit();
        }
        else
        {
            mysqli_bind_param($stmt, "ss", $email, $password); 
            mysqli_stmt_execute($stmt);
            $results =  mysqli_stmt_get_result($stmt);
            
            if($row = mysqli_fetch_assoc($results))
            {
                $pwdCheck = password_verify($password, $row["Password"]); // In the DB password is uppercase
                
                if($pwdCheck == false)
                {
                    header("Location: ../../index.html?error=invalidPassword");
                }
                else
                {
                    session_start();
                    $_SESSION["userEmail"] = $row["UserEmail"];
                    $_SESSION["userID"] = $row["userID"];
    
                    header("Location: ../../forum.html?loggedin");
                    exit();
                }
            }
            else
            {
                header("Location: ./index.html?error=invalidUser");
            }
            
            
            mysqli_stmt_close($stmt);
        }

}
else
{
    header("Location: ../../index.html");
    exit();
}

// if(isset($loggingIn))
// {
//         $sqlUsername = "SELECT * FROM CLEF_USER WHERE username=? LIMIT 1"; // IDK if this is correct
//         $stmt = mysqli_stmt_init($dbLink);

//         if($stmt = mysqli_prepare($stmt, $sqlUsername))
//         {
//             mysqli_bind_param($stmt, "s", $username);
            
//             if(mysqli_stmt_execute($stmt))
//             {
//                 $results =  mysqli_stmt_store_result($stmt);
//                 echo $results;
//             }
            
//             mysqli_stmt_close($stmt);

//         }
    
// }

?>