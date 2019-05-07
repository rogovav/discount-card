<?php

namespace App\Http\Controllers;

use App\Condition;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    public function index()
    {
        $conditions = Condition::all()->first();
        return view('conditions.index', compact('conditions'));
    }
}
