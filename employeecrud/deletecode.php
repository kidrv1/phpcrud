<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'phpcrud');

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM employees WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo "<script type='text/javascript'>
        window.location='../index.php';
        alert('Employee Removed');
        </script>";
    }
    else
    {
        echo '<script> alert("Employee Not Deleted"); </script>';
    }
}

?>