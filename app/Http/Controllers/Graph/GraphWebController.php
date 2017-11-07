<?php

namespace App\Http\Controllers\Graph;

use App\Graphic;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GraphWebController extends Controller
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

    public function create() //pilih tahun dan bulan untuk liat grafik transaksi
    {
        $users = User::all();
        $yearStart = Transaction::oldest()->first()->created_at->year;
        $yearEnd = Transaction::latest()->first()->created_at->year;
        if ($yearStart != $yearEnd) {
            $years = [];
            for($i = $yearStart; $i <= $yearEnd; $i++) {
                $years[$i] = $i;
            }
        }
        $years = [$yearStart];
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('layouts.web.etc.graphic.create')->with('users', $users)->with('years', $years)->with('months', $months);
    }

    public function show(Request $request) //showing grpahic for user transaction based on choosen year and month
    {
        $full_name = User::findOrFail($request->user_id)->full_name;
        $setDate = Carbon::create($request->year, $request->month, 1);

        //find beginning date of month
        $awal = $setDate->startOfMonth();
        $tglAwal = $awal->toDateString();

        //find last date of month
        $akhir = $setDate->endOfMonth();
        $tglAkhir = $akhir->toDateString();

        $all = [];
        $success = [];
        $failed = [];
        $days = [];
        $graphics = Graphic::where('user_id', $request->user_id)->where('type', $request->type)->get();
        if($graphics == null) {
            flash('Sorry you don\'t have any transactions')->error()->important();
            return redirect()->back();
        }

        foreach($graphics as $keyIndex => $graphic) {
            $all[$keyIndex] = $graphic->count_created;
            $success[$keyIndex] = $graphic->count_success;
            $failed[$keyIndex] = $graphic->count_cancel;
            $tgl = substr($graphic->date, -2);
            $days[$keyIndex] = intval($tgl);
        }
        return view('layouts.web.etc.graphic.graph')->with('success', $success)->with('failed', $failed)->with('all', $all)->with('days', $days)->with('date', $setDate->format('F Y'))->with('full_name', $full_name);
    }
}
