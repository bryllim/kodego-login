<?php
session_start();

if(!isset($_SESSION["loggedin"])){
    header("location: login.php");
    exit;
}

//Include config file
require_once 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST["task"])){

        $sql = "INSERT INTO tasks (name, status, user_id) VALUES (?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            $status = "Pending";
            mysqli_stmt_bind_param($stmt, "ssi", $_POST["task"], $status, $_SESSION["id"]);
            if(mysqli_stmt_execute($stmt)){
                $_SESSION["successMessage"] = "Task successfully added!";
            }else{
                $errorMessage = "Error querying into the database!";
            }
            mysqli_stmt_close($stmt);
        }

    }else{
        $errorMessage = "Task cannot be empty!";
    }
}

?>

<!DOCTYPE html>

<head>
    <title>Demo - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    .actionicon {
        text-decoration: none;
    }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>Welcome,
                    <?php
                    echo $_SESSION["username"];
                ?>!
                </h2>
            </div>
        </div>
        <hr>
        <?php
            if(isset($errorMessage)){
                echo '<div class="alert alert-danger" role="alert">';
                echo $errorMessage;
                echo '</div>';
            }

            if(isset($_SESSION["successMessage"])){
                echo '<div class="alert alert-success" role="alert">';
                echo $_SESSION["successMessage"];
                echo '</div>';
                unset($_SESSION["successMessage"]);
            }
        ?>
        <div class="row">
            <div class="col-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Create New
                    Task</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Task</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT id, name, status FROM tasks WHERE user_id = ? ORDER BY id DESC";
                            if($stmt = mysqli_prepare($link, $sql)){
                                mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);
                                if(mysqli_stmt_execute($stmt)){
                                    mysqli_stmt_store_result($stmt);
                                    if(mysqli_stmt_num_rows($stmt) > 0){
                                        mysqli_stmt_bind_result($stmt, $id, $name, $status);
                                        while(mysqli_stmt_fetch($stmt)){
                                            echo '
                                                <tr>
                                                    <td>'.$name.'</td>
                                                    <td>
                                                        <span class="badge '.(($status=="Pending")?'bg-light text-dark':'bg-success').'">'.$status.'</span>
                                                    </td>
                                                    <td>
                                                        <a class="actionicon" href="#">✅</a> &nbsp;
                                                        <form method="POST" action="deletetask.php">
                                                            <input type="hidden" name="task_id" value="'.$id.'" />
                                                            <button type="submit" class="actionicon">❌</a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                    }else{
                                        echo "<tr><td><h3>There are currently no tasks.</h3></td></tr>";
                                    }
                                    
                                }else{
                                    $errorMessage = "Something went wrong.";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create a New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="dashboard.php" method="POST">
                    <div class="modal-body">
                        <input type="text" class="form-control" name="task" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>