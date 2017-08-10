<?php

namespace App\Http\Controllers\Graph;

use App\Graphic;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function index()
    {   
        // //choosing user, month, year
        // $chooseMonth = 7;
        // $chooseYear = 2017;
        // $chooseDate = 1;
        // $setDate = Carbon::create($chooseYear, $chooseMonth, $chooseDate);
        // $tglAwal = $setDate->startOfMonth()->toDateString();
        // $tglAkhir = $setDate->endOfMonth()->toDateString();
        // $tglAwal = intval(substr($tglAwal, 8, 2));
        // $tglAkhir =intval(substr($tglAkhir, 8, 2));
        // // dd($tglAkhir);
        // $data = [];

        // for($i=$tglAwal; $i<=$tglAkhir; $i++) {
        //     $compare = '2017-07'.$i;
        //     $transactions = Transaction::where('created_at', $compare)->get();
        //     $data['tgl'.$i] = $transactions;
        // }
        // // $notifs = request()->get('notifs');
        // // return view('layouts.web.etc.graphic.graph')->with('notifs', $notifs);
    }

    public function create()
    {
        $notifs = request()->get('notifs');
        $users = User::all();
        $yearStart = Transaction::oldest()->first()->created_at->year;
        $yearEnd = Transaction::latest()->first()->created_at->year;
        if ($yearStart != $yearEnd) {
            $years = [];
            for($i = $yearStart; $i <= $yearEnd; $i++) {
                $years[$i] = $i;
                dd($years);
            }
        }
        $years = [$yearStart];
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('layouts.web.etc.graphic.create')->with('users', $users)->with('years', $years)->with('months', $months)->with('notifs', $notifs);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        $full_name = User::findOrFail($request->user_id)->full_name;
        $chooseDate = 1;
        $chooseMonth = $request->month;
        $chooseYear = $request->year;
        $setDate = Carbon::create($chooseYear, $chooseMonth, $chooseDate);
        //find beginning date of month
        $awal = $setDate->startOfMonth();
        $tglAwal = $awal->toDateString();
        //find last date of month
        $akhir = $setDate->endOfMonth();
        $tglAkhir = $akhir->toDateString();

        $graphics = Graphic::where('user_id', $request->user_id)->get();
        foreach($graphics as $keyIndex => $graphic) {
            $data[$keyIndex] = $graphic->count;
            $tgl = substr($graphic->date, -2);
            $days[$keyIndex] = intval($tgl);
        }
        // dd($days, $data);
        $notifs = request()->get('notifs');
        return view('layouts.web.etc.graphic.graph')->with('notifs', $notifs)->with('data', $data)->with('days', $days)->with('date', $setDate->format('F Y'))->with('full_name', $full_name);
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
