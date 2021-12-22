<?php

class AuthenticationModel extends Database
{
    public function changeCustomerPassword($customerId, $newPassword)
    {
        $statement = $this->executeStatement("UPDATE `customer` SET `Password` = ? WHERE `CustomerId` = ?", [$newPassword, $customerId]);
        return $statement->rowCount();
    }

    public function createCustomer($customer) {

        $customerArray = [
            htmlspecialchars($customer["firstName"]),
            htmlspecialchars($customer["lastName"]),
            htmlspecialchars($customer["email"]),
            htmlspecialchars($customer["password"])
        ];

        return $this->insert(
            "INSERT INTO `customer` (`FirstName`, `LastName`, `Email`, `Password`)
            VALUES (?, ?, ?, ?)", $customerArray);
    }

    public function getAdminObject()
    {
        $adminArray = $this->select("SELECT * FROM `admin`");
        return $adminArray ? $adminArray[0] : null;
    }
}

?>