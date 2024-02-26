<?php

namespace App\Repositories;

use App\Models\Location;
use App\Traits\DelegatesToModels;

Class LocationRepository extends BaseRepository {
    use DelegatesToModels;
    protected $model;

    function __construct(Location $location)
    {
        $this->model = $location;
    }

    public function save($data)
    {
        $location = new $this->model;
        $location['name'] = $data['name'];
        $location['address'] = $data['address'];
        $location['phone'] = $data['phone'];
        $location['email'] = $data['email'];
        $location['is_delete'] = false;
        $location['created_by'] = '';

        $location->save();
    }

    public function edit($uuid)
    {
        $location = Location::query()->where('uuid', $uuid)->first();
        if($location){
            return $location;
        }else{
            // return error
        }
    }

    public function update($data, $uuid)
    {
        $location = Location::query()->where('uuid', $uuid)->first();
        if($location){
            $location->update([
                'name' => $data['editName'],
                'address' => $data['editAddress'],
                'phone' => $data['editPhone'],
                'email' => $data['editEmail'],
            ]);
        }else{
            return 'error-------';
        }
    }

    public function destroy($uuid)
    {
        $location = Location::query()->where('uuid', $uuid)->first();
        if($location){
            $location->delete();
        }else{
            //return error msg
        }
    }
}