<?php

namespace App\Http\Controllers\Armada;

use App\Armada;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class ArmadaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $armadas_name = Armada::distinct()->get(['company_name']);
        return $this->showMessage($armadas_name);
    }
}
