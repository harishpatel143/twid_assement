<?php

namespace App\Http\Controllers;

use App\Events\Event;
use App\Events\FetchDataEvent;
use App\Jobs\PinCodeProcess;
use App\Models\PinCode;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;
use Yajra\Datatables\DataTables;


class PinCodeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get listing
     * @param Request $request
     * @return \Illuminate\View\View|\Laravel\Lumen\Application
     */
    public function index(Request $request) {
        return view('index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return mixed
     * @throws \Exception
     */
    public function anyData()
    {
        return DataTables::of(PinCode::query())->make(true);
    }

    /**
     * Trigger fetch details event.
     *
     * @return JsonResponse
     */
    public function fetchDetails() {
        event(new FetchDataEvent());

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'You request has been processing.',
        ]);
    }

}
