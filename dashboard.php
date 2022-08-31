<?php
session_start();

if(!isset($_SESSION["loggedin"])){
    header("location: login.php");
    exit;
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
                        <tr>
                            <td>Make coffee</td>
                            <td>
                                <span class="badge bg-light text-dark">Pending</span>
                            </td>
                            <td>
                                <a class="actionicon" href="#">✅</a> &nbsp; <a class="actionicon" href="#">❌</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Cook eggs</td>
                            <td>
                                <span class="badge bg-success">Completed</span>
                            </td>
                            <td>
                                <a class="actionicon" href="#">✅</a> &nbsp; <a class="actionicon" href="#">❌</a>
                            </td>
                        </tr>
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
                <form action="createtask.php" method="POST">
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