<?php

if(isset($_POST["login"]))
{
    require "databaseHandler.php"; //gets the database connection 

    $email = $_POST["email"];
    $password = $_POST["psw"];

    if(empty($email) || empty($password))
    {
        header("Location: ./index.html?error=emptyField");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($connection($stmt, $sql));


        if(!mysqli_stmt_prepare)
        {
            header("Location: ./index.html?error=SQLError");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($results))
            {
                $pwdCheck = password_verify($password, $row["password"]);
                
                if($pwdCheck == false)
                {
                    header("Location: ./index.html?error=invalidPassword");
                }
                else
                {
                    session_start();
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
}
else
{
    header("Location: ./index.html");
    exit();
}