<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function index()
    {
        return view('backend.sale.index');
    }

    public function create()
    {
        return view('backend.sale.create');
    }
}
