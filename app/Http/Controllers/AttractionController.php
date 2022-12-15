<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attraction\StoreRequest;
use App\Http\Requests\Attraction\UpdateRequest;
use App\Http\Resources\AttractionResource;
use App\Models\Attraction;
use App\Models\User;
use Illuminate\Http\Request;

class AttractionController extends BaseAttractionController
{
    public function index(Request $request)
    {
        $data = $request->validate([
                                       'filter'=>'boolean',
                                       'sorted'=>'boolean',
                                       'remember_token'=>'string'
                                   ]);
        $query = Attraction::where('is_published', '=', '1');

        if(isset($data['filter']) && $data['filter'] == true){
            $user = User::where('remember_token', $data['remember_token'])->first();
            $query = $query->where('id_creator', $user->id);
        }

        if(isset($data['sorted'])) {
            $query = $data['sorted']?$query->orderBy('title'):$query->orderBy('created_at', 'desc');
        }

        return AttractionResource::collection($query->paginate(5));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->service->store($data);

        return response()->json($result);
    }

    public function show($attraction)
    {
        $attraction = Attraction::where('id', $attraction)->first();
        return new AttractionResource($attraction);
    }

    public function update($attraction, UpdateRequest $request)
    {
        $attraction = Attraction::where('id', $attraction)->first();
        $data = $request->validated();
        unset($data['remember_token']);
        $attraction->update($data);

        return new AttractionResource($attraction);
    }
}
