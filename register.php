<?php

//Include config file
require_once 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["username"]) && !empty($_POST["password"])){

        if($_POST["password"] == $_POST["confirmpassword"]){

            $sql = "INSERT INTO users (username, password) VALUES (?,?)";

            if($stmt = mysqli_prepare($link, $sql)){
                $param_username = $_POST["username"];
                $param_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
                
                if(mysqli_stmt_execute($stmt)){
                    header("location: login.php");
                }else{
                    $errorMessage = "Username already exists!";
                }
                mysqli_stmt_close($stmt);
            }
            
        }else{
            $errorMessage = "Passwords do not match!";
        }
    }else{
        $errorMessage = "Username or password must not be empty!";
    }

    mysqli_close($link);
}

?>

<!DOCTYPE html>

<head>
    <title>Demo - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>Create an account</h2>
                <p>Fill in the fields below to create your account.</p>
                <hr>
                <form method="POST" action="register.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmpassword" id="password" required>
                    </div>
                    <?php
                            if(isset($errorMessage)){
                                echo '<div class="alert alert-danger" role="alert">';
                                echo $errorMessage;
                                echo '</div>';
                            }
                        ?>
                    <button type="submit" class="btn btn-primary">Create an account</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>