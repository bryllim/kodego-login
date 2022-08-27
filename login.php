<?php
// Initialize the session
session_start();

// Check if the user is already logged in
if(isset($_SESSION["loggedin"])){
    header("location: dashboard.php");
    exit;
}

// include config file
require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "s", $_POST["username"]);

        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) ==  1){
                
                mysqli_stmt_bind_result($stmt, $id, $_POST["username"], $password);

                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($_POST["password"], $password)){
        
                        session_start();

                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $_POST["username"];

                        header("location: dashboard.php");

                    }else{
                        $errorMessage = "Invalid username or password!";
                    }
                }else{
                    $errorMessage = "Something went wrong! Try again later.";
                }
                mysqli_stmt_close($stmt);
            }else{
                $errorMessage = "User not found!";
            }
        }
    }
    mysqli_close($link);
}


?>

<!DOCTYPE html>

<head>
    <title>Demo - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>Login to your account</h2>
                <p>Fill in the fields below to login.</p>
                <hr>
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <?php
                            if(isset($errorMessage)){
                                echo '<div class="alert alert-danger" role="alert">';
                                echo $errorMessage;
                                echo '</div>';
                            }
                        ?>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>