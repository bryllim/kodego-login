<?php

//Include config file
require_once 'config.php';

$username = $password = $confirm_password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["username"]) && !empty($_POST["password"])){

        if($_POST["password"] == $_POST["confirmpassword"]){

            $sql = "SELECT id FROM users WHERE username ?";

            mysqli_prepare($link, $sql);

        }else{
            $errorMessage = "Passwords do not match!";
        }
    }else{
        $errorMessage = "Username or password must not be empty!";
    }
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