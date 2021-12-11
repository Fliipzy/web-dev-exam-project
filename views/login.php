<?php
session_start();
if (isset($_SESSION["email"])) 
{
    header("Location: home.php", true, 302);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicStore | Login</title>

    <link rel="stylesheet" href="../public/css/global.css">
    
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
    <script src="../public/js/login.js" defer></script>
</head>
<body>

    <?php include("./fragments/navbar.php"); ?>
    
    <div class="container">
    
        <h1>Login</h1>
    
        <form id="loginForm" action="home.php" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <br>
        <div id="loginErrorMessage" hidden class="error-message">Login credentials were wrong, please try again!</div>
        <br>
        <div class="container">
            No account? <a href="signup.php">Sign up</a>
        </div>
    </div>

    <?php include("./fragments/footer.php") ?>
</body>
</html>
