<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "ADMIN") {
    header("Location: ../home.php", true, 302);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuneStore | Admin</title>

    <link rel="stylesheet" href="../../public/css/global.css">

    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("../fragments/navbar.php"); ?>
    <div class="container">
    </div>
    <?php include("../fragments/footer.php"); ?>
</body>
</html>