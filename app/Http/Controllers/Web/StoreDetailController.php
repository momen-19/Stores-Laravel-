<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(['Stores'])->get();
        $list_Categories = Category::all();
        $stores = Store::all();
        $rating = Rating::all();
        $avg =  DB::table('ratings')->sum('rating');
        return view('web.stores',compact('stores','categories','list_Categories','rating','avg'))->with('store');
    }


}
