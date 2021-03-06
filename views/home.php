<?php
session_start();

if (!isset($_SESSION["email"])) 
{
    header("Location: login.php#redirect", true, 302);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuneStore | Home</title>

    <link rel="stylesheet" href="../public/css/global.css">

    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <?php include("./fragments/navbar.php"); ?>
    <div class="container">
        
        <?php if ($_SESSION["role"] == "ADMIN"): ?>
            <h1>Welcome back</h1>
            <h2>Go to <a href="/webexam/views/admin/dashboard.php">dashboard</a> to administrate!</h2>
        <?php else: ?>
            <h1>Welcome to TuneStore™</h1>
            <h2>Go to <a href="/webexam/views/tracks.php">tracks</a> to buy awesome music!</h2>
        <?php endif; ?>


    </div>
    <?php include("./fragments/footer.php"); ?>

</body>
</html>