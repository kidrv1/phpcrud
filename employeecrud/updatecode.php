<?php
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
            echo "<script type='text/javascript'>
        window.location='../index.php';
        alert('Employee Updated');
        </script>";
        }
        else
        {
            echo '<script> alert("Employee Not Updated"); </script>';
        }
    }
?>