<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attraction\StoreRequest;
use App\Http\Requests\Attraction\UpdateRequest;
use App\Http\Resources\AttractionResource;
use App\Models\Attraction;

class AttractionController extends BaseAttractionController
{
    public function index()
    {
        $attractions = Attraction::where('is_published', '=', '1')->paginate(5);
        return AttractionResource::collection($attractions);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->service->store($data);

        return response()->json($result);
    }

    public function show(Attraction $attraction)
    {
        return new AttractionResource($attraction);
    }

    public function update(Attraction $attraction, UpdateRequest $request)
    {
        $data = $request->validated();
        $attraction->update($data);

        return new AttractionResource($attraction);
    }
}
