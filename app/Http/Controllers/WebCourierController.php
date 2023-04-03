<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebCourierController extends Controller
{
    public function index()
    {
        return view('couriers');
    }

    public function get_courier_metadata(Request $request)
    {
        $url = 'http://127.0.0.1:9000/api/courier_metadata';

        // TODO: We need authentication here

        $courier_api = Http::retry(3, 100)->acceptJson()->get($url, [
            'courier_name' => $request->courier_name,
        ]);

        return $courier_api->json();
    }

    public function create_shipment(Request $request)
    {
        $url = 'http://127.0.0.1:9000/api/create';

        // TODO: We need authentication here

        $courier_api = Http::retry(3, 100)->acceptJson()->get($url, [
            'courier_name' => $request->courier_name,
        ]);

        return response()->json($courier_api->json());
    }

    public function void_shipment(Request $request)
    {
        $url = 'http://127.0.0.1:9000/api/void';

        // TODO: We need authentication here

        $courier_api = Http::retry(3, 100)->acceptJson()->get($url, [
            'courier_name' => $request->courier_name,
            'shipment_number' => $request->shipment_number,
        ]);

        return $courier_api->json();
    }

    public function shipment_status(Request $request)
    {
        $url = 'http://127.0.0.1:9000/api/status';

        // TODO: We need authentication here

        $courier_api = Http::retry(3, 100)->acceptJson()->get($url, [
            'courier_name' => $request->courier_name,
            'shipment_number' => $request->shipment_number,
        ]);

        return $courier_api->json();
    }

    public function track_shipment(Request $request)
    {
        $url = 'http://127.0.0.1:9000/api/track';

        // TODO: We need authentication here

        $courier_api = Http::retry(3, 100)->acceptJson()->get($url, [
            'courier_name' => $request->courier_name,
            'shipment_number' => $request->shipment_number,
        ]);

        return $courier_api->json();
    }
}
