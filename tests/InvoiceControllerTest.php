<?php

class InvoiceControllerTest extends \PHPUnit\Framework\TestCase 
{
    public function testShouldIncrementObjectValueByOne() {
        $obj = ["value" => 1];
        $obj["value"]++;
        $this->assertEquals(2, $obj["value"]);
    }
}