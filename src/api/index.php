<?php
require_once(__DIR__ . "/Inc/bootstrap.php");

// parse request uri & get substring from this index.php files folder (api/*)
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = substr($uri, strpos($uri, basename(__DIR__)));

// trim trailing slash from request, if it exists
$uri = rtrim($uri, "/");

// slice up the uri string for easier inspection
$uri = explode("/", $uri);

// get the request method
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($uri[1]) 
{
    case "album":
        $controller = new AlbumController();

        switch ($requestMethod) 
        {
            case "GET":
                isset($uri[2]) ? $controller->getAlbum($uri[2]) : $controller->getAlbums(); 
                break;
            case "PUT":
                $album = json_decode(file_get_contents("php://input"), true);
                $controller->updateAlbum($album);
                break;
            case "POST":
                $album = json_decode(file_get_contents("php://input"), true);
                $controller->createAlbum($album);
                break;
            case "DELETE":
                $controller->deleteAlbum($uri[2]);
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "artists":
        $controller = new ArtistController();

        switch ($requestMethod) 
        {
            case "GET":
                isset($uri[2]) ? $controller->getArtist($uri[2]) : $controller->getArtists(); 
                break;
            case "PUT":
                $artist = json_decode(file_get_contents("php://input"), true);
                $controller->updateArtist($artist);
                break;
            case "POST":
                $artist = json_decode(file_get_contents("php://input"), true);
                $controller->createArtist($artist);
                break;
            case "DELETE":
                $controller->deleteArtist($uri[2]);
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "authentication":
        $controller = new AuthenticationController();

        switch ($requestMethod) {
    
            case "GET":
                if (isset($uri[2]) && $uri[2] == "signout") {
                    $controller->signOut();
                }
                break;

            case "POST":
                if (isset($uri[2])) {
                    if ($uri[2] == "signin") 
                    {
                        
                    }
                    else if ($uri[2] == "signup") 
                    {

                    }
                }
                break;

            case "PATCH":
                if (isset($uri[2])) 
                {
                    if ($uri[2] == "reset-password")  
                    {
                        $status = json_decode(file_get_contents("php://input"), true);
                    }
                    if (isset($uri[3]) && $uri[3] == "active-status") 
                    {
                        $status = json_decode(file_get_contents("php://input"), true);
                        $controller->setUserActiveStatus($uri[2], $status["activeStatus"]);
                    }
                }
                break;

            default:
                $controller->notFound();
                break;
            }
        break;

    case "customers":
        $controller = new CustomerController();

        switch ($requestMethod) 
        {
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

        switch ($requestMethod) 
        {
            case "GET":
                isset($uri[2]) ? $controller->getGenre($uri[2]) : $controller->getGenres(); 
                break;
            case "POST":
                $genre = json_decode(file_get_contents("php://input"), true);
                $controller->createGenre($genre);
                break;
            case "PUT":
                $updatedGenre = json_decode(file_get_contents("php://input"), true);
                $controller->updateGenre($updatedGenre);
            case "DELETE":
                $controller->deleteGenre($uri[2]);
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "invoices":
        $controller = new InvoiceController();

        switch ($requestMethod) 
        {
            case "GET":
                break;
            case "PUT":
                break;
            case "POST":
                break;
            case "DELETE":
                break;
            default:
                $controller->notFound();
                break;
        }
        break;
        
    case "mediatype":
        $controller = new MediaTypeController();

        switch ($requestMethod) 
        {
            case "GET":
                isset($uri[2]) ? $controller->getMediaType($uri[2]) : $controller->getMediaTypes(); 
                break;
            case "POST":
                $mediatype = json_decode(file_get_contents("php://input"), true);
                $controller->createMediaType($mediatype);
                break;
            case "DELETE":
                $controller->deleteMediaType($uri[2]);
                break;
            default:
                $controller->notFound();
                break;
        }
        break;

    case "tracks":
        $controller = new TrackController();

        switch ($requestMethod) 
        {
            case "GET":
                isset($uri[2]) ? $controller->getTrack($uri[2]) : $controller->getTracks(); 
                break;
            case "PUT":
                $track = json_decode(file_get_contents("php://input"), true);
                $controller->updateTrack($track);
                break;
            case "POST":
                $track = json_decode(file_get_contents("php://input"), true);
                $controller->createTrack($track);
                break;
            case "DELETE":
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
?>