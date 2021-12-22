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
                        <a><i class="fas fa-music"></i>&nbsp; Tracks</a>
                    </li>
                    <li view="Albums">
                        <a><i class="fas fa-compact-disc"></i>&nbsp; Albums</a>
                    </li>
                    <li view="Artists">
                        <a><i class="fas fa-star icon-yellow"></i>&nbsp; Artists</a>
                    </li>
                    <li view="Customers">
                        <a><i class="fas fa-users"></i>&nbsp; Customers</a>
                    </li>
                    <li view="Invoices">
                        <a><i class="fas fa-file-invoice-dollar"></i>&nbsp;&nbsp; Invoices</a>
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
                            <td>Artist(s)</td>
                            <td>Album</td>
                            <td>Price</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- track rows -->
                    </tbody>
                </table>

                <!-- modals -->
                <div hidden id="tracksUpdateModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>Update track</h2>
                        </div>
                        <div class="modal-body">

                            <!-- track update form -->
                            <form id="tracksUpdateModalForm">

                                <input type="hidden" name="id">

                                <div class="input-group">
                                    <label class="required" for="title">Title</label>
                                    <input type="text" name="title" required>
                                </div>

                                <div class="input-group">
                                    <label class="required" for="album">Album</label>
                                    <input type="text" name="album" require>
                                </div>

                                <div class="input-group">
                                    <label class="required" for="artist">Artist</label>
                                    <input type="text" name="artist" require>
                                </div>

                                <div class="row">
                                    <div class="col col-5">
                                        <div class="input-group">
                                            <label class="required" for="mediaTypeId">Media type</label>
                                            <select name="mediaTypeId" required>
                                                <option value="1">MPEG audio file</option>
                                                <option value="2">Protected AAC audio file</option>
                                                <option value="3">Protected MPEG-4 video file</option>
                                                <option value="4">Purchased AAC audio file</option>
                                                <option value="5">AAC audio file</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-5">
                                        <div class="input-group">
                                            <label for="genreId">Genre</label>
                                            <select name="genreId">
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

                                <div class="input-group">
                                    <label for="composer">Composer(s)</label>
                                    <input type="text" name="composer">
                                </div>

                                <div class="row">
                                    <div class="col col-3-3">
                                        <div class="input-group">
                                            <label class="required" for="milliseconds">Milliseconds</label>
                                            <input type="number" name="milliseconds" required>
                                        </div>
                                    </div>
                                    <div class="col col-3-3">
                                        <div class="input-group">
                                            <label for="bytes">Bytes</label>
                                            <input type="number" name="bytes">
                                        </div>
                                    </div>
                                    <div class="col col-3-3">
                                        <div class="input-group">
                                            <label class="required" for="unitPrice">Unit price</label>
                                            <input type="number" step="0.01" name="unitPrice" required>
                                        </div>
                                    </div>

                                </div>

                                <button class="btn btn-success" type="submit">Update track</button>

                            </form>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

                <!-- delete modal -->
                <div hidden id="tracksDeleteModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>Delete track</h2>
                        </div>
                        <div class="modal-body">
                            <h3>Are you sure you want to delete this track?</h3>
                            <button class="btn btn-success">Yes, delete</button>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

                <!-- create modal -->
                <div hidden id="tracksCreateModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>Create new track</h2>
                        </div>
                        <div class="modal-body">

                            <!-- track create form -->
                            <form id="tracksCreateModalForm">

                                <div class="input-group">
                                    <label class="required" for="title">Title</label>
                                    <input type="text" name="title" required>
                                </div>

                                <div class="input-group">
                                    <label class="required" for="album">Album</label>
                                    <input type="text" name="album" require>
                                </div>

                                <div class="input-group">
                                    <label class="required" for="artist">Artist</label>
                                    <input type="text" name="artist" require>
                                </div>

                                <div class="row">
                                    <div class="col col-5">
                                        <div class="input-group">
                                            <label class="required" for="mediaTypeId">Media type</label>
                                            <select name="mediaTypeId" required>
                                                <option value="1">MPEG audio file</option>
                                                <option value="2">Protected AAC audio file</option>
                                                <option value="3">Protected MPEG-4 video file</option>
                                                <option value="4">Purchased AAC audio file</option>
                                                <option value="5">AAC audio file</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-5">
                                        <div class="input-group">
                                            <label for="genreId">Genre</label>
                                            <select name="genreId">
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

                                <div class="input-group">
                                    <label for="composer">Composer(s)</label>
                                    <input type="text" name="composer">
                                </div>

                                <div class="row">
                                    <div class="col col-3-3">
                                        <div class="input-group">
                                            <label class="required" for="milliseconds">Milliseconds</label>
                                            <input type="number" name="milliseconds" required>
                                        </div>
                                    </div>
                                    <div class="col col-3-3">
                                        <div class="input-group">
                                            <label for="bytes">Bytes</label>
                                            <input type="number" name="bytes">
                                        </div>
                                    </div>
                                    <div class="col col-3-3">
                                        <div class="input-group">
                                            <label class="required" for="unitPrice">Unit price</label>
                                            <input type="number" step="0.01" name="unitPrice" required>
                                        </div>
                                    </div>

                                </div>

                                <button class="btn btn-success" type="submit">Create new track</button>

                            </form>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

            </section>

            <!-- Albums view -->
            <section hidden id="albumsView">
                <table id="albumsTable">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Title</td>
                            <td>Artist Id</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- albums rows -->
                    </tbody>
                </table>

                <!-- modals -->
                <div hidden id="albumsUpdateModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>Update album</h2>
                        </div>
                        <div class="modal-body">
                            <!-- album update form -->
                            <form id="tracksUpdateModalForm">

                                <input type="hidden" name="id">

                                <div class="input-group">
                                    <label class="required" for="title">Title</label>
                                    <input type="text" name="title" required>
                                </div>

                                <div class="input-group">
                                    <label class="required" for="artist">Artist</label>
                                    <input type="text" name="artist" required>
                                </div>

                                <button class="btn btn-success" type="submit">Update album</button>

                            </form>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

                <!-- delete modal -->
                <div hidden id="albumsDeleteModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>Delete album</h2>
                        </div>
                        <div class="modal-body">
                            <h3>Are you sure you want to delete this album?</h3>
                            <button class="btn btn-success">Yes, delete</button>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

                <!-- create modal -->
                <div hidden id="albumsCreateModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>Create new album</h2>
                        </div>
                        <div class="modal-body">

                            <!-- album create form -->
                            <form id="albumsCreateModalForm">

                                <div class="input-group">
                                    <label class="required" for="title">Title</label>
                                    <input type="text" name="title" required>
                                </div>

                                <div class="input-group">
                                    <label class="required" for="artist">Artist</label>
                                    <input type="text" name="artist" required>
                                </div>

                                <button class="btn btn-success" type="submit">Create new album</button>

                            </form>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

            </section>

            <section hidden id="artistsView">

                <!-- Artists view -->
                <table id="artistsTable">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- artists rows -->
                    </tbody>
                </table>

                <!-- modals -->
                <div hidden id="artistsUpdateModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>Update artist</h2>
                        </div>
                        <div class="modal-body">

                            <form id="artistsUpdateModalForm">

                                <input type="hidden" name="id">

                                <div class="input-group">
                                    <label class="required" for="name">Name</label>
                                    <input type="text" name="name" required>
                                </div>

                                <button class="btn btn-success" type="submit">Update artist</button>

                            </form>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

                <!-- delete modal -->
                <div hidden id="artistsDeleteModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>Delete artist</h2>
                        </div>
                        <div class="modal-body">
                            <h3>Are you sure you want to delete this artist?</h3>
                            <button class="btn btn-success">Yes, delete</button>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

                <!-- create modal -->
                <div hidden id="artistsCreateModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>Create new artist</h2>
                        </div>
                        <div class="modal-body">

                            <form id="artistsCreateModalForm">

                                <div class="input-group">
                                    <label class="required" for="name">Name</label>
                                    <input type="text" name="name" required>
                                </div>

                                <button class="btn btn-success" type="submit">Create new artist</button>

                            </form>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

            </section>

            <section hidden id="customersView">
                <!-- Customers view -->
                <table id="customersTable">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>First name</td>
                            <td>Last name</td>
                            <td>Email</td>
                            <td>Address</td>
                            <td>Country</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- customers rows -->
                    </tbody>
                </table>

                <!-- modals -->
                <div hidden id="customersViewModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>View customer</h2>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col col-5">

                                    <div class="input-group">
                                        <label>First name</label>
                                        <input type="text" name="firstName" readonly>
                                    </div>

                                </div>
                                <div class="col col-5">

                                    <div class="input-group">
                                        <label>Last name</label>
                                        <input type="text" name="lastName" readonly>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-4">

                                    <div class="input-group">
                                        <label>Email</label>
                                        <input type="text" name="email" readonly>
                                    </div>

                                </div>

                                <div class="col col-2">

                                    <div class="input-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" readonly>
                                    </div>

                                </div>

                                <div class="col col-2">

                                    <div class="input-group">
                                        <label>Company</label>
                                        <input type="text" name="company" readonly>
                                    </div>

                                </div>

                                <div class="col col-2">

                                    <div class="input-group">
                                        <label>Fax</label>
                                        <input type="text" name="fax" readonly>
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col col-4">

                                    <div class="input-group">
                                        <label>Country</label>
                                        <input type="text" name="country" readonly>
                                    </div>

                                </div>
                                <div class="col col-2">

                                    <div class="input-group">
                                        <label>State</label>
                                        <input type="text" name="state" readonly>
                                    </div>

                                </div>
                                <div class="col col-2">

                                    <div class="input-group">
                                        <label>City</label>
                                        <input type="text" name="city" readonly>
                                    </div>

                                </div>
                                <div class="col col-2">

                                    <div class="input-group">
                                        <label>Postal code</label>
                                        <input type="text" name="postalCode" readonly>
                                    </div>

                                </div>

                            </div>

                            <div class="input-group">
                                <label>Address</label>
                                <input type="text" name="address" readonly>
                            </div>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

            </section>

            <section hidden id="invoicesView">
                <!-- Invoices view -->
                <table id="invoicesTable">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Customer Id</td>
                            <td>Date</td>
                            <td>Billing address</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- customers rows -->
                    </tbody>
                </table>

                <!-- modals -->
                <div hidden id="invoicesViewModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">🗙</span>
                            <h2>View invoice</h2>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col col-5">

                                    <div class="input-group">
                                        <label>Customer</label>
                                        <input type="text" name="customer" readonly>
                                    </div>

                                </div>
                                <div class="col col-5">

                                    <div class="input-group">
                                        <label>Invoice date</label>
                                        <input type="text" name="invoiceDate" readonly>
                                    </div>

                                </div>
                            </div>

                            <div class="row">

                                <div class="col col-3">

                                    <div class="input-group">
                                        <label>Billing city</label>
                                        <input type="text" name="billingCity" readonly>
                                    </div>

                                </div>

                                <div class="col col-2">

                                    <div class="input-group">
                                        <label>Billing postal code</label>
                                        <input type="text" name="billingPostalCode" readonly>
                                    </div>

                                </div>

                                <div class="col col-2">

                                    <div class="input-group">
                                        <label>Billing state</label>
                                        <input type="text" name="billingState" readonly>
                                    </div>

                                </div>

                                <div class="col col-3">

                                    <div class="input-group">
                                        <label>Billing country</label>
                                        <input type="text" name="billingCountry" readonly>
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col col-3">

                                    <div class="input-group">
                                        <label>Billing address</label>
                                        <input type="text" name="billingAddress" readonly>
                                    </div>

                                </div>

                                <div class="col-col-2">

                                    <div class="input-group">
                                        <label>Total</label>
                                        <input type="text" name="total" readonly>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>

            </section>

            <section id="tablePagination">
                <br>
                <button class="btn" id="first"><i class="fas fa-angle-double-left"></i> First</button>
                <button class="btn" id="prev"><i class="fas fa-angle-left"></i> Prev</button>
                <span></span>
                <button class="btn" id="next">Next <i class="fas fa-angle-right"></i></button>
                <button class="btn" id="last">Last <i class="fas fa-angle-double-right"></i></button>
            </section>

            <button id="createEntityButton" class="btn btn-success" onclick="openTracksCreateModal()">Create new track</button>

        </section>
    </div>


    <?php include("../fragments/footer.php"); ?>

    <!-- container for toast messages -->
    <div id="toastContainer" class="toast-container"></div>

</body>

</html>