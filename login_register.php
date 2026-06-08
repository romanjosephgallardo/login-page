<?php

session_start(); // Start the session to store messages and active form state
require_once 'config.php'; // Include the database connection

if (isset($_POST['register'])) { // Check if the registration form is submitted or not
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if the email is already registered or not
    $checkEmail = $conn->query("SELECT email FROM users WHERE email='$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = "Email is already registered!.";
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
    }

    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) { // Check if the login form is submitted or not
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists in the database or not
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            if ($user['role'] === 'admin') {
                header("Location: admin_page.php");
            } else {
                header("Location: user_page.php");
            }
            exit();
        }
    }

    // If login fails, set an error message and redirect back to the login form
    $_SESSION['login_error'] = "Invalid email or password!.";
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");  
    exit();
}

?>