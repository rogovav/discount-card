<?php

namespace App\Http\Controllers;

use App\Customer;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;
use Spatie\ArrayToXml\ArrayToXml;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where('registered', true)->get();
        return view('customer.index', compact('customers'));
    }

    public function new()
    {
        $customers = Customer::where('registered', false)->get();
        $this->to_xml($customers);
        return view('customer.index', compact('customers'));
    }

    public function show(Request $request)
    {

    }

    function to_xml($customers)
    {
        $dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
        $root = $dom->createElement("customers"); // Создаём корневой элемент
        $dom->appendChild($root);
        foreach ($customers as $item) {
            $customer = $dom->createElement("customer"); // Создаём узел "user"
            $fio = $dom->createElement("fio", $item->name . ' ' . $item->surname . ($item->patronymic ? (' ' . $item->patronymic) : null));
            $cardNumber = $dom->createElement("cardNumber", $item->card_number);
            $phone = $dom->createElement("phone", $item->phone);
            $sum = $dom->createElement("sum", $item->sum);
            $percent = $dom->createElement("percent", $item->percent);
            $customer->appendChild($fio);
            $customer->appendChild($cardNumber);
            $customer->appendChild($phone);
            $customer->appendChild($sum);
            $customer->appendChild($percent);
            $root->appendChild($customer);
        }
        $dom->save("customers.xml"); // Сохраняем полученный XML-документ в файл
    }

}
