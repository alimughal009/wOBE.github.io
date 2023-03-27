<?php
require_once('db.php');

session_start();

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])) {
        if ($user['is_verified'] == 1) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
        
            // Redirect to user dashboard
            header('Location: admindashboard.php');
            exit();
        } else {
            // User not verified, display error message
            $_SESSION['error'] = 'Your email has not been verified yet. Please check your email and click on the verification link to activate your account.';
            header('Location: userlogin.php');
            exit();
        }
    } else {
        // Incorrect email or password, redirect to login page
        $_SESSION['error'] = 'Invalid email or password.';
        header('Location: userlogin.php');
        exit();
    }
}
?>
