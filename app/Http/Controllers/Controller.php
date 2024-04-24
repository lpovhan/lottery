<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use IService;

abstract class Controller
{
    public $service;

    public function __construct(BaseService $service)
    {
        $this->service = $service;
    }
}
