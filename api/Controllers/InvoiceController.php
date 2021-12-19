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
            // add id from session to invoice model
            $invoice["customerId"] = $_SESSION["id"];
            
            
            // build the invoiceline array
            $trackModel = new TrackModel();
            $tracks = $trackModel->getTracksFromIds($_SESSION["cart"]);
            $invoiceLines = [];
            foreach ($tracks as $track) {
                if (array_key_exists($track, $invoiceLines)) {
                    $invoiceLines[$track]["quantity"]++;
                }
                else {
                    $invoiceLines[$track] = (object) ["trackId" => $track, "unitPrice" => $track["UnitPrice"], "quantity" => 1];
                }
            }
            
        } 
        catch (Exception $exception) {
            
        }

        $this->handleResponse();
    }
}

?>