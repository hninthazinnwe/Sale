<?php

namespace App\Repositories;

use App\Interfaces\UomInterface;
use App\Models\Uom;
use App\Traits\DelegatesToModels;
use Illuminate\Support\Str;

class UOMRepository implements UomInterface {

    use DelegatesToModels;
    protected $model;

    public function __construct(Uom $uom)
    {
        $this->model = $uom;
    }

    public function save($data)
    {
        $uom = new $this->model;

        // $uom['code'] = '0004';
        $uom['name'] = $data['name'];
        $uom['symbol'] = $data['symbol'];
        $uom['unit'] = $data['unit'];
        $uom['is_delete'] = false;
        $uom['created_by'] = '';

        $uom->save();

    }

    public function edit($id)
    {
        $customer = Customer::query()->findOrFail($id);
        if($customer){
            return $customer;
        }else{
            // return error
        }
    }

    public function update($data, $uuid)
    {
        $uom = UOM::query()->where('uuid', $uuid)->first();
        if($uom){
            $uom->update([
                'name' => $data['name'],
                'symbol' => $data['symbol'],
                'unit' => $data['unit'],
            ]);
        }else{
            return 'error-------';
        }
    }

    public function index($request)
    {
        $totalData = Customer::count();
        $customers = Customer::query()->orderBy('created_at', 'desc')->get();
        $data = array();
        if(!empty($customers)){
            foreach($customers as $customer){
                $row['code'] = $customer->code;
                $row['name'] = $customer->name;
                $row['phone'] = $customer->phone;
                $row['contact_person'] = $customer->contact_person;
                $row['email'] = $customer->email;
                $row['address'] = Str::limit($customer->address, 20);

                $data[] = $row;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data" => $data
        );
        dd($totalData);
        return $json_data;
    }

    public function show($id)
    {
        //
    }

    public function destroy($uuid)
    {
        $uom = UOM::query()->where('uuid', $uuid)->first();
        if($uom){
            $uom->delete();
        }else{
            //return error msg
        }
    }
}