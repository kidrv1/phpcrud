<?php

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
        echo "<script type='text/javascript'>
        window.location='../index.php';
        alert('Employee Saved');
        </script>";
    }
    else
    {
        echo "<script> alert('Employee Not Saved'); </script>";
    }
}

?>