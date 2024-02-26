<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationCreateRequest;
use DataTables;
use App\Models\Location;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $location;
    public function __construct(LocationRepository $location)
    {
        $this->location = $location;
    }
    public function index(Request $request){
        if ($request->ajax()) {
            return Datatables::of(Location::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" class="btn btn-secondary btnEdit mr-3" data-toggle="modal" data-target="#editModal" onclick="editData(\''.$model->uuid.'\')">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal" onclick="deleteData(\''.$model->uuid.'\')">Delete</button>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.location.index');
    }

    public function store(LocationCreateRequest $request){
        // return 'store';
        $validated_data = $request->validated();
        $this->location->save($validated_data);
        return redirect()->route('locations.index')->with('success', 'Save Successfully!');
    }

    public function edit($uuid){
        $location = $this->location->edit($uuid);
        return response()->json($location);
    }
     
    public function update(LocationCreateRequest $request, $uuid){
        $validated_data = $request->validated();
        $this->location->update($validated_data, $uuid);
        return redirect()->route('locations.index')->with('success', 'Update Successfully!');
    }

    public function destroy($uuid){
        $this->location->destroy($uuid);
        return redirect()->route('locations.index')->with('success', 'Delete Successfully!');
    }
}
