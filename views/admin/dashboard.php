<?php
session_start();

if (!isset($_SESSION["role"])) {
    header("Location: login.php#redirect", true, 302);
    exit();
}

if ($_SESSION["role"] == "CUSTOMER") {
    header("Location: home.php", true, 401);
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

    <link rel="stylesheet" href="../../public/css/global.css">
    <link rel="stylesheet" href="../../public/css/views/adminDashboard.css">

    <script src="../../public/js/toasts.js"></script>

    <script src="../../public/js/views/adminDashboard.js" defer></script>
    <script src="https://kit.fontawesome.com/13c84602fa.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include("../fragments/navbar.php"); ?>

    <div id="main">
            <section id="dashboardPanel">
                <div class="dashboard-panel-header">
                    <h1>Admin dashboard <i class="fas fa-user-cog"></i></h1>
                    <br>
                </div>
                <nav id="dashboardPanelNavigation">
                    <ul>
                        <li class="active" view="Tracks">
                            <a href="#tracks"><i class="fas fa-music"></i>&nbsp; Tracks</a>
                        </li>
                        <li view="Albums">
                            <a href="#albums"><i class="fas fa-compact-disc"></i>&nbsp; Albums</a>
                        </li>
                        <li view="Artists">
                            <a href="#artists"><i class="fas fa-star icon-yellow"></i>&nbsp; Artists</a>
                        </li>
                        <li view="Customers">
                            <a href="#customers"><i class="fas fa-users"></i>&nbsp; Customers</a>
                        </li>
                        <li view="Invoices">
                            <a href="#invoices"><i class="fas fa-file-invoice-dollar"></i>&nbsp;&nbsp; Invoices</a>
                        </li>
                    </ul>
                </nav>
                <span class="version">v. 0.1.12 beta</span>
            </section>
        
        
            <section id="dashboardView">
                <!-- tracks view -->
                <section id="tracksView">
                    <table id="tracksTable">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Title</td>
                                <td>Artist</td>
                                <td>Album</td>
                                <td>Price</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- track rows -->
                        </tbody>
                    </table>
                </section>
        
                <section hidden id="albumsView">
                    albums
                </section>
        
                <section hidden id="artistsView">
                    artists
                </section>
        
                <section hidden id="customersView">
                    customers
                </section>

                <section id="tablePagination">
                    ewe
                </section>

            </section>
    </div>


    <?php include("../fragments/footer.php"); ?>

    <!-- container for toast messages -->
    <div id="toastContainer" class="toast-container"></div>

</body>

</html>