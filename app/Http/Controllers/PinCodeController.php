<?php

namespace App\Http\Controllers;

use App\Events\FetchDataEvent;
use App\Events\FetchDataUsingCommandEvent;
use App\Models\PinCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\DataTables;

/**
 * Class for Manage Pin code fetch and listing feature
 *
 * Class PinCodeController
 * @package App\Http\Controllers
 */
class PinCodeController extends Controller
{
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
     * Fetch details event using command.
     *
     * @return JsonResponse
     */
    public function fetchDetailsUsingCommand() {
        event(new FetchDataUsingCommandEvent());

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Your request is being processed. Please wait for a while.',
        ]);
    }

    /**
     * Trigger fetch details event.
     *
     * @return JsonResponse
     */
    public function fetchDetailsUsingJob() {
        event(new FetchDataEvent());

        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Your request is being processed. Please wait for a while.',
        ]);
    }

}
