<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'ip' => 'unique:ratings',
            'store_id' => 'required',
        ]);
        $input = [
            'ip' => $request->getClientIp(),
            'rating' => $request->rating,
            'store_id' => $request->store_id,
        ];
        $ratings =  Rating::query()->create($input);
        $ratings->save();

        return redirect()->route('stores-details.index',compact('ratings'));

    }
}
