<?php
session_start();

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

if(isset($_POST['insertdata']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    $query = "INSERT INTO employees (`fname`,`lname`,`email`,`department`) VALUES ('$fname','$lname','$email','$department')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Employee added successfully!";
        header('location: ../index.php');

    }
    else
    {
        $_SESSION['status'] = "Failed to add employee";
        header('location: ../index.php');
    }
}

?>