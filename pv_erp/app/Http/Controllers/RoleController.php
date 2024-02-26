<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return Datatables::of(Role::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" class="btn btn-secondary btnEdit mr-3" data-toggle="modal" data-target="#editModal" onclick="editData(\''.$model->uuid.'\')">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal" onclick="deleteData(\''.$model->uuid.'\')">Delete</button>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.role.index');
    }

    public function store(Request $request){
        $validated_data = $this->validate($request, [
            "description"=>"required"
        ]);
        $brand = new Role();
        $brand['description'] = $validated_data['description'];
        $brand['is_delete'] = false;
        $brand['created_by'] = '';
        $brand->save();
        return redirect()->route('roles.index')->with('success', 'Save Successfully!');
    }

    public function edit($uuid){
        $brand = Role::where('uuid', $uuid)->first();
        return response()->json($brand);
    }
     
    public function update(Request $request, $uuid){
        $validated_data = $this->validate($request, [
            "editDescription"=>"required"
        ]);
        
        $brand = Role::query()->where('uuid', $uuid)->first();
        if($brand){
            $brand->update([
                'description' => $validated_data['editDescription'],
            ]);
        }
        return redirect()->route('roles.index')->with('success', 'Update Successfully!');
    }

    public function destroy($uuid){
        $brand = Role::query()->where('uuid', $uuid)->first();
        if($brand){
            $brand->delete();
        }
        return redirect()->route('roles.index')->with('success', 'Delete Successfully!');
    }
}
