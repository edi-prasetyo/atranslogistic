<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Rate;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PricingController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all();
        $origin = $request['origin'];
        $destination = $request['destination'];
        $result = '';

        $origin_name = City::where('id', $origin)->first();
        $destination_name = City::where('id', $destination)->first();



        if ($origin == '' || $destination == '' || $origin_name == '' || $destination_name == '') {
            return view('frontends.rates', compact('cities', 'result', 'origin', 'destination'));
        } else {
            $result = Rate::where(function (Builder $query) use ($origin, $destination) {
                $query->where('origin', $destination)
                    ->where('destination', $origin);
            })
                ->orWhere(function (Builder $query) use ($origin, $destination) {
                    $query->where('origin', $origin)
                        ->where('destination', $destination);
                })
                ->first();
            $vehicles = Vehicle::all();
            return view('frontends.rates', compact('vehicles', 'cities', 'result', 'origin', 'destination', 'origin_name', 'destination_name'));
        }
    }
}
