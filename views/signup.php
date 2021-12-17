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
    <title>TuneStore | Sign up</title>

    <link rel="stylesheet" href="../public/css/global.css">
    
    <!--util scripts, load before view script-->
    <script src="../public/js/messages.js"></script>

    <script src="../public/js/views/signup.js" defer></script>

    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("./fragments/navbar.php"); ?>
    <div class="container">
        <h1>Sign up</h1>
        <hr>
        <form id="signUpForm" method="post">
            <div class="input-group">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" placeholder="John" required>
            </div>
            <div class="input-group">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" placeholder="Doe" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Johndoe@gmail.com" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirmedPassword">Confirm password</label>
                <input type="password" name="confirmedPassword" required>
            </div>
            <button class="btn btn-success" type="submit">Sign up</button>
        </form>
        <br>
        
        <!-- message element for errors etc. -->
        <div hidden id="message"></div>

        <br>
        <a href="login.php"><i class="fas fa-backward"></i></a>&nbsp; Go back 

    </div>
    <?php include("./fragments/footer.php"); ?>
</body>
</html>