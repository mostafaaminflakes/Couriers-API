<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CourierGateway;

class ApiCourierController extends Controller
{
    protected $courierGatewayRegistry;

    public function __construct(CourierGateway $registry)
    {
        $this->courierGatewayRegistry = $registry;
    }

    /**
     * Get courier metadata from repository.
     */
    public function get_courier_metadata(Request $request)
    {
        return $this->courierGatewayRegistry->get($request->get('courier_name'))->metadata();
    }

    /**
     * Create shipment through the associated repository.
     */
    public function create_shipment(Request $request)
    {
        return $this->courierGatewayRegistry->get($request->get('courier_name'))->create_shipment();
    }

    /**
     * Cancel shipment through the associated repository.
     */
    public function void_shipment(Request $request)
    {
        return $this->courierGatewayRegistry->get($request->get('courier_name'))->void_shipment($request->get('shipment_number'));
    }

    /**
     * Get shipment status through the associated repository.
     */
    public function shipment_status(Request $request)
    {
        return $this->courierGatewayRegistry->get($request->get('courier_name'))->shipment_status($request->get('shipment_number'));
    }

    /**
     * Track shipment through the associated repository.
     */
    public function track_shipment(Request $request)
    {
        return $this->courierGatewayRegistry->get($request->get('courier_name'))->track_shipment($request->get('shipment_number'));
    }
}
