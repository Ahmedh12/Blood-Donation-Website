<?php
         $host='localhost';
         $username='root';
         $password='mysql';
         $database='bloodbank';


         $conn=new mysqli($host,$username,$password,$database);
            if (mysqli_connect_errno()) 
                die("Failed to connect to MySQL: " . $conn->connect_error);
?>
        
