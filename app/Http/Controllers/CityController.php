<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        $cities_page = City::paginate(5);
        return view('cities.list',compact('cities','cities_page'));
    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        $city = new City();
        $city->name = $request->input('name');
        Session::flash('success','Ban da them thanh cong');
        $city->save();
        return redirect()->route('cities.list');
    }

    public function edit($id)
    {
        $city = City::find($id);
        return view('cities.edit',compact('city'));
    }

    public function update(Request $request, $id)
    {
        $city = City::find($id);
        $city->fill($request->all());
        $city->name = $request->name;
        $city->save();
        Session::flash('success', 'Cập nhật thành công');
        return redirect()->route('cities.list');
    }

    public function destroy($id)
    {
        $city = City::find($id);
        $city->customers()->delete();
        $city->delete();
        return redirect()->route('cities.list');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        if(!$search)
        {
            return redirect()->route('cities.list');
        }

        $cities_page = City::where('name','like','%'.$search.'%')->paginate(5);
        Session::flash('search_result',true);
        return view('cities.list',compact('cities_page'));
    }
}
