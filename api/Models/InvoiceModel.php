<?php

class InvoiceModel extends Database
{
    public function getInvoices($limit)
    {
        return $this->select("SELECT * FROM `invoice` ORDER BY `InvoiceId` ASC LIMIT ?", $limit ? $limit : -1);
    }

    public function getInvoice($id)
    {
        $results = $this->select("SELECT * FROM `invoice` WHERE `InvoiceId` = ?", $id);
        return $results[0];
    }

    public function createInvoice($invoice)
    {
        return $this->insert(
            "INSERT INTO `invoice` 
            (`CustomerId`, `InvoiceDate`, `BillingAddress`, `BillingCity`, `BillingState`, `BillingCountry`, `BillingPostalCode`, `Total`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)", $invoice);
    }

    public function deleteInvoice($id)
    {
        $statement = $this->executeStatement("DELETE FROM `invoice` WHERE `InvoiceId` = ?", $id);
        return $statement->rowCount();
    }
}

?>