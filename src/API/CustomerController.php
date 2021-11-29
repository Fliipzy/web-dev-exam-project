<?php

class CustomerController extends BaseController
{
    /**
     * GET /api/customers
     */
    public function getCustomers()
    {
        $errorDesc = "";
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $queryParams = $this->getQueryStringParams();
        
        if (strtoupper($requestMethod) == "GET") 
        {
            try 
            {
                $customerModel = new CustomerModel();
                
                $limit = null;
                if (isset($queryParams['limit']) && $queryParams['limit']) {
                    $limit = $queryParams['limit'];
                }

                $customerArray = $customerModel->getAllCustomers($limit);
                $responseData = json_encode($customerArray);
                
                $customerModel = null;
            } 
            catch (Exception $exception) {
                $errorDesc = $exception->getMessage();
                $errorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        }
        else 
        {
            $errorDesc = "Method not supported";
            $errorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }
        
        if (!$errorDesc) {
            $this->sendOutput($responseData, array("Content-Type: application/json", "HTTP/1.1 200 OK"));
        }
        else 
        {
            $this->sendOutput(json_encode(array("error" => $errorDesc)),
                array("Content-Type: application/json", $errorHeader));
        }
        
    }

    /**
     * GET /api/customers/:id
     */
    public function getCustomer($id)
    {
        $errorDesc = "";
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == "GET") 
        {
            try 
            {
                $customerModel = new CustomerModel();
                $customerData = $customerModel->getCustomerById(intval($id));

                if ($customerData) {
                    $responseData = json_encode($customerData);
                }
                else 
                {
                    $errorDesc = "Customer not found";
                    $errorHeader = "HTTP/1.1 404 Not Found";
                }

                $customerModel = null;
            } 
            catch (Exception $exception) 
            {
                $errorDesc = $exception->getMessage();
                $errorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        }
        else 
        {
            $errorDesc = "Method not supported";
            $errorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }

        if (!$errorDesc) {
            $this->sendOutput($responseData, array("Content-Type: application/json", "HTTP/1.1 200 OK"));
        }
        else 
        {
            $this->sendOutput(json_encode(array("error" => $errorDesc)),
                array("Content-Type: application/json", $errorHeader));
        }
    }
}


?>