<?php
require(__DIR__ . "/Inc/bootstrap.php");

//get API request uri
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = substr($uri, strpos($uri, "/api") + 5);
$uri = explode("/", $uri);

switch ($uri[0]) {
    case 'customers':
        require(PROJECT_ROOT_PATH . "/API/CustomerController.php");
        $customerController = new CustomerController();

        if (isset($uri[1])) 
        {
            $customerController->getCustomer($uri[1]);
        }
        else 
        {
            $customerController->getCustomers();
        }

        $customerController = null;
        break;
    
    default:
        echo "something else: " . $uri[0];
        break;
}

?>