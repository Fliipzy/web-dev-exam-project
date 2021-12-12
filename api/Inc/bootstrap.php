<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

//include configuration files
require_once(PROJECT_ROOT_PATH . "/Inc/config.php");

//include controller files
require_once(PROJECT_ROOT_PATH . "/Controllers/BaseController.php");
require_once(PROJECT_ROOT_PATH . "/Controllers/AuthenticationController.php");
require_once(PROJECT_ROOT_PATH . "/Controllers/AlbumController.php");
require_once(PROJECT_ROOT_PATH . "/Controllers/ArtistController.php");
require_once(PROJECT_ROOT_PATH . "/Controllers/CustomerController.php");
require_once(PROJECT_ROOT_PATH . "/Controllers/MediaTypeController.php");
require_once(PROJECT_ROOT_PATH . "/Controllers/InvoiceController.php");
require_once(PROJECT_ROOT_PATH . "/Controllers/TrackController.php");
require_once(PROJECT_ROOT_PATH . "/Controllers/GenreController.php");

//include model files
require_once(PROJECT_ROOT_PATH . "/Models/Database.php");
require_once(PROJECT_ROOT_PATH . "/Models/AlbumModel.php");
require_once(PROJECT_ROOT_PATH . "/Models/ArtistModel.php");
require_once(PROJECT_ROOT_PATH . "/Models/AuthenticationModel.php");
require_once(PROJECT_ROOT_PATH . "/Models/CustomerModel.php");
require_once(PROJECT_ROOT_PATH . "/Models/GenreModel.php");
require_once(PROJECT_ROOT_PATH . "/Models/InvoiceModel.php");
require_once(PROJECT_ROOT_PATH . "/Models/MediaTypeModel.php");
require_once(PROJECT_ROOT_PATH . "/Models/TrackModel.php");
?>