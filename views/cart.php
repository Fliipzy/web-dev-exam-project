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
    <title>TuneStore | Cart</title>

    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/cart.css">

    <script src="../public/js/toasts.js"></script>

    <script src="../public/js/views/cart.js" defer></script>
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("./fragments/navbar.php"); ?>
    <div class="container">

        <h1>Shopping cart</h1>
        <hr>

        <!-- if cart is not empty -->
        <section id="cartSection" <?php if(count($_SESSION["cart"]) == 0): ?> hidden <?php endif; ?>>
            <h2>Here's your shopping cart</h2>

            <table id="cartTable">
                <thead>
                    <tr>
                        <th>Track</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <br>

            <section id="subTotal">
                <b>Sub-total:</b>
            </section>

            <br>

            <div class="row">
                <div class="col">
                    <button class="btn" onclick="clearCart()">Clear cart</button>
                </div>
                <div class="col">
                    <button class="btn btn-success" onclick="goToCheckout()">Proceed to checkout <i class="fas fa-angle-double-right"></i></button>
                </div>
            </div>
        </section>

        <!--if cart is empty-->
        <section id="emptyCartSection" <?php if(count($_SESSION["cart"]) > 0): ?> hidden <?php endif; ?>>
            <h2>Your shopping cart is empty!</h2>
            <br>
            <a href="/webexam/views/tracks.php" class="btn btn-success"><i class="fas fa-angle-double-left"></i>&nbsp; Go back to tracks </a>
        </section>

    </div>
    <?php include("./fragments/footer.php"); ?>

    <!-- container for toast messages -->
    <div id="toastContainer" class="toast-container"></div>

</body>
</html>