<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
//        $customers = Customer::all();
        $cities = City::all();
        $customer_page = Customer::paginate(5);
        return view('customers.list',compact('cities','customer_page'));
    }

    public function create(){
        $cities = City::all();
        return view('customers.create', compact('cities'));
    }

    public function store(Request $request){
        $customer = new Customer();
        $customer->name     = $request->input('name');
        $customer->email    = $request->input('email');
        $customer->dob      = $request->input('dob');
        $customer->city_id  = $request->input('city_id');
        $customer->save();

        //tao moi xong quay ve trang danh sach khach hang
        return redirect()->route('customers.list');
    }

    public function edit($id){
        $customer = Customer::findOrFail($id);
        $cities = City::all();

        return view('customers.edit', compact('customer', 'cities'));
    }

    public function update(Request $request, $id)
    {
            $customer = Customer::findOrFail($id);
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->dob = $request->input('dob');
            $customer->city_id = $request->input('city_id');
            $customer->save();

            //dung session de dua ra thong bao
            Session::flash('success', 'Cập nhật khách hàng thành công');

            //cap nhat xong quay ve trang danh sach khach hang
            return redirect()->route('customers.list');
        }

    public function destroy($id)
    {
        $cutomers = Customer::find($id);
        $cutomers->delete();
        return redirect()->route('customers.list');
    }

    public function filterByCity(Request $request){
        $idCity = $request->input('city_id');

        //kiem tra city co ton tai khong
        $cityFilter = City::findOrFail($idCity);

        //lay ra tat ca customer cua cityFiler
        $customer_page = Customer::where('city_id', $cityFilter->id)->get();
        $totalCustomerFilter = count($customer_page);
        $cities = City::all();

        return view('customers.list', compact('customer_page', 'cities', 'totalCustomerFilter', 'cityFilter'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        if(!$search){
            return redirect()->route('customers.list');
        }
         $customer_page = Customer::where('name','like','%'.$search.'%')->paginate(5);
        $cities = City::all();
        Session::flash('search_result',true);
        return view('customers.list',compact('customer_page','cities'));
    }
}
