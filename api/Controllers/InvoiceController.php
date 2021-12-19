<?php

class InvoiceController extends BaseController
{
    /**
     * GET /api/invoices
     */
    public function getInvoices()
    {

    }

    /**
     * GET /api/invoices/:id
     */
    public function getInvoice($id)
    {

    }

    /**
     * POST /api/invoices
     */
    public function createInvoice($invoice)
    {
        $model = new InvoiceModel();

        try {
            // if cart is empty
            if (count($_SESSION["cart"]) == 0) {
                $this->errorDescription = "Cart cannot be empty.";
                $this->errorHeader = "HTTP/1.1 400 Bad Request";
            }
            else {             
                // add id from session to invoice model
                $invoice["customerId"] = $_SESSION["id"];
                
                // get tracks from track model 
                $trackModel = new TrackModel();
                $tracks = $trackModel->getTracksFromIds($_SESSION["cart"]);
    
                // build the $invoiceLines array from $tracks array, by aggregating the tracks
                $invoiceLines = [];
    
                foreach ($tracks as $track) {
                    if (array_key_exists($track["TrackId"], $invoiceLines)) {
                        $invoiceLines[$track["TrackId"]]["quantity"]++;
                    }
                    else {
                        $invoiceLines[$track["TrackId"]] = ["trackId" => $track["TrackId"], "unitPrice" => $track["UnitPrice"], "quantity" => 1];
                    }
                }

                // finally, insert the invoice & invoice line data into db
                $model->createInvoice($invoice, $invoiceLines);

                // now set the checkoutDone flag variable, so user can visit checkout-done.php
                $_SESSION["checkoutDone"] = true;
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