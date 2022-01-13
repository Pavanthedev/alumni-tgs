<?php
include_once 'db_connect.php';
if(isset($_POST['Submit']))
{    
     $name = $_POST['name'];
     $username = $_POST['username'];
     $password = $_POST['password'];
     $sql = "INSERT INTO users (name,username,password)
     VALUES ('$name','$username','$password')";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>