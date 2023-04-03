<?php

namespace App\Repositories;

use App\Interfaces\CourierInterface;
use Alhoqbani\SmsaWebService\Exceptions\SmsaWebServiceException;
use Alhoqbani\SmsaWebService\Models\Customer;
use Alhoqbani\SmsaWebService\Models\Shipment;
use Alhoqbani\SmsaWebService\Smsa;

class SmsaRepository implements CourierInterface
{
    protected $smsa;

    public function __construct()
    {
        $this->smsa = new Smsa(env('SMSA_PASSKEY')); // I need a correct Passkey for SMSA
    }

    /**
     * Courier metadata.
     */
    public function metadata()
    {
        // Dummy.
        return response()->json(['name' => 'API: Courier: smsa', 'features' => ['create_shipment', 'void_shipment', 'shipment_status', 'track_shipment', 'create_waybill', 'print_waybill_label']]);
    }

    /**
     * Create shipment.
     */
    public function create_shipment()
    {
        // Minimum required fields to create a shipment.
        // The hard coded inputs should be received and validated from the frontend form.
        $customer = new Customer(
            'Customer Name', //customer name
            '0500000000', // mobile number. must be > 9 digits
            '10 King Fahad Road', // street address
            'Riyadh', // city
            'Saudi Arabia' // country
        );

        $shipment = new Shipment(
            time(), // Refrence number
            $customer, // Customer object
            Shipment::TYPE_DLV // Shipment type
        );

        $shipment->setWeight('123');
        $shipment->setItemsCount('1');

        try {
            $result = $this->smsa->createShipment($shipment);
            // $result->data; // 29001931579

            return response()->json($result->jsonSerialize(), 201);
        } catch (SmsaWebServiceException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'type' => get_class($e)
            ], 400);
            // return response()->json(
            //     $e->smsaResponse->jsonSerialize(),
            //     400
            // );
        }
    }

    /**
     * Cancel shipment.
     */
    public function void_shipment($shipment_number)
    {
        // Disable throwing exceptions
        $this->smsa->shouldUseExceptions = false;

        $result = $this->smsa->cancel($shipment_number, 'Reason to void the shipment');

        if ($result->success) {
            return response()->json($result->jsonSerialize(), 202);
        } else {
            return response()->json($result->jsonSerialize(), 400);
        }
    }

    /**
     * Shipment status.
     */
    public function shipment_status($shipment_number)
    {
        try {
            $status = $this->smsa->status($shipment_number);

            return response()->json([
                'status' => $status->data
            ]);
        } catch (SmsaWebServiceException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'type' => get_class($e)
            ], 400);
        }
    }

    /**
     * Track shipment.
     */
    public function track_shipment($shipment_number)
    {
        try {
            $track = $this->smsa->track($shipment_number);

            return response()->json([
                'track' => $track->data
            ]);
        } catch (SmsaWebServiceException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'type' => get_class($e)
            ], 400);
        }
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
