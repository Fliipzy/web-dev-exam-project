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
    <title>TuneStore | Cart</title>

    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/cart.css">

    <script defer src="../public/js/cart.js"></script>
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("./fragments/navbar.php"); ?>
    <div class="container">
        <div class="page-title">
            <h1>Shopping cart</h1>
            <h2>Here's your shopping cart</h2>
        </div>

        <table id="cartTable">
            <thead>
                <tr>
                    <th>Track</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

        <br>

        <section id="subTotal">
            <b>Sub-total:</b> $13.5
        </section>

        <br>

        <div class="col">
            <div class="row">
                <button class="btn">Clear cart</button>
            </div>
            <div class="row">
                <button class="btn btn-success">Go to checkout <i class="fas fa-angle-double-right"></i></button>
            </div>
        </div>
    </div>
    <?php include("./fragments/footer.php"); ?>
</body>
</html>