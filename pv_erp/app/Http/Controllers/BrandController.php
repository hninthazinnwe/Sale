<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Brand;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return Datatables::of(Brand::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" class="btn btn-secondary btnEdit mr-3" data-toggle="modal" data-target="#editModal" onclick="editData(\''.$model->uuid.'\')">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal" onclick="deleteData(\''.$model->uuid.'\')">Delete</button>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.brand.index');
    }

    public function store(Request $request){
        $validated_data = $this->validate($request, [
            "name"=>"required"
        ]);
        $brand = new Brand();
        $brand['name'] = $validated_data['name'];
        $brand['is_delete'] = false;
        $brand['created_by'] = '';
        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Save Successfully!');
    }

    public function edit($uuid){
        $brand = Brand::where('uuid', $uuid)->first();
        return response()->json($brand);
    }
     
    public function update(Request $request, $uuid){
        $validated_data = $this->validate($request, [
            "editName"=>"required"
        ]);
        
        $brand = Brand::query()->where('uuid', $uuid)->first();
        if($brand){
            $brand->update([
                'name' => $validated_data['editName'],
            ]);
        }
        return redirect()->route('brands.index')->with('success', 'Update Successfully!');
    }

    public function destroy($uuid){
        $brand = Brand::query()->where('uuid', $uuid)->first();
        if($brand){
            $brand->delete();
        }
        return redirect()->route('brands.index')->with('success', 'Delete Successfully!');
    }
}
