<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:city-read|city-create|city-update|city-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:city-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:city-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:city-delete', ['only' => ['destroy']]);
        $this->middleware(['auth', 'verified']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $city = new City();
        $city->name = $validated['name'];
        $city->province_id = $request['province_id'];
        $city->save();

        Alert::success('Kota', 'Kota Berhasil Dibuat');
        return redirect()->back();
    }
}
