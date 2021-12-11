<?php

class AuthenticationModel extends Database
{
    public function changeCustomerPassword($customerId, $newPassword)
    {
        $statement = $this->executeStatement("UPDATE `customer` SET `Password` = ? WHERE `CustomerId` = ?", [$customerId, $newPassword]);
        return $statement->rowCount();
    }

    public function getAdminObject()
    {
        $adminArray = $this->select("SELECT * FROM `admin`");
        return $adminArray ? $adminArray[0] : null;
    }
}

?>