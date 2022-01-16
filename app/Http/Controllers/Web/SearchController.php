<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avg =  DB::table('ratings')->sum('rating');
        $ratings = Rating::all();
        $search_text = $_GET['query'];
        $stores = Store::where('name','LIKE','%'.$search_text.'%')->get();
        return view('web.search',compact('stores','ratings','avg'))->with('category');
    }
}
