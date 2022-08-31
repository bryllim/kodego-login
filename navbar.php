<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand mx-5" href="dashboard.php">To-Do List</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mx-5 mb-2 mb-lg-0">
                <?php
                    if(!isset($_SESSION["loggedin"])){
                        echo '<li class="nav-item">
                                    <a class="nav-link" href="login.php">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="register.php">Register</a>
                                </li>';
                    }else{
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="logout.php">Logout</a>';
                        echo '</li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>