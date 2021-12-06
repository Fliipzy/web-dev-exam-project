<?php

class AuthenticationModel extends Database
{
    public function getCustomerPassword($customerId)
    {
        $statement = $this->executeStatement("SELECT `Password` FROM `customer` WHERE `CustomerId` = ? ", $customerId);
        return $statement->fetchColumn();
    }

    public function changeCustomerPassword($customerId, $newPassword)
    {
        $statement = $this->executeStatement("UPDATE `customer` SET `Password` = ? WHERE `CustomerId` = ?", [$customerId, $newPassword]);
        return $statement->rowCount();
    }
}

?>