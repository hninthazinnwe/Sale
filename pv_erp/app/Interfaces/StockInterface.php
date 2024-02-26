<?php

namespace App\Interfaces;

Interface StockInterface {
    public function index($request);
    public function save($data);
    public function edit($id);
}