 <?php 

//Name of signup submit button = signup-submit

if(isset($_POST["signup-submit"])) // The user actually hit the sign up button
{
    require "../connect.php";
    // require "connect.php";

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_repeat = $_POST["password-repeat"];



    //This is where we can do error checking.
    if(empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($password_repeat)) // Check for empty fields
    {
        header("Location: ../../index.html?error=emptyFields&firstName=".$firstName."&lastName=".$lastName."&username=".$username."&email".$email); 
        //If the user filled out the form but something is wrong it will return the form data in the URL
        // Use a get method to inject the information back into the form so they can try again and not retype everything
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) // if all the form is filled out --> Check for valid email
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
        $sql = "SELECT UserEmail FROM CLEF_USER WHERE UserEmail=?;";
        $stmt = mysqli_stmt_init($dbLink);

        if(!mysqli_stmt_prepare($stmt, $sql)) // if it fails
        {
            header("Location: ../../index.html?error=SQLerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $results = mysqli_stmt_num_rows($stmt);

            if($results > 0)
            {
                header("Location: ../../index.html?error=emailTaken");
                exit(); 
            }
            else //Insert them into the database
            {
                $sql = "INSERT INTO CLEF_USER (UserEmail, Password ) VALUES (?, ?);";
                $stmt = mysqli_stmt_init($dbLink);

                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../../index.html?error=SQLerror");
                    exit(); 
                }
                else
                {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../../forum.html?signup=success");
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($dbLink);



}
else
{
    header("Location: ../../index.html");
    exit();
}