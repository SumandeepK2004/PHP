<?php
// include the config file
include 'config/dbconfig.php';
// initialize the variable
$message = '';

// check if the form is submitted through post method and retrieves the following values
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // // ensures that both email and password should be filled and format of the email should be correct
    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // check the provided email and password is already exist or not
            $stmt = $pdo->prepare("SELECT * FROM website.visiters WHERE email = :email");
            $stmt->execute(['email' => $email]);
            // if row count is 0 then the email does not exist
            if ($stmt->rowCount() === 0) {
                // insert the new user
                $stmt = $pdo->prepare("INSERT INTO website.visiters (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
                $stmt->execute([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => $password
                ]);
                // set the user email in session
                $_SESSION['user'] = $email;
                // redirect to member.php
                header('Location: member.php');
                exit;
            // show message if email already exists
            } else {
                $message = 'Email already exists.';
            }
        // show message if format is invalid
        } else {
            $message = 'Invalid email format.';
        }
    // show message if fields are empty
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
    <title>Document</title>
</head>
<body>
    <main>
        <!-- registration form -->
        <form method="post" action="register.php">
            <label>First Name:</label>
            <input type="text" name="first_name" required>
            <label>Last Name:</label>
            <input type="text" name="last_name" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <!-- display error messages -->
        <?php if ($message): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </main>
<!--  include the footer file -->
<?php include 'templates/footer.php'; ?>
</body>
</html>


