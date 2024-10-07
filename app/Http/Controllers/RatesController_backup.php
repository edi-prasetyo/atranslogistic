<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Rate;
use App\Models\Route as RouteModel;
use App\Models\Vehicle;
// use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all();
        $origin = $request['origin'];
        $destination = $request['destination'];
        $result = '';

        $origin_name = City::where('id', $origin)->first();
        $destination_name = City::where('id', $destination)->first();


        // return $origin->name;

        // if ($origin == null || $destination == null) {
        //     return view('frontends.rates', compact('cities'));
        // } else {
        //     $result = RouteModel::where(['origin' => $origin, 'destination' => $destination])->orWhere(['destination' => $origin, 'origin' => $destination])->first();
        //     $vehicles = Vehicle::all();
        //     // return $result;
        //     return view('frontends.rates', compact('vehicles', 'cities', 'result', 'origin', 'destination'));
        // }


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




        // return $result;
    }
}
