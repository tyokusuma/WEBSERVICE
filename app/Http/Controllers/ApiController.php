<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ApiController extends Controller
{
 /**
 * Class ApiController
 *
 * @package App\Http\Controllers
 */

    use ApiResponser;

    public function __construct() {
    	$this->middleware('auth:api');        	
    }
}
