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
    <title>TuneStore | Login</title>

    <link rel="stylesheet" href="../public/css/global.css">
    
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
    <script src="../public/js/global.js" defer></script>
    <script src="../public/js/login.js" defer></script>
</head>
<body>

    <?php include("./fragments/navbar.php"); ?>
    
    <div class="container">

        <div hidden class="message success" id="redirectMessage">
            Whoa, please login before you use TuneStore™!
            <span class="close">🗙</span>
        </div>
    
        <h1>Login</h1>
    
        <form id="loginForm" action="home.php" method="post">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <button class="btn btn-success" type="submit">Login</button>
        </form>
        <br>
        <div hidden id="loginErrorMessage" class="message danger">
            Login credentials were wrong, please try again!
            <span class="close">🗙</span>
        </div>
        <br>
        No account? <a href="signup.php">Sign up</a>
    </div>

    <?php include("./fragments/footer.php") ?>
</body>
</html>
