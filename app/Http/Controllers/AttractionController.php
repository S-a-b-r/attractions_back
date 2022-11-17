<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attraction\StoreRequest;
use App\Models\Attraction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AttractionController extends BaseAttractionController
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->service->store($data);

        return response()->json($result);
    }

    public function show(Attraction $attraction)
    {
        return response()->json($attraction);
    }
}
