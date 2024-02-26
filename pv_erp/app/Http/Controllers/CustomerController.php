<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerCreateRequest;
use App\Repositories\CustomerRepository;
use App\Models\Customer;
use Datatables;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(CustomerRepository $customer)
    {
        $this->customer = $customer;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Customer::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    // $btn = '<a href=' . route("customers.edit", $model->id) . ' class="btn btn-secondary px-3" id="btnEditCus">Edit</a>';
                    $btn = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</button>';
                    // $btn = '<button id="updateModal" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#deleteModalCenter" onclick=deleteData("backend/customers",' . $model->id . ')>Delete</button>';
                    $btn .= '<button id="deleteModal" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalCenter" onclick=deleteData("backend/customers",' . $model->id . ')>Delete</button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $customer = null;
        return view('backend.customer.index', compact('customer'));
    }

    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(CustomerCreateRequest $request)
    {
        // dd($request);
        $validated_data = $request->validated();
        $validated_data['uuid'] = 'sdfgh94613sdfgh4sdfg';
        $validated_data['code'] = 'C0001';
        $validated_data['contact_person'] = $request->contact_person;
        $this->customer->save($validated_data);
        return view('backend.customer.index');
        // return redirect()->route('car_parts.index')->with('success', trans('controller.success.create', ['model' => "CarPart"]));
    }

    public function edit($id)
    {
        $customer = $this->customer->edit($id);
        return view('backend.customer.edit', compact('customer'));
    }

    public function update($id,CustomerCreateRequest $customer)
    {
        $customer = $this->customer->update($id, $customer);
        return view('backend.customer.index');
    }
}
