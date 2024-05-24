<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //retrieve from data

   $username=$_POST['username'];
   $password=$_POST['password'];
    
   // database connection
   $host= "localhost";
   $dbUsername = "root"; // This is generally not recommended for production environments
   $dbPassword = ""; // Make sure to use a password in production
   $dbname = "management";

   $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

     // Check connection
     if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
     
    // validate login authentication 
    $query=" SELECT * FROM `users` where username= '$username' AND  password='$password'";
    $result= $conn->query($query);
     if ($result->num_rows==1){
        //login success
        header("Location:admin.php");
        exit();
     }
     else {
        // login fail
        header("Location:error.html");
        exit();
     }

$conn->close();

   }
?>