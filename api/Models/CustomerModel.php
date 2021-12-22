<?php
require_once(PROJECT_ROOT_PATH . "/Models/Database.php");

class CustomerModel extends Database
{
    public function getCustomers($limit)
    {   
        return $this->select("SELECT * FROM `customer` ORDER BY `CustomerId` ASC LIMIT ?", $limit ? $limit : -1);
    }

    public function getCustomer($id)
    {
        $results = $this->select("SELECT * FROM `customer` WHERE `CustomerId` = ?", $id);
        return $results ? $results[0] : null;
    }

    public function getCustomerByEmail($email)
    {
        $results = $this->select("SELECT * FROM `customer` WHERE `Email` = ?", $email);
        return $results ? $results[0] : null;
    }

    public function getCustomerById($id) 
    {
        $results = $this->select("SELECT * FROM `customer` WHERE `CustomerId` = ?", $id);
        return $results ? $results[0] : null;
    }

    public function updateCustomer($updatedCustomer)
    {
        $updatedCustomerParams = [
            htmlspecialchars($updatedCustomer["firstName"]),
            htmlspecialchars($updatedCustomer["lastName"]),
            htmlspecialchars($updatedCustomer["company"]),
            htmlspecialchars($updatedCustomer["address"]),
            htmlspecialchars($updatedCustomer["city"]),
            htmlspecialchars($updatedCustomer["state"]),
            htmlspecialchars($updatedCustomer["country"]),
            htmlspecialchars($updatedCustomer["postalCode"]),
            htmlspecialchars($updatedCustomer["phone"]),
            htmlspecialchars($updatedCustomer["fax"]),
            htmlspecialchars($updatedCustomer["email"]),
            htmlspecialchars($updatedCustomer["customerId"])
        ];

        $statement = $this->executeStatement(
            "UPDATE `customer` 
            SET `FirstName` = ?, `LastName` = ?, `Company` = ?, 
            `Address` = ?, `City` = ?, `State` = ?, `Country` = ?, 
            `PostalCode` = ?, `Phone` = ?, `Fax` = ?, `Email` = ?
            WHERE `CustomerId` = ?", $updatedCustomerParams);
        
        return $statement->rowCount();
    }
}
?>