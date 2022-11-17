<?php

namespace App\Http\Controllers;

use App\Http\Services\AttractionService;

class BaseAttractionController extends Controller
{
    public $service;
    public function __construct(AttractionService $service)
    {
        $this->service = $service;
    }
}
