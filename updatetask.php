<?php

session_start();

//Include config file
require_once 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $sql = "UPDATE tasks SET status = 'Completed' WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $_POST["task_id"]);
        if(mysqli_stmt_execute($stmt)){
            $_SESSION["successMessage"] = "Task successfully completed!";
            header("location: dashboard.php");
        }else{
            $errorMessage = "Error querying into the database!";
        }
        mysqli_stmt_close($stmt);
        
    }
}

?>