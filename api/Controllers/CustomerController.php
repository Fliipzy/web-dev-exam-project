<?php

class CustomerController extends BaseController
{
    /**
     * GET /api/customers
     */
    public function getCustomers() {
        $queryParams = array(); 
        $this->getQueryStringParams($queryParams);

        try {
            $model = new CustomerModel();
            $limit = null;

            if (isset($queryParams['limit']) && $queryParams['limit']) {
                $limit = $queryParams['limit'];
            }

            $customerArray = $model->getCustomers($limit);
            $this->responseData = json_encode($customerArray);
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }
        
        $this->handleResponse();
    }

    /**
     * GET /api/customers/:id
     */
    public function getCustomer($id) {
        try {
            $customerModel = new CustomerModel();
            $customer = $customerModel->getCustomer($id);

            if ($customer) {
                $this->responseData = json_encode($customer);
            }
            else {
                $this->errorDescription = "Customer not found";
                $this->errorHeader = "HTTP/1.1 404 Not Found";
            }
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * PUT /api/customers
     */
    public function updateCustomer($updatedCustomer) {
        try {
            $customerModel = new CustomerModel();
            if ($customerModel->updateCustomer($updatedCustomer) == 0) {
                $this->errorDescription = "No information was changed";
                $this->errorHeader = "HTTP/1.1 400 Bad Request";
            }
            else {
                // update session with new customer information
                $customer = $customerModel->getCustomerById($_SESSION["id"]);
                $_SESSION["customer"]  = $customer;
            }
        } 
        catch (Exception $exception) {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }
}
?>