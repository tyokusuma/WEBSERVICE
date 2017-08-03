<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function index()
    {   
        $chooseMonth = 7;
        $chooseYear = 2017;
        $chooseDate = 1;
        $setDate = Carbon::create($chooseYear, $chooseMonth, $chooseDate);
        $tglAwal = $setDate->startOfMonth()->toDateString();
        $tglAkhir = $setDate->endOfMonth()->toDateString();
        $tglAwal = intval(substr($tglAwal, 8, 2));
        $tglAkhir =intval(substr($tglAkhir, 8, 2));
        // dd($tglAkhir);
        $data = [];

        for($i=$tglAwal; $i<=$tglAkhir; $i++) {
            $compare = '2017-07'.$i;
            $transactions = Transaction::where('created_at', $compare)->get();
            $data['tgl'.$i] = $transactions;
        }
        // $notifs = request()->get('notifs');
        // return view('layouts.web.etc.graphic.graph')->with('notifs', $notifs);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $transactions = 
        $notifs = request()->get('notifs');
        return view('layouts.web.etc.graphic.index', ['notifs', $notifs]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
