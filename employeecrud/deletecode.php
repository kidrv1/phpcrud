<?php
session_start();

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM employees WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Employee deleted successfully!";
        header('location: ../index.php');
    }
    else
    {
        $_SESSION['status'] = "Failed to delete employee";
        header('location: ../index.php');
    }
}

?>