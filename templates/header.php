<?php
// initialize the session
session_start();
?>

<!-- html boiler plate code -->
<!DOCTYPE HTML> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>PHP Final Assignment</title>  
</head>
<body>
    <div id="container">
        <!-- header part -->
        <header id="banner">
            <h1>Final Assignment</h1>
            <h3>Users' Info Using PHP with MySQL</h3>
        </header>
        <!-- main part -->
        <main>
            <!-- nav bar which includes links of different pages -->
            <div id="nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="member.php">Member</a></li>
                    <!-- if user is already logged in, it redirects to the logout.php -->
                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a href="logout.php">Logout</a></li>
                    <!-- if user is not logged in, it redirects to the register.php -->
                    <?php else: ?>
                        <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                    <!-- link to the contact page -->
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="main-content">