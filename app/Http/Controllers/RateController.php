<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class RateController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:rate-read|rate-create|rate-update|rate-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:rate-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rate-update', ['only' => ['update', 'update']]);
        $this->middleware('permission:rate-delete', ['only' => ['destroy']]);
        $this->middleware(['auth', 'verified']);
    }


    public function index()
    {
        $cities = City::all();
        // $rates = Rate::orderBy('id', 'desc')
        //     ->select('rates.*', 'cities.name as city_name')
        //     ->join('cities', 'cities.id', '=', 'rates.origin')
        //     // ->with('city')
        //     ->paginate(10);

        $rates = Rate::select('rates.*', 'origin.name as fromOrigin', 'destination.name as toDestination')

            ->join('cities as origin', 'origin.id', '=', 'origin.id')
            ->join('cities as destination', 'destination.id', '=', 'destination.id')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // return $rates;

        // $rates = Rate::orderBy('id', 'desc')
        //     ->paginate(10);

        // return $rates;
        return view('admin.rates.index', compact('rates', 'cities'));
    }
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'origin' => 'required_with:rates.*.destination',
        //     'destination' => 'required_with:rates.*.origin',
        //     'price' => 'required'
        // ])->safe()->all();



        $validator = $request->validate([
            'origin' => [
                'required',
                Rule::unique('rates')->where(function ($query)  use ($request) {
                    return $query->where('origin', $request->origin)
                        // ->where('origin', $request->destination)
                    ;
                })
            ],
            'destination' => [
                'required',
                Rule::unique('rates')->where(function ($query) use ($request) {
                    return $query->where('destination', $request->destination)
                        // ->where('destination', $request->origin)
                    ;
                })
            ],
            'price' => ['required']
        ]);


        // $validator = $request->validated();

        $rate = new Rate();

        $rate->origin = $validator['origin'];
        $rate->destination = $validator['destination'];
        $rate->price = $validator['price'];
        $rate->save();

        // $origin_detail = City::where('id', $rate->origin)->first();
        // $destination_detail = City::where('id', $rate->destination)->first();
        // $origin_name = $origin_detail->name;
        // $destination_name = $destination_detail->name;

        // $update_rate = Rate::where('id', $rate->id)->first();
        // $update_rate->origin_name = $origin_name;
        // $update_rate->destination_name = $destination_name;
        // $update_rate->update();


        // $update_rate = Rate::where('id', $rate->id)->first();
        // $update_rate->origin

        return redirect()->back();
    }
}
