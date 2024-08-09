<?php
// start a new session or resume the existing session
session_start();
// removes all the variables from the session
session_unset();
// delete the session 
session_destroy();
// redirects to index.php
header('Location: index.php');
exit;
?>