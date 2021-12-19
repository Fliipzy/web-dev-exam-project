<?php
session_start();

require_once(__DIR__ . "/api/Inc/bootstrap.php");

// parse request uri & get relative path from 'api/'
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = substr($uri, strpos($uri, "api/"));

// trim trailing slash from request, if it exists
$uri = rtrim($uri, "/");

// slice up the uri string for easier inspection
$uri = explode("/", $uri);


// get the request method
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($uri[1] == "authentication") {
    $controller = new AuthenticationController();

    switch ($requestMethod) {

        case "GET":
            if (isset($uri[2]) && $uri[2] == "signout") {
                $controller->signOut();
            }
            else if (isset($uri[2]) && $uri[2] == "session") {
                header("Content-Type: application/json");
                echo json_encode($_SESSION);
            }
            break;

        case "POST":
            if (isset($uri[2])) {
                if ($uri[2] == "signin") {
                    $signinRequest = json_decode(file_get_contents("php://input"), true);
                    $controller->signIn($signinRequest);
                } 
                else if ($uri[2] == "admin-signin") {
                    $signinRequest = json_decode(file_get_contents("php://input"), true);
                    $controller->adminSignin($signinRequest);
                }
                else if ($uri[2] == "signup") {
                    $signupRequest = json_decode(file_get_contents("php://input"), true);
                    $controller->signUp($signupRequest);
                }
            }
            break;

        case "PATCH":
            if (isset($uri[2])) {
                if ($uri[2] == "reset-password") {
                    $resetPasswordRequest = json_decode(file_get_contents("php://input"), true);
                    $controller->resetPassword($resetPasswordRequest);
                }
                if (isset($uri[3]) && $uri[3] == "active-status") {
                    $status = json_decode(file_get_contents("php://input"), true);
                    $controller->setUserActiveStatus($uri[2], $status["activeStatus"]);
                }
            }
            break;

        default:
            $controller->notFound();
            break;
    }

    // stop execution so unauthenticated users doesn't get nasty error messages
    exit();
}

// Make sure to check if user is authorized to request these endpoints
if (!isset($_SESSION["email"])) {
    header("HTTP/1.1 401 Unauthorized");
    header("Content-type: application/json");
    echo json_encode(array("error" => "You're not authenticated to call this endpoint!"));
    exit();
}

switch ($uri[1]) {
    case "albums":
        $controller = new AlbumController();

        switch ($requestMethod) {
            case "GET":
                isset($uri[2]) ? $controller->getAlbum($uri[2]) : $controller->getAlbums();
                break;
            case "PUT":
                $controller->authorizeAdmin();
                $album = json_decode(file_get_contents("php://input"), true);
                $controller->updateAlbum($album);
                break;
            case "POST":
                $controller->authorizeAdmin();
                $album = json_decode(file_get_contents("php://input"), true);
                $controller->createAlbum($album);
                break;
            case "DELETE":
                $controller->authorizeAdmin();
                $controller->deleteAlbum($uri[2]);
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "artists":
        $controller = new ArtistController();

        switch ($requestMethod) {
            case "GET":
                isset($uri[2]) ? $controller->getArtist($uri[2]) : $controller->getArtists();
                break;
            case "PUT":
                $controller->authorizeAdmin();
                $artist = json_decode(file_get_contents("php://input"), true);
                $controller->updateArtist($artist);
                break;
            case "POST":
                $controller->authorizeAdmin();
                $artist = json_decode(file_get_contents("php://input"), true);
                $controller->createArtist($artist);
                break;
            case "DELETE":
                $controller->authorizeAdmin();
                $controller->deleteArtist($uri[2]);
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "cart":
        $controller = new CartController();

        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }

        if (!isset($uri[2])) {
            $controller->getCart();
        } 
        else {
            if ($uri[2] == "tracks") {
                $controller->getTracks();
            }

            else if ($uri[2] == "total") {
                $controller->getTotal();
            }

            else if ($uri[2] == "add" && isset($uri[3])) {
                $controller->addTrack($uri[3]);
            }

            else if ($uri[2] == "remove" && isset($uri[3])) {
                $controller->removeTrack($uri[3]);
            }

            else if ($uri[2] == "clear") {
                $controller->clear();
            }

            else {
                $controller = new BaseController();
                $controller->notFound();
            }
        }

        break;

    case "customers":
        $controller = new CustomerController();

        switch ($requestMethod) {
            case "GET":
                isset($uri[2]) ? $controller->getCustomer($uri[2]) : $controller->getCustomers();
                break;
            case "PUT":
                $customer = json_decode(file_get_contents("php://input"), true);
                $controller->updateCustomer($customer);
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "genres":
        $controller = new GenreController();

        switch ($requestMethod) {
            case "GET":
                isset($uri[2]) ? $controller->getGenre($uri[2]) : $controller->getGenres();
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "invoices":
        $controller = new InvoiceController();

        switch ($requestMethod) {
            case "GET":
                isset($uri[2]) ? $controller->getInvoice($uri[2]) : $controller->getInvoices();
                break;
            case "POST":
                $invoice = json_decode(file_get_contents("php://input"), true);
                $controller->createInvoice($invoice);
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "mediatypes":
        $controller = new MediaTypeController();

        switch ($requestMethod) {
            case "GET":
                isset($uri[2]) ? $controller->getMediaType($uri[2]) : $controller->getMediaTypes();
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "tracks":
        $controller = new TrackController();

        switch ($requestMethod) {
            case "GET":
                if (isset($uri[2]) && $uri[2] == "search") {
                    $searchQuery = json_decode(file_get_contents("php://input"), true);
                    $controller->getTracksFromSearch($searchQuery);
                }
                else {
                    isset($uri[2]) ? $controller->getTrack($uri[2]) : $controller->getTracks();
                }
                break;
            case "PUT":
                $controller->authorizeAdmin();
                $track = json_decode(file_get_contents("php://input"), true);
                $controller->updateTrack($track);
                break;
            case "POST":
                $controller->authorizeAdmin();
                $track = json_decode(file_get_contents("php://input"), true);
                $controller->createTrack($track);
                break;
            case "DELETE":
                $controller->authorizeAdmin();
                $controller->deleteTrack($uri[2]);
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    default:
        // return 404 status with message
        $controller = new BaseController();
        $controller->notFound();
        break;
}
