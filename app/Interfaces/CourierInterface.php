<?php

namespace App\Interfaces;

interface CourierInterface
{
    public function metadata();
    public function create_shipment();
    public function void_shipment($shipment_number);
    public function shipment_status($shipment_number);
    public function track_shipment($shipment_number);
    public function create_waybill();
    public function print_waybill_label($shipment_number);
}
