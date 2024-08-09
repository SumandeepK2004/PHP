<?php
// include the config file
include 'config/dbconfig.php';
// initialize the variable
$message = '';

// method should be post and retrieves the data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message_content = $_POST['message'] ?? '';

    // ensures that the full name, email and message should not be empty
    if (!empty($full_name) && !empty($email) && !empty($message_content)) {
        // email format should be correct
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // recipients email address
            $to = 'sumandeepk102004@gmail.com';
            // subject
            $subject = 'Contact Us Form Submission';
            // user's email address
            $headers = "From: $email";
            // content of the email
            $body = "Name: $full_name\nEmail: $email\nMessage:\n$message_content";
            // if mail returns true
            if (mail($to, $subject, $body, $headers)) {
                $message = 'Message sent successfully!';
            } else {
                // if mail returns false
                $message = 'Failed to send the message.';
            }
        } else {
            // if mail is not valid
            $message = 'Invalid email format.';
        }// if field is missing
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
   <title>Document</title> 
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <!-- contact form -->
        <form method="post" action="contact.php">
            <label>Full Name:</label>
            <input type="text" name="full_name" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Message:</label>
            <textarea name="message" required></textarea>
            <button type="submit">Send</button>
        </form>
        <?php if ($message): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </main>
<!-- include the footer file -->
<?php include 'templates/footer.php'; ?>
</body>
</html>

