<?php
require_once(PROJECT_ROOT_PATH . "/Models/Database.php");

class CustomerModel extends Database
{
    public function getAllCustomers($limit)
    {   
        if ($limit) {
            return $this->select("SELECT * FROM customer ORDER BY customerId ASC LIMIT :limit", array(":limit" => $limit));
        }

        return $this->select("SELECT * FROM customer ORDER BY customerId ASC");
    }

    public function getCustomerById($id)
    {
        $results = $this->select("SELECT * FROM customer WHERE customerId = :id", array(":id" => $id));
        return $results ? $results[0] : null;
    }
}
?>