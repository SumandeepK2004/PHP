<?php
// configuration of database
// hostname
$host = 'localhost'; 
// Database name
$dbname = 'Website'; 
 // Database username    
$username = 'root';  
// Database password    
$password = '';  

// variable which stores the value of databse we are using
$dsn = "mysql:host=$host;dbname=$dbname; port=3307"; 
try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);
   // message which shows our connection is successful 
   
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    echo "Database connection successful."; 

} catch (PDOException $e) {
    // Handle connection error
    echo "Database connection failed: " . $e->getMessage();
   // Stop execution if the connection fails 
    exit(); 
}
?>