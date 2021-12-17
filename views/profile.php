<?php
session_start();

if (!isset($_SESSION["email"])) 
{
    header("Location: login.php#redirect", true, 302);
    exit();
}

if ($_SESSION["role"] == "ADMIN") {
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
    <title>TuneStore | Profile</title>

    <link rel="stylesheet" href="../public/css/global.css">
    
    <script src="../public/js/views/profile.js" defer></script>
    <script src="../public/js/messages.js" defer></script>
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("./fragments/navbar.php"); ?>
    <div class="container">
        
        <h1>Profile information</h1>
        <hr>

        <form id="customerForm">

            <input type="hidden" name="customerId" value="<?php echo $_SESSION["customer"]["CustomerId"]; ?>" required>

            
            <div class="row">
                <div class="col more-space">
                    <h3>Personal</h3>
                    <div class="input-group">
                        <label for="firstName">First name:</label>
                        <input type="text" name="firstName" value="<?php echo $_SESSION["customer"]["FirstName"]; ?>" required>
                    </div>
        
                    <div class="input-group">
                        <label for="lastName">Last name:</label>
                        <input type="text" name="lastName" value="<?php echo $_SESSION["customer"]["LastName"]; ?>" required>
                    </div>
        
                    <div class="input-group">
                        <label for="company">Company:</label>
                        <input type="text" name="company" value="<?php echo $_SESSION["customer"]["Company"]; ?>">
                    </div>
                </div>

                <div class="col">
                    <h3>Location</h3>

                    <div class="input-group">
                        <label for="address">Address:</label>
                        <input class="grow" type="text" name="address" value="<?php echo $_SESSION["customer"]["Address"]; ?>">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group no-top">
                                <label for="city">City:</label>
                                <input type="text" name="city" value="<?php echo $_SESSION["customer"]["City"]; ?>">
                            </div>
                
                            <div class="input-group">
                                <label for="state">State:</label>
                                <input type="text" name="state" value="<?php echo $_SESSION["customer"]["State"]; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group no-top">
                                <label for="country">Country:</label>
                                <input type="text" name="country" value="<?php echo $_SESSION["customer"]["Country"]; ?>">
                            </div>
                
                            <div class="input-group">
                                <label for="postalCode">Postal code:</label>
                                <input type="text" name="postalCode" value="<?php echo $_SESSION["customer"]["PostalCode"]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            
            <h3 class="row-title">Contact</h3>
            <div class="row">
                <div class="col">
                    <div class="input-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" value="<?php echo $_SESSION["customer"]["Email"]; ?>" required>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" value="<?php echo $_SESSION["customer"]["Phone"]; ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <label for="fax">Fax:</label>
                        <input type="text" name="fax" value="<?php echo $_SESSION["customer"]["Fax"]; ?>">
                    </div>
                </div>
            </div>
            
            <input class="btn btn-success" type="submit" value="Update information">
            <div id="customerMessage"></div>
        </form>

        <hr class="mt-3">

        <h2>Change password</h2>
        <form id="passwordForm">
            <div class="input-group">
                <label for="oldPassword">Current password:</label>
                <input type="password" name="oldPassword" required>
            </div>
            <div class="input-group">
                <label for="newPassword">New password:</label>
                <input type="password" name="newPassword" required>
            </div>
            <div class="input-group">
                <label for="newPasswordConfirmed">Confirm password:</label>
                <input type="password" name="newPasswordConfirmed" required>
            </div>

            <input class="btn btn-danger" type="submit" value="Change password">
            <div id="passwordMessage"></div>
        </form>

    </div>
    <?php include("./fragments/footer.php"); ?>
</body>
</html>