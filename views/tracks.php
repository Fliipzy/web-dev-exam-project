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
    <link rel="stylesheet" href="../public/css/views/tracks.css">

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
            <div class="row">
                <div class="col col-2">
                    <div class="input-group">
                        <label class="required" for="searchTerm">Search term</label>
                        <input type="text" name="searchTerm" placeholder="Song title, artist or album" required>
                    </div>
                </div>
                <div class="col col-1">
                    <div class="input-group">
                        <label for="query">Genre</label>
                        <select name="genre">
                            <option selected>All genres</option>
                            <option value="1">Rock</option>
                            <option value="2">Jazz</option>
                            <option value="3">Metal</option>
                            <option value="4">Alternative & Punk</option>
                            <option value="5">Rock And Roll</option>
                            <option value="6">Blues</option>
                            <option value="7">Latin</option>
                            <option value="8">Reggae</option>
                            <option value="9">Pop</option>
                            <option value="10">Soundtrack</option>
                            <option value="11">Bossa Nova</option>
                            <option value="12">Easy Listening</option>
                            <option value="13">Heavy Metal</option>
                            <option value="14">R&B/Soul</option>
                            <option value="15">Electronica/Dance</option>
                            <option value="16">World</option>
                            <option value="17">Hip Hop/Rap</option>
                            <option value="18">Science Fiction</option>
                            <option value="19">TV Shows</option>
                            <option value="20">Sci Fi & Fantasy</option>
                            <option value="21">Drama</option>
                            <option value="22">Comedy</option>
                            <option value="23">Alternative</option>
                            <option value="24">Classical</option>
                            <option value="25">Opera</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col col-1">
                    <button class="btn btn-success w-100 mr-1" type="submit" value="Search">Search</button>
                </div>
                <!-- reset search button -->
                <div class="col col-2">
                    <button id="resetButton" type="button" class="btn ml-1" >Reset</button>
                </div>
            </div>

        </form>

        <br>

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