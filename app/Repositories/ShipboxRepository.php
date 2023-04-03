<?php

namespace App\Repositories;

use App\Interfaces\CourierInterface;

class ShipboxRepository implements CourierInterface
{
    public function metadata()
    {
        // Dummy.
        return response()->json(['name' => 'API: Courier: shipbox', 'features' => ['create_shipment', 'void_shipment', 'shipment_status', 'track_shipment', 'create_waybill', 'print_waybill_label']]);
    }

    public function create_shipment()
    {
        //
    }

    public function void_shipment($shipment_number)
    {
        //
    }

    public function shipment_status($shipment_number)
    {
        //
    }

    public function track_shipment($shipment_number)
    {
        //
    }

    public function create_waybill()
    {
        //
    }

    public function print_waybill_label($shipment_number)
    {
        //
    }
}
