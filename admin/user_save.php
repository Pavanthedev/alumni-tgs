<!DOCTYPE html>
<html>
  
<head>
    <title>Insert Page page</title>
</head>
  
<body>
    <center>
        <?php
  
        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        $conn = mysqli_connect("localhost", "root", "", "alumni_db");
          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
    
        $firstname = $_REQUEST['firstname'];	
        $middlename = $_REQUEST['middlename'];	
        $lastname = $_REQUEST['lastname'];	
        $gender = $_REQUEST['gender'];	
        $batch = $_REQUEST['batch'];	
        $email = $_REQUEST['email'];	
        $avatar = $_REQUEST['img'];
        $password = $_REQUEST['password'];
                        
        $SQL = "INSERT INTO alumnus_bio VALUES ('$firstname','$middlename','$lastname','$gender','$batch','$email','$avatar','$password')";

        if(mysqli_query($conn, $SQL)){
            echo "<h3>data stored in database successfully."
                . "Please browse your localhost php my admin"
                . "to view the updated data</h3>";            
        }
        else{
            echo "ERROR: Hush! sorry $sql."
                . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
        ?>
        </center>
    </body>
</html>