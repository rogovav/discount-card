<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function show(Request $request)
    {
        $customer = Customer::where('phone', $request->phone)->get();
        return $customer;
    }

    public function store(Request $request)
    {
        $lastCustomer = Customer::orderBy('card_number')->get()->last();
        $lastCardNumber = ($lastCustomer? $lastCustomer->card_number : "00001");
        $customer = Customer::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'mac' => $request->mac,
            'card_number' => str_pad($lastCardNumber + 1, 5, '0', STR_PAD_LEFT)
        ]);
        return $customer;
    }

}
