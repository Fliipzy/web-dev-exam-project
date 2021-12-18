<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php#redirect", true, 302);
    exit();
}

if (!isset($_SESSION["cart"])) {
    header("Location: tracks.php", true, 302);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuneStore | Checkout</title>

    <link rel="stylesheet" href="../public/css/global.css">

    <script src="../public/js/views/checkout.js" defer></script>
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("./fragments/navbar.php"); ?>

    <div class="container">

        <h1>Checkout</h1>
        <hr>

        <form id="checkoutForm">
            <h2>Billing address</h2>
            <div class="input-group">
                <label class="required" for="address">Address</label>
                <input type="text" name="address" required>
            </div>
            <div class="input-group">
                <label for="address">Apartment, suite etc. (optional)</label>
                <input type="text" name="address">
            </div>
            <button type="submit" class="btn btn-success">Place order now</button>
        </form>

    </div>

    <?php include("./fragments/footer.php"); ?>
</body>
</html>