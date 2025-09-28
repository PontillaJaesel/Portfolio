<?php
// Redirect logged-in users directly to main.php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: main.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Jaesel Pontilla</title>
    <link rel="stylesheet" href="startup.css">
</head>
<body>
    <img class="image-gradient" src="gradient.png" alt="gradient">
    <div class="layer-blur"></div>
    
    <main>
        <div class="content">
            <h1>HI, IT'S JAESEL</h1>
            <h2>I'm a Third-Year BS Computer Science Student</h2>
            <div class="buttons">
                <a href="template.php" class="view-portfolio-btn">Portfolio</a>
                <a href="logout.php" class="Email-btn">Email</a>
            </div>
    </main>
</body>
</html>
