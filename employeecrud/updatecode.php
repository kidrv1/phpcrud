<?php
session_start();

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $department = $_POST['department'];

        $query = "UPDATE employees SET fname='$fname', lname='$lname', email='$email', department=' $department' WHERE id='$id'  ";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            $_SESSION['status'] = "Employee updated successfully!";
            header('location: ../index.php');
        }
        else
        {
            $_SESSION['status'] = "Failed to update employee";
            header('location: ../index.php');
        }
    }
?>