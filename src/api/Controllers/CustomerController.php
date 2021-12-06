<?php

class CustomerController extends BaseController
{
    /**
     * GET /api/customers
     */
    public function getCustomers()
    {
        $queryParams = array(); 
        $this->getQueryStringParams($queryParams);

        try 
        {
            $model = new CustomerModel();
            $limit = null;

            if (isset($queryParams['limit']) && $queryParams['limit']) 
            {
                $limit = $queryParams['limit'];
            }

            $customerArray = $model->getCustomers($limit);
            $this->responseData = json_encode($customerArray);
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }
        
        $this->handleResponse();
    }

    /**
     * GET /api/customers/:id
     */
    public function getCustomer($id)
    {
        try 
        {
            $customerModel = new CustomerModel();
            $customerData = $customerModel->getCustomer($id);

            if ($customerData) {
                $this->responseData = json_encode($customerData);
            }
            else 
            {
                $this->errorDescription = "Customer not found";
                $this->errorHeader = "HTTP/1.1 404 Not Found";
            }
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }

    /**
     * PUT /api/customers
     */
    public function updateCustomer($updatedCustomer)
    {
        try 
        {
            $customerModel = new CustomerModel();
            $count = $customerModel->updateCustomer($updatedCustomer);
            $this->responseData = json_encode(array("updated" => $count));
        } 
        catch (Exception $exception) 
        {
            $this->errorDescription = $exception->getMessage();
            $this->errorHeader = "HTTP/1.1 500 Internal Server Error";
        }

        $this->handleResponse();
    }
}
?>