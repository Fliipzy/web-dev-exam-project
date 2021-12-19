<?php
session_start();

if (!isset($_SESSION["checkoutDone"])) {
    header("Location: tracks.php", true, 302);
    exit();
}

// unset 'checkoutDone' variable so the user will be redirected next page refresh
else {
    unset($_SESSION["checkoutDone"]);
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

    <script src="../public/js/toasts.js"></script>
    <script src="../public/js/views/checkoutDone.js" defer></script>
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("./fragments/navbar.php"); ?>

    <div class="container">

        <h1>Checkout <span class="text-muted">/ complete <i class="text-success fas fa-check"></i></span></h1>
        <hr>
        
        <div class="mx-auto">
            <h2>Congratulations</h2>
            <p>Hi <?php echo $_SESSION["customer"]["FirstName"]; ?>,</p>
            <p>Your order was successfully placed! You should recieve an email soon with the invoice containing all the details about your order.</p>
            <p>If you made a mistake or want to cancel your purchase, please contact us at <a href="mailto: abc@example.com"><strong>customer-service@tunestore.com</strong></a> for a refund.</p>
            <br>
            <p>Click <a href="/webexam/views/home.php">here</a> to return back to TuneStore™ home.</p>
        </div>

    </div>

    <?php include("./fragments/footer.php"); ?>
    
    <!-- container for toast messages -->
    <div id="toastContainer" class="toast-container"></div>

</body>

</html>