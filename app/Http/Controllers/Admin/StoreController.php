<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
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
        return view('admin.stores.index',compact('stores','categories','list_Categories'))->with('categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with(['Stores'])->get();
        $list_Categories = Category::all();
        return view('admin.stores.add',compact('categories','list_Categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('logo')) {
            $destinationPath = 'logo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['logo'] = "$profileImage";
        }

        Store::create($input);

        return redirect()->route('stores.index')
            ->with('success','stores created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store,Rating $rating)
    {
        $avg =  DB::table('ratings')->sum('rating');

        return view('admin.stores.show',compact('store','rating','avg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $list_Categories = Category::all();
        return view('admin.stores.edit',compact('store','list_Categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        {
            $input = $request->all();

            if ($image = $request->file('logo')) {
                $destinationPath = 'logo/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['logo'] = "$profileImage";
            }

            $store->update($input);

            return redirect()->route('stores.index')
                ->with('success','stores created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('stores.index')
            ->with('success','stores deleted successfully');
    }
}
