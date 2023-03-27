
<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendVerificationEmail($email, $token)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'alia63751@gmail.com';
        $mail->Password   = 'iidgrtmmiqcfitmg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('alia63751@gmail.com', 'wOBE');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification from wOBE';
        $mail->Body    = 'Thank you for registering with us. Please click on the link below to verify your email address:<br><br>';
        $mail->Body   .= '<a href="http://localhost/wOBE/verify.php?email=' . $email . '&token=' . $token . '">Verify Email</a>';
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Error sending email: ' . $mail->ErrorInfo);
        return false;
    }
}

if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['contact_number'], $_POST['password'], $_POST['confirm_password'])) {
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $contact_number = filter_input(INPUT_POST, 'contact_number', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email address.';
        header('Location: userregistration.php');
        exit();
    }

    // Validate phone number
    if (!preg_match('/^\d{11}$/', $contact_number)) {
        $_SESSION['error'] = 'Invalid phone number.';
        header('Location: userregistration.php');
        exit();
    }

    // Validate password strength
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/', $password)) {
        $_SESSION['error'] = 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.';
        header('Location: userregistration.php');
        exit();
    }

    // Check if password and confirm password match
    if ($password != $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match!';
        header('Location: userregistration.php');
        exit();
    }
    // Hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Generate random token for email verification
    $token = bin2hex(random_bytes(32));

    // Insert data into database with is_verified set to 0 (false)
    try {
        $sql = "INSERT INTO users (first_name, last_name, email, contact_number, password, is_verified, token) VALUES (:first_name, :last_name, :email, :contact_number, :password, :is_verified, :token)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':password', $password);
        $is_verified = 0;
        $stmt->bindParam(':is_verified', $is_verified);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // Send verification email
        sendVerificationEmail($email, $token);
    
        $_SESSION['success'] = 'Registration successful! Please check your email to verify your account.';
        header('Location: userlogin.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Registration failed: ' . $e->getMessage();
        header('Location: userregistration.php');
        exit();
    }
    }
