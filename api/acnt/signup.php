<?php 

if(isset($_POST["sign-up"])) // The user actually hit the sign up button
{
    require "databaseHandler.php";

    //$username = $_POST["username"]
    $email = $_POST["email"];
    $password = $_POST["psw"];
    $password_repeat = $_POST["psw-repeat"];



    //This is where we can do error checking.
    if(empty($email) || empty($password) || empty($password_repeat)) // Check for empty fields
    {
        header("Location: ./index.html?error=emptyfield&email=".$email);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) // Check for valid email
    {
        header("Location: ./index.html?error=invalidEmail");
        exit();
    }
    else if($password !== $password_repeat)// Check for matching passwords
    {
        header("Location: ./signup.php?error=mismatchPassword&email=".$email);
        exit();
    }
    else //Username/email already exists
    {
        $sql = "SELECT email FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($connection);

        if(mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ./index.html?error=SQLerror");
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_num_rows($stmt);

            if($results > 0)
            {
                header("Location: ./index.html?error=emailTaken");
            }
            else //Insert them into the database
            {
                $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($connection);

                if(mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ./index.html?error=SQLerror");
                }
                else
                {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
                    mysqli_stmt_execute($stmt);
                    header("Location: ./index.html?signup=success");
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);



}
else
{
    header("Location: ./signup.php");
    exit();
}