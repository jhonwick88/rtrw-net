<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as ApiController;
use App\Traits\JsonResponseTrait;

class BaseApiController extends ApiController
{
    use JsonResponseTrait;
    
}
