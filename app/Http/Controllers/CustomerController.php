<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function show(Request $request)
    {
        $customer = Customer::where('email', $request->email)->get()->last();
        if ($customer) {
            $code = $request->code;
            $customer->code = (int) $code;
//            Mail::send('email', ['code' => $code], function ($m) use ($customer) {
//                $m->from('card@krepm.ru', 'KrepM');
//                $m->to($customer->email, $customer->name)->subject('Verification');
//            });


            $from = "card@krepm.ru";
            $to = $customer->email;
            $subject = "Verification";
            $message = "Код подтверждения: " . $code;
            $headers = "From:" . $from;
            mail($to,$subject,$message, $headers);


            return $customer;
        }
        return response()->json(['message' => 'Not found'], 404);
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
            'email' => $request->email,
            'MAC' => Str::random(20),
            'sum' => 0,
            'percent' => 3,
            'card_number' => str_pad($lastCardNumber + 1, 5, '0', STR_PAD_LEFT)
        ]);
        return $customer;
    }

}
