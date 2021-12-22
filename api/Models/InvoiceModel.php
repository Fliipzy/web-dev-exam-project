<?php

class InvoiceModel extends Database
{
    public function getInvoices($limit)
    {
        return $this->select(
            "SELECT `invoice`.*, CONCAT(`customer`.`FirstName`, ' ', `customer`.`LastName`) AS `Customer` 
            FROM `invoice` 
            INNER JOIN `customer`
                ON `invoice`.`CustomerId` = `customer`.`CustomerId`
            ORDER BY `InvoiceId` 
            ASC LIMIT ?", 
            $limit ? $limit : -1);
    }

    public function getInvoice($id)
    {
        $results = $this->select("SELECT * FROM `invoice` WHERE `InvoiceId` = ?", $id);
        return $results[0];
    }

    public function createInvoice($invoice, $invoiceLines)
    {
        $invoiceArray = [
            $invoice["customerId"],
            $invoice["billingAddress"],
            $invoice["billingCity"],
            $invoice["billingState"],
            $invoice["billingCountry"],
            $invoice["billingPostalCode"]
        ];

        // try to perform transaction, roll back if error occurs
        try {
            $this->startTransaction();

            // first, insert the new invoice
            $this->insert(
                "INSERT INTO `invoice` 
                (`CustomerId`, `InvoiceDate`, `BillingAddress`, 
                 `BillingCity`, `BillingState`, `BillingCountry`,
                 `BillingPostalCode`)
                 VALUES (?, NOW(), ?, ?, ?, ?, ?)", $invoiceArray); 

            // get the last inserted id
            $invoiceId = $this->getLastInsertedId();

            // now, insert all invoice lines
            foreach ($invoiceLines as $invoiceLine) {
                $this->createInvoiceLine($invoiceId, $invoiceLine);
            }

            // update the invoice 'Total' column, first get the sum of the 'UnitPrice' column for all invoices.
            $total = $this->executeStatement("SELECT SUM(`UnitPrice` * `Quantity`) FROM `invoiceline` WHERE `InvoiceId` = ?", $invoiceId)->fetchColumn();
            
            // update the invoice's 'Total' column
            $this->executeStatement("UPDATE `invoice` SET `Total` = ? WHERE `InvoiceId` = ?", [$total, $invoiceId]);

            // if no problems occured until now, commit the transaction
            $this->commitTransaction();
    
            // return the newly inserted invoice id
            return $invoiceId;
        } 
        catch (PDOException $exception) {
            // roll back and re-throw exception for invoice controller
            $this->rollBackTransaction();
            throw $exception;
        }
    }

    public function createInvoiceLine($invoiceId, $invoiceLine) {
        $invoiceLineArray = [
            $invoiceId,
            $invoiceLine["trackId"],
            $invoiceLine["unitPrice"],
            $invoiceLine["quantity"]
        ];

        $this->insert(
            "INSERT INTO `invoiceline` 
             (`InvoiceId`, `TrackId`, `UnitPrice`, `Quantity`)
             VALUES (?, ?, ?, ?)", $invoiceLineArray); 
    }
}

?>