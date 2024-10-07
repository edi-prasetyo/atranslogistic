<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


class ProvinceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:province-read|province-create|province-update|province-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:province-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:province-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:province-delete', ['only' => ['destroy']]);
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $provinces = Province::orderBy('id', 'desc')
            ->with('city')
            ->paginate('10');
        $title = 'Delete Customer!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.provinces.index', compact('provinces'));
    }
    public function show($id)
    {
        $province = Province::where('id', $id)->first();
        $cities = City::where('province_id', $id)->get();
        return view('admin.provinces.show', compact('province', 'cities'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $province = new Province();
        $province->name = $validated['name'];
        $province->save();

        Alert::success('Province', 'Province Berhasil Dibuat');
        return redirect('provinces');
    }
    public function edit($id)
    {
        $province = Province::where('id', $id)->first();
        return view('admin.provinces.edit', compact('province'));
    }
    public function update(Request $request, $province)
    {
        $province = Province::findOrFail($province);
        $province->name = $request['name'];
        $province->update();
        Alert::success('Province', 'Province Berhasil Dibuat');
        return redirect()->back();
    }
    public function destroy($id)
    {
        Province::where('id', $id)->delete();
        Alert::success('Customer', 'Berhasil di Hapus');
        return back();
    }
}
