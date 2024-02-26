<?php

namespace App\Http\Controllers;

use App\Http\Requests\UOMCreateRequest;
use App\Models\UOM;
use Illuminate\Http\Request;
use App\Repositories\UOMRepository;
use Datatables;
use Exception;

class UOMController extends Controller
{
    private $uom;

    public function __construct(UOMRepository $uom)
    {
        $this->uom = $uom;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(UOM::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    // $url = route('uoms.destroy', $model->uuid);//  'backend/uoms/'.$model->uuid;
                    $url = 'backend/uoms/'.$model->uuid;
                    $btn = '<button type="button" class="btn btn-secondary btnEdit mr-3" data-toggle="modal" data-target="#editModal">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal" onclick="deleteData(\''.$url.'\')">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.uom.index');
    }

    public function create()
    {
        return view('backend.uom.create');
    }
    public function show($uuid)
    {
        return 'show';
    }

    public function edit($uuid)
    {
        // if (!auth()->user()->can(EDIT_CUSTOMER)) {
        //     abort(403);
        // }
        $uom = UOM::where('uuid', $uuid)
                  ->where('is_delete', false)
                  ->first();
        return response()->json($uom);
        // return redirect()->route('home')->with('message', 'Post Deleted!');
    }

    public function store(UOMCreateRequest $request)
    {
        $validated_data = $request->validated();
        try{
            $this->uom->save($validated_data);
        }catch(Exception $e){
            dd($e);
        }

        return redirect()->route('uoms.index')->with('success', 'Save Successfully!');
    }

    public function update(UOMCreateRequest $request, $uuid)
    {
        if ($request->ajax()) {
            $validated_data = $request->validated();
            $this->uom->update($validated_data, $uuid);
        }
        // return ('success', 'Update Successfully!');
        // return redirect()->route('uoms.index')->with('success', 'Update Successfully!');
    }

    public function destroy($uuid){
        try{
            $this->uom->destroy($uuid);
        }catch(Exception $e){
            dd($e);
        }
        return redirect()->route('uoms.index')->with('success', 'Delete Successfully!');
    }
}
