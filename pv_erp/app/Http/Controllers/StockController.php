<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockCreateRequest;
use App\Models\Stock;
use App\Models\Uom;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use DataTables;

class StockController extends Controller
{
    private $stock;

    public function __construct(StockRepository $stock)
    {
        $this->stock = $stock;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Stock::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('uom', function ($model) {
                    return $model->uom ? $model->uom->name : '';
                })
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</button>';
                    $btn .= '<button id="deleteModal" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalCenter" onclick=deleteData("backend/customers",' . $model->id . ')>Delete</button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $uoms = Uom::all();
        // dd($uoms);
        return view('backend.stock.index', compact('uoms'));
        // return view('backend.stock.index')->with('target', $uoms = null);
    }

    public function store(StockCreateRequest $request)
    {
        $validated_data = $request->validated();
        $validated_data['uuid'] = 'sdfgh94613sdfgh4sdfg';
        $validated_data['code'] = 'C001';
        $this->stock->save($validated_data);
        return redirect(route('stocks.index'));
        // return redirect()->route('car_parts.index')->with('success', trans('controller.success.create', ['model' => "CarPart"]));
    }
}
