<?php

namespace App\Repositories;

use App\Interfaces\StockInterface;
use App\Models\Stock;
use App\Traits\DelegatesToModels;

Class StockRepository implements StockInterface{

    use DelegatesToModels;
    protected $model;

    public function __construct(Stock $stock)
    {
        $this->model = $stock;
    }

    public function index($request){

    }

    function save($data){
        $stock = new $this->model;

        $stock['uuid'] = $data['uuid'];
        $stock['code'] = $data['code'];
        $stock['name'] = $data['name'];
        $stock['barcode'] = $data['barcode'];
        $stock['buying_price'] = $data['buying_price'];
        $stock['selling_price'] = $data['selling_price'];
        $stock['wholesale_price'] = $data['wholesale_price'];
        $stock['uom_id'] = $data['uom_id'];
        $stock['is_stock'] = true;
        $stock['is_delete'] = false;
        $stock['created_by'] = '';

        $stock->save();
    }

    function edit($id){

    }
}