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
    <title>TuneStore | Admin login</title>

    <link rel="stylesheet" href="../public/css/global.css">
    
    <!--util scripts, load before view script-->
    <script src="../public/js/messages.js"></script>

    <script src="../public/js/admin.js" defer></script>
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include("./fragments/navbar.php"); ?>
    
    <div class="container">

        <h1>Admin login</h1>
        <hr>

        <form id="adminLoginForm">
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <button class="btn btn-success" type="submit">Login</button>
        </form>

        <br>
        <div hidden id="message"></div>
    </div>

    <?php include("./fragments/footer.php") ?>
</body>
</html>
