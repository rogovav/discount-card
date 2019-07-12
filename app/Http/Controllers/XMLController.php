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
        if ($file) {
            $file = $file->openFile()->fread($file->getSize());
            $customers = new \SimpleXMLElement($file);
            foreach ($customers as $customer) {
                foreach ($customer->attributes() as $a => $b) {
                    if ($a == 'СуммаВыручки') {
                        $sum = floatval($b);

                        if ($sum < 7000) {
                            $percent = 3;
                        } elseif ($sum >= 7000 && $sum < 15000) {
                            $percent = 5;
                        } elseif ($sum >= 15000 && $sum < 30000) {
                            $percent = 7;
                        } else {
                            $percent = 10;
                        }
                    }


                    if ($a == 'НомерКарты') {
                        $cardNumber = substr($b, 5);
                    }
                }

                if ($sum && $cardNumber) {
                    Customer::where('card_number', $cardNumber)->update([
                        'sum' => $sum,
                        'percent' => $percent,
                    ]);
                }
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
        $root = $dom->createElement("Главный"); // Создаём корневой элемент
        $dom->appendChild($root);
        foreach ($customers as $item) {
            $customer = $dom->createElement("Держатель"); // Создаём узел "user"
//            $root->appendChild("Держатель");

            $domAttribute = $dom->createAttribute('ДержательИмя');
            $domAttribute->value = $item->name . ' ' . $item->surname . ($item->patronymic ? (' ' . $item->patronymic) : null);

            $customer->appendChild($domAttribute);

            $domAttribute = $dom->createAttribute('Телефон');
            $domAttribute->value = $item->phone;

            $customer->appendChild($domAttribute);

            $domAttribute = $dom->createAttribute('НомерКарты');
            $domAttribute->value = "KREPM" . $item->card_number;

            $customer->appendChild($domAttribute);

//            $customer->addAttribute('Телефон', $item->phone);
//            $customer->addAttribute('НомерКарты', "KREPM" . $item->card_number);
//            $fio = $dom->createElement("ДержательИмя", $item->name . ' ' . $item->surname . ($item->patronymic ? (' ' . $item->patronymic) : null));
//            $birthday = $dom->createElement("birthday", $item->birthday);
//            $phone = $dom->createElement("Телефон", $item->phone);
//            $cardNumber = $dom->createElement("НомерКарты", "KREPM" . $item->card_number);
//            $sum = $dom->createElement("СуммаВыручки", $item->sum);
//            $percent = $dom->createElement("percent", $item->percent);
//            $customer->appendChild($fio);
//            $customer->appendChild($birthday);
//            $customer->appendChild($cardNumber);
//            $customer->appendChild($phone);
//            $customer->appendChild($sum);
//            $customer->appendChild($percent);
            $root->appendChild($customer);
        }
        $dom->save("customers.xml"); // Сохраняем полученный XML-документ в файл

        $file_name = "customers.xml";

        $file_path = public_path($file_name);
        return response()->download($file_name);
    }
}
