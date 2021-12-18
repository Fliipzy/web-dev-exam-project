<?php
session_start();

if (!isset($_SESSION["email"])) {
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
    <title>TuneStore | Tracks</title>

    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/tracks.css">

    <script src="../public/js/toasts.js"></script>
    <script src="../public/js/utils.js"></script>

    <script src="../public/js/views/tracks.js" defer></script>
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("./fragments/navbar.php"); ?>
    <div class="container">

        <h1>Tracks</h1>
        <hr>

        <form id="searchForm" method="get">
            <div class="input-group">
                <input class="noblock" type="text" name="query" required>
                <input class="btn noblock" type="submit" value="Search">
            </div>
        </form>

        <section hidden id="searchResults"></section>


        <!-- Track table row -->
        <div id="trackTableRow" class="col">

            <table id="trackTable" class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist(s)</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <section id="tablePagination">
                <br>
                <button class="btn" id="prev"><i class="fas fa-angle-double-left"></i> Prev</button>
                <span></span>
                <button class="btn" id="next">Next <i class="fas fa-angle-double-right"></i></button>
            </section>


        </div>

    </div>
    <?php include("./fragments/footer.php"); ?>

    <!-- track info modal -->
    <div hidden id="trackInfoModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">🗙</span>
                <h2>Track info</h2>
            </div>
            <div class="modal-body">
                <div id="trackInfo"></div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>

    <!-- container for toast messages -->
    <div id="toastContainer" class="toast-container"></div>

</body>

</html>