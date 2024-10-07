<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class VehicleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:vehicle-read|vehicle-create|vehicle-update|vehicle-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:vehicle-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:vehicle-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:vehicle-delete', ['only' => ['destroy']]);

        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index', compact('vehicles'));
    }
    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicles.show', compact('vehicle'));
    }
    public function create()
    {
        return view('admin.vehicles.create');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'weight' => 'required',
            'wide' => 'required',
            'height' => 'required',
            'long' => 'required',
            'volume' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $vehicle = new Vehicle();
        $vehicle->name = $validated['name'];
        $vehicle->weight = $validated['weight'];
        $vehicle->wide = $validated['wide'];
        $vehicle->height = $validated['height'];
        $vehicle->long = $validated['long'];
        $vehicle->volume = $validated['volume'];
        $vehicle->price = $validated['price'];
        $vehicle->description = $request['description'];

        if ($request->hasFile('image')) {


            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/images/', $filename);

            $vehicle->image = $filename;
            $vehicle->image_url = URL::to('/uploads/images/' . $filename);
        }

        $vehicle->save();
        Alert::success('vehicle', 'Kendaraan Berhasil di buat');
        return redirect('vehicles');
    }

    public function edit($vehicle_id)
    {
        $vehicle = Vehicle::where('id', $vehicle_id)->first();
        return view('admin.vehicles.edit', compact('vehicle'));
    }
    public function update(Request $request, int $vehicle_id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'weight' => 'required',
            'wide' => 'required',
            'height' => 'required',
            'long' => 'required',
            'volume' => 'required',
            'price' => 'required',

        ]);

        $vehicle = Vehicle::where('id', $vehicle_id)->first();
        $vehicle->name = $validated['name'];
        $vehicle->weight = $validated['weight'];
        $vehicle->wide = $validated['wide'];
        $vehicle->height = $validated['height'];
        $vehicle->long = $validated['long'];
        $vehicle->volume = $validated['volume'];
        $vehicle->price = $validated['price'];
        $vehicle->description = $request['description'];


        if ($request->hasFile('image')) {

            $path = 'uploads/images/' . $vehicle->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/images/', $filename);

            $vehicle->image = $filename;
            $vehicle->image_url = URL::to('/uploads/images/' . $filename);
        }

        $vehicle->update();
        Alert::success('vehicle', 'Kendaraan Berhasil di Update');
        return redirect('vehicles');
    }
    public function destroy(int $vehicle_id)
    {
        $vehicle = vehicle::where('id', $vehicle_id)->first();

        $path = 'uploads/images/' . $vehicle->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $vehicle->delete();
        Alert::success('Kendaraan', 'Kendaraan Berhasil di Hapus');
        return redirect()->back();
    }
}
