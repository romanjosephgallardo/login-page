<?php

session_start();
if (!isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: #f0f0f0;">
    
    <div class="box">
        <h1>Welcome <span><?= htmlspecialchars($_SESSION['name'] ?? '') ?></span>!</h1>
        <p> This is an <span>admin</span> page. Only users with admin role can access this page. </p>
        <button onclick="window.location.href='logout.php'"> Logout </button>
    </div>
</body>
</html>