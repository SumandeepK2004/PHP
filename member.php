<?php
// start the session or resumes the existing session
session_start();
// if else statement to check that the user is logged in if not then it redirects the user ti index.php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// retrieves the email of logged-in user
$user_email = $_SESSION['user'];
// include the config file
include 'config/dbconfig.php';

// check the provided email and password is matched with the table
$stmt = $pdo->prepare("SELECT * FROM website.visiters WHERE email = :email");
// retrieves the user data from the table
$stmt->execute(['email' => $user_email]);
// collect all the information from the table
$user = $stmt->fetch();
// include the header file
include 'templates/header.php'; ?>

<!-- html boiler plate code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
</head>
<body>
    <!-- code inside main -->
    <main>
        <h2>Welcome, <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?>!</h2>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    </main>
    
<!-- include the footer file -->
<?php include 'templates/footer.php';?>

</body>
</html>





