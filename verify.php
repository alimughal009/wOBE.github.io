<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

if (isset($_GET['email'], $_GET['token'])) {
    $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);

    // Check if email and token are valid
    $sql = "SELECT * FROM users WHERE email = :email AND token = :token AND is_verified = 0 LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Update is_verified to true
        $sql = "UPDATE users SET is_verified = 1 WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $_SESSION['success'] = 'Your account has been verified. You can now log in.';
        header('Location: userlogin.php');
        exit();
    } else {
        $_SESSION['error'] = 'Invalid email or token.';
        header('Location: userlogin.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'Invalid request.';
    header('Location: userlogin.php');
    exit();
}
