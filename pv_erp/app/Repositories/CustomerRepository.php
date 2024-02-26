<?php

namespace App\Repositories;

use App\Interfaces\CustomerInterface;
use App\Interfaces\CustomerInterface as InterfacesCustomerInterface;
use App\Traits\DelegatesToModels;
use App\Models\Customer;
// use Illuminate\Http\Resources\DelegatesToResource;
use Illuminate\Support\Str;

class CustomerRepository implements CustomerInterface {

    use DelegatesToModels;
    protected $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function save($data)
    {
        $customer = new $this->model;

        // dd($data);
        $customer['uuid'] = $data['uuid'];
        $customer['code'] = $data['code'];
        $customer['name'] = $data['name'];
        $customer['phone'] = $data['phone'];
        $customer['address'] = $data['address'];
        $customer['contact_person'] = $data['contact_person'];
        $customer['email'] = $data['contact_person'];
        $customer['is_delete'] = false;
        $customer['created_by'] = '';

        $customer->save();

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

    public function update($id, $data)
    {
        $customer = Customer::query()->findOrFail($id);
        if($customer){
            $customer->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'contact_person' => $data['contact_person'],
                'email' => $data['email'],
            ]);
        }else{
            // return error
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
        $customer = Customer::query()->findOrFail($id);
        if($customer){
            return $customer;
        }else{
            //return error msg
        }
    }
}