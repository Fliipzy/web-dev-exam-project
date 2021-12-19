<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php#redirect", true, 302);
    exit();
}
// if cart is undefined or cart doesn't contain any tracks
if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0) {
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
            <div class="row">

                <!-- Billing information section -->
                <div class="col col-4 mr-2">
                    <h2>Billing information</h2>

                    <div class="row">
                        <div class="col col-5">
                            <div class="input-group">
                                <label class="required" for="firstName">First name</label>
                                <input type="text" name="firstName" value="<?php echo $_SESSION["customer"]["FirstName"] ?>" required>
                            </div>
                        </div>
                        <div class="col col-5">
                            <div class="input-group">
                                <label class="required" for="lastName">Last name</label>
                                <input type="text" name="lastName" value="<?php echo $_SESSION["customer"]["LastName"] ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-5">
                            <div class="input-group">
                                <label class="required" for="email">Email</label>
                                <input type="email" name="email" value="<?php echo $_SESSION["customer"]["Email"] ?>" required>
                            </div>
                        </div>
                        <div class="col col-5">
                            <div class="input-group">
                                <label for="fax">Fax</label>
                                <input type="text" name="fax" value="<?php echo $_SESSION["customer"]["Fax"] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="required" for="address">Address</label>
                        <input type="text" name="address" value="<?php echo $_SESSION["customer"]["Address"] ?>" required>
                    </div>


                    <div class="input-group">
                        <label for="address">Apartment, suite etc. (optional)</label>
                        <input type="text" name="address">
                    </div>

                </div>

                <!-- payment method section -->
                <div class="col col-5 ml-2">
                    <h2>Payment information</h2>
                    <div class="row">
                        <div class="col col-5">

                            <div class="input-group">
                                <label class="required" for="cardNumber">Card number</label>
                                <input type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" maxlength="19" name="cardNumber" placeholder="xxxx xxxx xxxx xxxx" required>
                            </div>

                        </div>
                        <div class="col col-5">

                            <div class="input-group">
                                <label class="required" for="cardHolder">Card holder</label>
                                <input type="text" name="cardHolder" required>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-5">
                            <div class="row">
                                <!--card expiry date month-->
                                <div class="col col-5">

                                    <div class="input-group">
                                        <label class="required" for="cardExpiryMonth">Month</label>
                                        <select id="months" name="months">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>

                                </div>
                                <!--card expiry date year-->
                                <div class="col col-5">

                                    <div class="input-group">
                                        <label class="required" for="cardExpiryMonth">Year</label>
                                        <select id="years" name="years">
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- card CVC -->
                        <div class="col col-5">
                            <div class="input-group">
                                <label class="required" for="cardCVC">CVC</label>
                                <input type="text" pattern="\d*" maxlength="3" name="cardCVC" required>
                            </div>
                        </div>
                    </div>

                    <!-- sub and total price section-->
                    <div class="row">
                        <div class="info-block mb-1">
                            <span class="float-left">
                                <p>Subtotal (<span id="numberOfCartItems">2</span>)</p>
                                <p class="text-muted">Delivery cost</p>
                            </span>

                            <span class="float-right">
                                <p class="text-price"><span id="subTotalPrice">0</span></p>
                                <p class="text-muted text-price">0</p>
                            </span>
                        </div>
                        <div class="info-block">
                            <b>TOTAL AMOUNT</b>
                            <span class="float-right text-price"><span id="totalPrice">0</span></span>
                        </div>
                    </div>

                </div>

            </div>

            <button type="submit" class="btn btn-success">Place order now</button>

        </form>

    </div>

    <?php include("./fragments/footer.php"); ?>
</body>

</html>