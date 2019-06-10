<?php

namespace App\Http\Controllers;

use App\Customer;
use DOMDocument;
use Illuminate\Http\Request;

class XMLController extends Controller
{
    public function update(Request $request)
    {
        $file = $request->file('xml');
        if ($file)
        {
            $file = $file->openFile()->fread($file->getSize());
            $customers = new \SimpleXMLElement($file);
            foreach ($customers as $customer)
            {
                Customer::where('card_number', substr($customer->cardNumber, 5))->update([
                    'sum' => $customer->sum,
                    'percent' => $customer->percent,
                ]);
            }
            return redirect()->route('customers')->with('status', 1);
        } else {
            return redirect()->route('customers')->with('status', 0);
        }
    }

    public function getXML(Request $request)
    {
        $customers = Customer::all();

        $dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
        $root = $dom->createElement("customers"); // Создаём корневой элемент
        $dom->appendChild($root);
        foreach ($customers as $item) {
            $customer = $dom->createElement("customer"); // Создаём узел "user"
            $fio = $dom->createElement("fio", $item->name . ' ' . $item->surname . ($item->patronymic ? (' ' . $item->patronymic) : null));
            $birthday = $dom->createElement("birthday", $item->birthday);
            $phone = $dom->createElement("phone", $item->phone);
            $cardNumber = $dom->createElement("cardNumber", "KREPM" . $item->card_number);
            $sum = $dom->createElement("sum", $item->sum);
            $percent = $dom->createElement("percent", $item->percent);
            $customer->appendChild($fio);
            $customer->appendChild($birthday);
            $customer->appendChild($cardNumber);
            $customer->appendChild($phone);
            $customer->appendChild($sum);
            $customer->appendChild($percent);
            $root->appendChild($customer);
        }
        $dom->save("customers.xml"); // Сохраняем полученный XML-документ в файл

        $file_name = "customers.xml";

        $file_path = public_path($file_name);
        return response()->download($file_path);
    }
}
