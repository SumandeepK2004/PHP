<?php
// include the database configuration file
include 'config/dbconfig.php';

// initialize the variable message
$message = '';

// if else statement which ensures that the form submit through post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // retrieves email and password from the form
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // ensures that both email and password should be filled and format of the email should be correct
    if (!empty($email) && !empty($password)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // check the provided email and password is matched with the table
            $stmt = $pdo->prepare("SELECT * FROM website.visiters WHERE email = :email AND password = :password");
            $stmt->execute(['email' => $email, 'password' => $password]);
            // if the data is correct then it stores email in session and redirects to member.php
            if ($stmt->rowCount() > 0) {
                $_SESSION['user'] = $email; 
                header('Location: member.php');
                exit;
            // show error if data is invalid
            } else {
                $message = 'Invalid email or password.';
            }
            // show error if format is not correct
        } else {
            $message = 'Invalid email format.';
        }
    // show the message if fields are empty
    } else {
        $message = 'Please fill in all fields.';
    }
}
// include the header file 
include 'templates/header.php'; ?>

<!-- html boiler plate code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Index Page</title>
</head>
<body>
    <main>
        <!-- login form if the user is not logged in -->
        <?php if (!isset($_SESSION['user'])): ?>
        <form method="post" action="">
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <!-- show error message -->
        <?php if ($message): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    <?php endif; ?>
    </main>
</body>
</html>

<!-- include the footer file -->
<?php include 'templates/footer.php'; ?>