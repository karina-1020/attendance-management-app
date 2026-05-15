<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StampCorrectionRequestController extends Controller
{
//     public function index()
//     {
//         return view('stamp_correction_request_list');
//     }
// }

public function index(Request $request)
{
    $status = $request->query('status', 'pending'); // default 承認待ち

    $query = StampCorrectionRequest::query();

    if ($status === 'approved') {
        $query->where('status', 'approved');
    } else {
        $query->where('status', 'pending');
    }

    $requests = $query->get();

    return view('stamp_correction_request.list', compact('requests', 'status'));
}
};