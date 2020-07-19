<?php

namespace App\Http\Controllers;

use App\traits\ApiResponser;

class ApiController extends Controller
{
    /**
     * The ApiController is extended by all controller to use ApiResponser Trait .
     *
     * @var array
     */
    use ApiResponser;
}
