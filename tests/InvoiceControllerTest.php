<?php

class InvoiceControllerTest extends \PHPUnit\Framework\TestCase 
{
    public function test_should_increment_object_property_by_1() {
        $obj = ["value" => 1];
        $obj["value"]++;
        $this->assertEquals(2, $obj["value"]);
    }

    public function test_should_build_invoiceline_array_correctly() {
        $mockTracks = [
            ["TrackId" => 1, "UnitPrice" => 0.99],
            ["TrackId" => 1, "UnitPrice" => 0.99],
            ["TrackId" => 3, "UnitPrice" => 0.99],
            ["TrackId" => 4, "UnitPrice" => 0.99]
        ];

        $invoiceLines = [];

        foreach ($mockTracks as $track) {
            if (array_key_exists($track["TrackId"], $invoiceLines)) {
                $invoiceLines[$track["TrackId"]]["quantity"]++;
            }
            else {
                $invoiceLines[$track["TrackId"]] = ["trackId" => $track["TrackId"], "unitPrice" => $track["UnitPrice"], "quantity" => 1];
            }
        }

        //$invoiceLines[1]["quantity"] should be 2
        $this->assertEquals(2, $invoiceLines[1]["quantity"]);

        //$invoiceLines array length should be 3
        $this->assertCount(3, $invoiceLines);
    }
}