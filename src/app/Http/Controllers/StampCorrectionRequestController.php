<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class StampCorrectionRequestController extends Controller
{
public function index()
{
    if (auth()->user()->role === 'admin') {

        $requests = StampCorrectionRequest::all();

        return view(
            'admin.stamp_correction_request_list',
            compact('requests')
        );

    } else {

        $requests = StampCorrectionRequest::where(
            'user_id',
            auth()->id()
        )->get();

        return view(
            'stamp_correction_request.list',
            compact('requests')
        );
    }
}
};